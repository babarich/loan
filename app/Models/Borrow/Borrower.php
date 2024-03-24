<?php

namespace App\Models\Borrow;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrower extends Model
{
    use HasFactory;

    protected $table = 'borrowers';
    protected $fillable = ['reference', 'first_name', 'last_name', 'gender', 'title', 'mobile', 'email', 'date_birth', 'address', 'city',
        'working_status','business_name','filename', 'attachment_size', 'attachment', 'uploaded_by', 'status','description','balance', 'total_paid', 'last-pay_date','approval_status'];



    public function user()
    {
        return $this->belongsTo(User::class,'uploaded_by', 'id');
    }



    public function scopeFilter($query , array $filters){
        $query->when($filters['search'] ?? null, function ($query, $search){
            $query->where('first_name', 'like', '%'.$search.'%')
                  ->orWhere('last_name', 'like', '%'.$search.'%')
                  ->orWhere('reference', 'like', '%'.$search.'%')
                  ->orWhere('business', 'like', '%'.$search.'%')
                  ->orWhere('email', 'like', '%'.$search.'%')
                  ->orWhere('mobile', 'like', '%'.$search.'%');
        });
    }

}
