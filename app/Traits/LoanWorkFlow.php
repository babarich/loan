<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

trait LoanWorkFlow
{

    public static function bootLoanWorkFlowTrait()
    {
        if(!app()->runningInConsole() && auth()->check()){
            $userId = auth()->id();
            static::addGlobalScope('loan_flow', function (Builder $builder) use ($userId) {
                $user = User::find($userId);
                if($user && $user->hasRole('first-approver')){
                    $builder->where(function ($query) use ($userId){
                        $query->where('stage', '=', 0);
                    });
                }elseif ($user && $user->hasRole('second-approver')){
                    $builder->where(function ($query) use ($userId){
                        $query->where('stage', '=', 1);
                    });
                }elseif ($user && $user->hasRole('first-disburser')){
                    $builder->where(function ($query) use ($userId){
                        $query->where('stage', '=', 2);
                    });
                }elseif ($user && $user->hasRole('second-disburser')){
                    $builder->where(function ($query) use ($userId){
                        $query->where('stage', '=', 3);
                    });
                }else{
                    $builder->where(function ($query) use ($userId){
                        $query->where('user_id', $userId);
                    });
                }
            });
        }
    }


}
