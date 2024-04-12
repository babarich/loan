<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoanRequest;
use App\Models\Borrow\Borrower;
use App\Models\Borrow\Guarantor;
use App\Models\Collateral\CollateralType;
use App\Models\Loan\Loan;
use App\Models\Loan\LoanAttachment;
use App\Models\Loan\LoanPayment;
use App\Models\Loan\LoanSchedule;
use App\Models\Loan\PaymentLoan;
use App\Models\Loan\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Str;
use Inertia\Inertia;

class LoanController extends Controller
{




    public function index(Request $request){



        $perPage = request('per_page',10);
        $sortField = request('sort_field','created_at');
        $sortDirection = request('sort_direction','desc');
        return Inertia::render('Loan/Index',[
            'filters' => FacadesRequest::all('search'),
            'loans' => Loan::query()
                ->orderBy($sortField, $sortDirection)
                ->filter(FacadesRequest::only('search'))
                ->paginate($perPage,['*'],'groups')
                ->withQueryString()
                ->through(fn ($loan) => [
                    'id' => $loan->id,
                    'reference' => $loan->reference,
                    'name' => $loan->borrower->first_name . ' ' . $loan->borrower->last_name,
                    'principal' =>$loan->principle_amount,
                    'total_interest' => $loan->total_interest,
                    'interest' => isset($loan->interest_percentage) ? $loan->interest_percentage. ' '. '%' : $loan->interest_amount,
                    'type' => 'per'.' '.$loan->interest_duration,
                    'due'=>$loan->loanpayment->due_amount,
                    'total_paid' =>$loan->loanpayment->paid_amount ?? 0,
                    'last_payment' =>$loan->loanpayment->latest_payment ?? 0,
                    'status' => $loan->status
                ])

        ]);
    }



    public function create(Request $request){

        return Inertia::render('Loan/Create',[
            'guarantors' => Guarantor::query()
                           ->orderBy('updated_at', 'desc')
                           ->get(),
            'borrowers' => Borrower::query()
                        ->orderBy('updated_at', 'desc')
                        ->get(),

            'products' => Product::query()
                ->orderBy('updated_at', 'desc')
                ->get(),
                    ]);
   }



   public function store(LoanRequest $request){

        $validatedData = $request->validated();

       try {

           $principle = $validatedData['principle'];
           $interest = $validatedData['interest'];
           $interest_type = $validatedData['interest_type'];
           $percent = $request->input('percent');
           $amount = $request->input('interest_amount');
           $duration = $request->input('loan_duration');
           $type = $request->input('duration_type');
           $method = $request->input('interest_method');
           DB::beginTransaction();
             $totalInterest = $this->calculateLoan($principle,$interest,$interest_type,$percent,$amount,$duration,$type, $method);
             $loan = Loan::create([
              'reference' => 'LRN'.''.rand(1000,9999),
              'loan_product' => $validatedData['product'],
              'borrower_id' => $validatedData['borrower'],
              'principle_amount' => $validatedData['principle'],
              'interest_method' => $validatedData['interest'],
              'interest_type' => $validatedData['interest_type'],
              'disbursement' => $request->filled('payment') ?  $request->input('payment') : null,
              'interest_percentage' => $request->filled('percent') ? $request->input('percent') : null,
              'interest_duration' => $request->filled('interest_method') ? $request->input('interest_method') : null,
               'loan_duration' => $validatedData['loan_duration'],
               'duration_type' => $request->filled('duration_type') ? $request->input('duration_type') : null,
               'payment_cycle' => $request->filled('payment_cycle') ? $request->input('payment_cycle') : null,
               'payment_number' => $request->filled('number_payments') ? $request->input('number_payments') : null,
               'loan_release_date' => $request->filled('release_date') ? $request->input('release_date') : null,
               'interest_amount' => $request->filled('interest_amount') ? $request->input('interest_amount') : null,
               'guarantor_id' => $validatedData['guarantor'],
               'user_id' => Auth::id(),
               'status' => 'pending',
               'release_status' => 'pending',
               'description' => $request->filled('description') ?  $request->input('description') : null,
               'total_interest' => $totalInterest
           ]);

             LoanPayment::create([
               'loan_id' => $loan->id,
               'due_amount' => $totalInterest + $validatedData['principle'],
               'total' => $totalInterest + $validatedData['principle'],
               'status' => 'pending'
             ]);

             $loanDate = $request->input('release_date');
             $paymentCycle = $request->input('payment_cycle');
             $cycle = $request->input('number_payments');
             $singleInterest = $this->singleInterest($principle,$interest_type,$percent,$amount);
             $schedules = $this->calculateRepaymentSchedule($principle,$totalInterest,$duration,$paymentCycle,$cycle,$loanDate);

                foreach ($schedules as $schedule){
                    LoanSchedule::create([
                      'loan_id' => $loan->id,
                      'borrower_id' => $validatedData['borrower'],
                      'due_date' => $schedule['due_date'],
                      'principle' => $schedule['repayment_amount'] - $singleInterest,
                      'interest' => $singleInterest,
                      'amount' => $schedule['repayment_amount'],
                      'status' => 'pending',
                      'user_id' => Auth::id(),
                      'paid' => $schedule['paid']
                    ]);
                }


           DB::commit();
       }catch (\Exception $e){
           DB::rollBack();
           Log::info('error', [$e]);
           return  Redirect::back()->with('error', 'sorry something went wrong cannot create loan try again');
       }
       return Redirect::route('loan.index')->with('success','You have added successfully a new loan');
   }


   private function calculateLoan($principle ,$interest, $interest_type, $percent, $amount, $duration, $type, $method){

        $totalInterest = 0;
        if($interest === 'flat'){
            if ($interest_type === 'amount'){
                $term = $this->convertTerm($duration, $type,$method);
                $totalInterest = $amount * $term;
            }else{
                $term = $this->convertTerm($duration, $type,$method);
                $totalInterest =  $principle * ($percent/100) * $term;
            }

        }elseif ($interest === 'reducing'){
            if ($interest_type === 'amount'){
                $term = $this->convertTerm($duration, $type,$method);
                $totalInterest = $amount * $term;
            }else{
                $term = $this->convertTerm($duration, $type,$method);
                $totalInterest =  $principle * ($percent/100) * $term;
            }
        }elseif ($interest === 'interest'){
            if ($interest_type === 'amount'){
                $term = $this->convertTerm($duration, $type,$method);
                $totalInterest = $amount * $term;
            }else{
                $term = $this->convertTerm($duration, $type,$method);
                $totalInterest =  $principle * ($percent/100) * $term;
            }

        }else{
            if ($interest_type === 'amount'){
                $term = $this->convertTerm($duration, $type,$method);
                $totalInterest = $amount * $term;
            }else{
                $term = $this->convertTerm($duration, $type,$method);
                $totalInterest =  $principle * ($percent/100) * $term;
            }

        }

        return $totalInterest;
   }


   private function singleInterest($principle, $interest_type, $percent, $amount){
        $interest = 0;
        if ($interest_type === 'amount'){
           $interest =  $amount;
        }else{
            $interest = $principle * $percent / 100;
        }

        return $interest;
   }

   private function convertTerm($duration, $type, $method)
   {

       switch ($type) {
           case 'day':
               if ($method === 'day'){
                   return $duration;
               }elseif ($method === 'week'){
                   return $duration/7;
               }else{
                   return $duration/30;
               }
           case 'week':
               if ($method === 'day'){
                   return $duration * 7;
               }elseif ($method === 'week'){
                   return $duration;
               }else{
                   return $duration /4;
               }
           case 'month':
               if ($method === 'day'){
                   return $duration * 30;
               }elseif ($method === 'week'){
                   return $duration * 4;
               }else{
                   return $duration;
               }
           case 'year':
               if ($method === 'day'){
                   return $duration * 360;
               }elseif ($method === 'week'){
                   return $duration * 52;
               }else{
                   return $duration * 12;
               }
           default:
               return $duration;
       }
   }
    public function calculateRepaymentSchedule($principle, $interest, $term, $repaymentCycle, $cycleCount, $loanDate)
    {

        $principleAmount = $principle;
        $date = Carbon::parse($loanDate);
        $repaymentSchedule = [];
        $repaymentFrequency = $cycleCount;
        $repaymentAmount = $this->calculateRepaymentAmount($principleAmount, $interest, $term);


        // Generate repayment schedule
        for ($i = 0; $i < $repaymentFrequency; $i++) {
            if ($repaymentCycle === 'week'){
                $dueDate = $date->addDays(7)->format('Y-m-d');
            }elseif ($repaymentCycle === 'day'){
                $dueDate = $date->addDays(1)->format('Y-m-d');
            }else{
                $dueDate = $date->addDays(30)->format('Y-m-d');
            }

            $repaymentSchedule[] = [
                'principle' => $principle,
                'due_date' => $dueDate,
                'repayment_amount' => $repaymentAmount,
                'paid' => false,
            ];
        }

        return $repaymentSchedule;
    }

    private function calculateRepaymentAmount($principleAmount, $interest, $term)
    {

        $totalRepayment = $principleAmount + $interest;
        $repaymentAmount = $totalRepayment / $term;

        return $repaymentAmount;
    }



    public function show(Request $request, $id){
        $types = CollateralType::query()->get();
        $loan = Loan::with(['schedules','user', 'borrower','guarantor','product', 'loanpayment','agreements',
            'collaterals', 'files','comments','cycles'])->findOrFail($id);
        return Inertia::render('Loan/View',['loan' =>$loan, 'types' => $types]);
    }


    public function attachment(Request $request, $loanId)
    {

     $validatedData= $request->validate([
            'filename' => 'required',
            'file' => 'required'
        ]);

        try {
           DB::beginTransaction();
            $attach = $request->file('file');
            $filename = $attach->getClientOriginalName();
            $filesize = $attach->getSize();
            $path = $attach->store('file');
           LoanAttachment::create([
               'loan_id' => $loanId,
               'name' => $validatedData['filename'],
               'filename' => $request->input('name'),
               'file' => $filename,
               'attachment' => $path,
               'attachment_size' => $filesize,
               'uploaded_by' => Auth::id(),
               'type' => 'agreement'
           ]);

           DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error', [$e]);
            return  Redirect::back()->with('error', 'sorry something went wrong cannot create loan try again');
        }
        return Redirect::back()->with('success','You have added successfully a new agreement file');
    }


    private function saveImage($image)
    {
        // Check if image is valid base64 string
        if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            // Take out the base64 encoded text without mime type
            $image = substr($image, strpos($image, ',') + 1);
            // Get file extension
            $type = strtolower($type[1]); // jpg, png, gif

            // Check if file is an image
            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new \Exception('invalid image type');
            }
            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);

            if ($image === false) {
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception('did not match data URI with image data');
        }

        $dir = 'images/';
        $file = Str::random() . '.' . $type;
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;
        if (!File::exists($absolutePath)) {
            File::makeDirectory($absolutePath, 0755, true);
        }
        file_put_contents($relativePath, $image);

        return $relativePath;
    }



    public function distributeLoanPayment(Request $request, $loanId) {
         $validatedData =  $request->validate([
             'amount' => 'required',
             'type' => 'required',
             'date' => 'required',
             'schedule' => 'required'
         ]);


        $loanSchedules = LoanSchedule::findOrFail($validatedData['schedule']);
        try {
            DB::beginTransaction();
            if ($loanSchedules){
                $paymentAmount = $validatedData['amount'];
                $due = 0;

                $payment = LoanPayment::query()->where('loan_id', $loanId)->first();

                $remainingAmountDue = $loanSchedules->interest + $loanSchedules->principle;

                if ($paymentAmount >= $remainingAmountDue && $remainingAmountDue > 0) {
                    $loanSchedules->paid = true;
                    $loanSchedules->status = 'completed';
                    $paidInterest = min($paymentAmount, $loanSchedules->interest);
                    $loanSchedules->interest_paid = $paidInterest;
                    $loanSchedules->interest -= $paidInterest;
                    $paymentAmount -= $paidInterest;
                    $paidPrincipal = min($paymentAmount, $loanSchedules->principle);
                    $loanSchedules->principal_paid = $paidPrincipal;
                    $loanSchedules->principle -= $paidPrincipal;
                    $paymentAmount -= $paidPrincipal;
                    $loanSchedules->amount -= $paidPrincipal + $paidInterest;
                    $loanSchedules->save();
                    $total = $payment->paid_amount + $validatedData['amount'];
                    if ($payment->due_Amount > 0 && $payment->due_amount > $validatedData['amount']){
                        $due = $payment->due_amount - $validatedData['amount'];
                    }else{
                        $due = 0;
                    }
                    $payment->update(['paid_amount' => $total, 'due_amount' => $due]);
                } else if ($paymentAmount < $remainingAmountDue && $remainingAmountDue > 0) {
                    $paidInterest = min($paymentAmount, $loanSchedules->interest);
                    $loanSchedules->interest_paid = $paidInterest;
                    $loanSchedules->interest -= $paidInterest;
                    $paymentAmount -= $paidInterest;
                    // Paying principal
                    $principalToPay = min($paymentAmount, $loanSchedules->principle);
                    $loanSchedules->principal_paid = $principalToPay;
                    $paymentAmount -= $principalToPay;
                    $loanSchedules->principle -= $principalToPay;

                    // Update schedule properties
                    $loanSchedules->paid = false;
                    $loanSchedules->status = 'partial';
                    $loanSchedules->amount -= ($loanSchedules->interest_paid + $loanSchedules->principal_paid);
                    $loanSchedules->save();

                    // Update payment properties
                    $totalPaid = $payment->paid_amount + $validatedData['amount'];
                    $dueAmount = max(0, $payment->due_amount - $validatedData['amount']);
                    $payment->update(['paid_amount' => $totalPaid, 'due_amount' => $dueAmount]);
                }




                PaymentLoan::create([
                    'loan_id' => $loanId,
                    'description' => $request->filled('description') ? $request->input('description') : null,
                    'payment_date' => $validatedData['date'],
                    'amount' => $validatedData['amount'],
                    'type' => $validatedData['type'],
                    'user_id' => Auth::id()
                ]);
            }


            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_payment', [$e]);
            return  Redirect::back()->with('error', 'sorry something went wrong cannot create loan try again');
        }

        return Redirect::route('loan.show', $loanId)->with('success','You have added successfully a payment');
    }

}
