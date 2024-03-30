<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use App\Models\Borrow\Borrower;
use App\Models\Borrow\Guarantor;
use App\Models\Loan\Loan;
use App\Models\Loan\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
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



}
