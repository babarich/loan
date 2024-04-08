<?php

namespace App\Models\Loan;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanSchedule extends Model
{
    use HasFactory;

    protected $table = 'loan_schedules';



    protected  $casts = [
        'due_date' => "datetime:Y-m-d",
    ];

    protected $fillable = ['loan_id', 'borrower_id', 'due_date', 'amount', 'status','user_id', 'paid','principle', 'interest', 'penalty',
        'fees', 'interest_paid', 'principal_paid'];

    protected function dueDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('Y-m-d')
        );
    }


}
