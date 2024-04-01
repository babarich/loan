<?php

namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanSchedule extends Model
{
    use HasFactory;

    protected $table = 'loan_schedules';

    protected $fillable = ['loan_id', 'borrower_id', 'due_date', 'amount', 'status','user_id', 'paid','principle', 'interest', 'penalty', 'fees'];


}
