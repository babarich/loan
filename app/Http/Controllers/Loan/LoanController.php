<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoanRequest;
use App\Models\Borrow\Borrower;
use App\Models\Borrow\Guarantor;
use App\Models\Loan\Loan;
use App\Models\Loan\LoanPayment;
use App\Models\Loan\LoanSchedule;
use App\Models\Loan\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
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
                    'borrower' => $loan->user()->first_name . ' ' . $loan->user()->last_name,
                    'principal' =>$loan->principle_amount,
                    'interest' => $loan->total_interest,
                    'interest_type' => isset($loan->interest_percentage) ? $loan->interest_percentage. ' '. '%'. $loan->interest_duration : $loan->interest_amount. ' '. $loan->interest_duration,
                    'due'=>$loan->loanpayment()->due_amount,
                    'total_paid' =>$loan->loanpayment()->paid_amount,
                    'last_payment' =>$loan->loanpayment()->latest_payment,
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
           DB::beginTransaction();
            $totalInterest = $this->calculateLoan($principle,$interest,$interest_type,$percent,$amount,$duration,$type);
             $loan = Loan::create([
              'reference' => 'LRN'.''.rand(1000,9999),
              'loan_product' => $validatedData['product'],
              'borrower_id' => $validatedData['borrower'],
              'principle_amount' => $validatedData['principle'],
              'interest_method' => $validatedData['interest'],
              'interest_type' => $validatedData['interest_type'],
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
             $payInterest = $this->singleInterest($principle, $interest_type,$percent, $amount);
             $paymentCycle = $request->input('payment_cycle');
             $cycle = $request->input('number_payments');
             $schedules = $this->calculateRepaymentSchedule($principle,$payInterest,$duration,$paymentCycle,$cycle,$loanDate);

                foreach ($schedules as $schedule){
                    LoanSchedule::create([
                     'loan_id' => $loan->id,
                      'borrower_id' => $validatedData['borrower'],
                      'due_date' => $schedule->due_date,
                      'amount' => $schedule->repayment_amount,
                      'status' => 'pending',
                      'user_id' => Auth::id(),
                      'paid' => $schedule->paid
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


   private function calculateLoan($principle ,$interest, $interest_type, $percent, $amount, $duration, $type){

        $totalInterest = 0;
        if($interest === 'flat'){
            if ($interest_type === 'amount'){
                $term = $this->convertTerm($duration, $type);
                $totalInterest = $amount * $term;
            }else{
                $term = $this->convertTerm($duration, $type);
                $totalInterest =  $principle * ($percent/100) * $term;
            }

        }elseif ($interest === 'reducing'){
            if ($interest_type === 'amount'){
                $term = $this->convertTerm($duration, $type);
                $totalInterest = $amount * $term;
            }else{
                $term = $this->convertTerm($duration, $type);
                $totalInterest =  $principle * ($percent/100) * $term;
            }
        }elseif ($interest === 'interest'){
            if ($interest_type === 'amount'){
                $term = $this->convertTerm($duration, $type);
                $totalInterest = $amount * $term;
            }else{
                $term = $this->convertTerm($duration, $type);
                $totalInterest =  $principle * ($percent/100) * $term;
            }

        }else{
            if ($interest_type === 'amount'){
                $term = $this->convertTerm($duration, $type);
                $totalInterest = $amount * $term;
            }else{
                $term = $this->convertTerm($duration, $type);
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

   private function convertTerm($duration, $type)
   {

       switch ($type) {
           case 'day':
               return $duration / 30;
           case 'week':
               return $duration * 4;
           case 'month':
               return $duration;
           case 'year':
               return $duration * 12;
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
        for ($i = 1; $i <= $term; $i += $repaymentFrequency) {
            if ($repaymentCycle === 'week'){
                $dueDate = $date->addWeeks($i)->format('Y-m-d');
            }elseif ($repaymentCycle === 'day'){
                $dueDate = $date->addDays($i)->format('Y-m-d');
            }else{
                $dueDate = $date->addMonths($i)->format('Y-m-d');
            }

            $repaymentSchedule[] = [
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

}
