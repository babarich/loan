<?php

namespace App\Http\Controllers;

use App\Models\Borrow\Borrower;
use App\Models\Loan\Loan;
use App\Models\Loan\LoanPayment;
use App\Models\Loan\LoanSchedule;
use App\Services\ChartService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{




    public function index(Request $request, ChartService  $chartService){

        $totalOutstanding = LoanSchedule::sum('amount');
        $principleOutstanding = LoanSchedule::sum('principle');
         $interestOut = LoanSchedule::sum('interest');
        $fully = LoanPayment::query()->where('status', '=','completed')->count();
        $open = LoanPayment::query()->where('status', '!=', 'completed')->count();
        $borrowers = Borrower::count('id');
        $denied =Loan::query()->where('status', '=', 'rejected')->count();

        $monthlyPaid = $chartService->getDataMonth();
        $projectedMonth = $chartService->getMonthProjected();
        $interestPaid = $chartService->getInterest();
        $interestProjected = $chartService->getProjectedInterest();
        $principlePaid = $chartService->getPrinciple();
        $principleProjected = $chartService->getProjectedPrinciple();
        return Inertia::render('Dashboard',[
            'totalOutstanding' => $totalOutstanding,
            'principleOutstanding' => $principleOutstanding,
            'interestOut' => $interestOut,
            'fully' => $fully,
            'open' => $open,
            'borrowers' => $borrowers,
            'denied' => $denied,
            'chartData' => $monthlyPaid,
            'projectedMonth' => $projectedMonth,
            'interestPaid' => $interestPaid,
            'interestProjected' => $interestProjected,
            'principlePaid' => $principlePaid,
            'principleProjected' => $principleProjected
        ]);
    }
}
