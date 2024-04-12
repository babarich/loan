<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use App\Models\Loan\Loan;
use App\Models\Loan\LoanSchedule;
use App\Models\Loan\PaymentLoan;
use App\Services\ChartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;

class PaymentController extends Controller
{



    public function index(Request $request){

        $perPage = request('per_page',10);
        $sortField = request('sort_field','created_at');
        $sortDirection = request('sort_direction','desc');
        return Inertia::render('Payment/Index',[
            'filters' => FacadesRequest::all('search'),
            'payments' => PaymentLoan::query()
                ->orderBy($sortField, $sortDirection)
                ->filter(FacadesRequest::only('search'))
                ->paginate($perPage,['*'],'payments')
                ->withQueryString()
                ->through(fn ($payment) => [
                    'id' => $payment->id,
                    'reference' => $payment->loan->reference,
                    'name' => $payment->loan->borrower->first_name . ' ' . $payment->loan->borrower->last_name,
                    'date' =>$payment->payment_date,
                    'type' => $payment->type,
                    'amount'=>$payment->amount,
                    'user' => $payment->user->name
                ])

        ]);

    }



    public function chart(Request $request, ChartService $chartService)
    {

        $today = PaymentLoan::today()->sum('amount');

        $total = PaymentLoan::sum('amount');
        $week = PaymentLoan::lastweek()->sum('amount');
        $month = PaymentLoan::lastmonth()->sum('amount');
        $loans = Loan::count();
        $interest = LoanSchedule::sum('interest_paid');
        $principle = LoanSchedule::sum('principal_paid');
        $monthlyPaid = $chartService->getDataMonth();
        $projectedMonth = $chartService->getMonthProjected();
        $interestPaid = $chartService->getInterest();
        $interestProjected = $chartService->getProjectedInterest();
        $principlePaid = $chartService->getPrinciple();
        $principleProjected = $chartService->getProjectedPrinciple();

        return Inertia::render('Payment/Chart',[
            'today' => $today,
            'total' => $total,
            'week' => $week,
            'month' => $month,
            'loan' => $loans,
            'interest' => $interest,
            'principle' => $principle,
            'chartData' => $monthlyPaid,
            'projectedMonth' => $projectedMonth,
            'interestPaid' => $interestPaid,
            'interestProjected' => $interestProjected,
            'principlePaid' => $principlePaid,
            'principleProjected' => $principleProjected
        ]);
    }
}
