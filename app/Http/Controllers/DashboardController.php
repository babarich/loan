<?php

namespace App\Http\Controllers;

use App\Charts\InterestDue;
use App\Charts\LoanDueChart;
use App\Charts\LoanMonthly;
use App\Charts\MonthlyPayment;
use App\Charts\PrincipleDue;
use App\Models\Borrow\Borrower;
use App\Models\Loan\Loan;
use App\Models\Loan\LoanPayment;
use App\Models\Loan\LoanSchedule;
use App\Services\ChartService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{




    public function index(Request $request, LoanMonthly $loanMonthly,
                          MonthlyPayment $monthlyPayment, LoanDueChart $dueChart,PrincipleDue $principleDue,
             InterestDue $interestDue){

        $totalOutstanding = LoanSchedule::sum('amount');
        $principleOutstanding = LoanSchedule::sum('principle');
         $interestOut = LoanSchedule::sum('interest');
        $fully = LoanPayment::query()->where('status', '=','completed')->count();
        $open = LoanPayment::query()->where('status', '!=', 'completed')->count();
        $borrowers = Borrower::count('id');
        $denied =Loan::query()->where('status', '=', 'rejected')->count();


        return Inertia::render('Dashboard',[
            'totalOutstanding' => $totalOutstanding,
            'principleOutstanding' => $principleOutstanding,
            'interestOut' => $interestOut,
            'fully' => $fully,
            'open' => $open,
            'borrowers' => $borrowers,
            'denied' => $denied,
            'chartData' => $loanMonthly->build(),
            'monthlyPaid' => $monthlyPayment->build(),
            'dueChart' => $dueChart->build(),
            'interest' => $interestDue->build(),
            'principle' => $principleDue->build(),

        ]);
    }
}
