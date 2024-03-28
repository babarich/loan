<?php

namespace App\Models\Borrow;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowerGroup extends Model
{
    use HasFactory;

    protected $table = 'borrower_groups';
    protected $fillable = [ 'name','collector_name', 'user_id', 'description', 'status'];



    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }


    public function borrowers()
    {
        return $this->hasMany(Borrower::class, 'group_id', 'id');
    }


    public function scopeFilter($query , array $filters){
        $query->when($filters['search'] ?? null, function ($query, $search){
            $query->where('name', 'like', '%'.$search.'%');
        });
    }

}
