<?php

namespace App\Models\Loan;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLoan extends Model
{
    use HasFactory;
    protected $table = 'payment_loans';

    protected $fillable = ['loan_id', 'description', 'amount', 'payment_date', 'user_id', 'type'];


    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }


}
