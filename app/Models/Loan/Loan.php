<?php

namespace App\Models\Loan;

use App\Models\Borrow\Borrower;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $table = 'loans';

    protected $fillable = ['reference', 'loan_product', 'borrower_id', 'principle_amount', 'interest_method', 'interest_type', 'interest_percentage',
        'interest_duration', 'loan_duration', 'duration_type', 'payment_cycle', 'payment_number', 'interest_amount','total_interest', 'loan_release_date',
        'maturity_date', 'disbursed_by', 'description', 'status', 'release_status','guarantor_id', 'user_id'];


    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }



    public function borrower()
    {
        return $this->belongsTo(Borrower::class, 'borrower_id', 'id');
    }


    public function loanpayment(){
        return $this->hasOne(LoanPayment::class);
    }

    public function scopeFilter($query , array $filters){
        $query->when($filters['search'] ?? null, function ($query, $search){
            $query->where('name', 'like', '%'.$search.'%');
        });
    }

}
