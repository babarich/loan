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
                        $query->where('stage', '=', 0)
                               ->where('release_status', 'pending');
                    });
                }elseif ($user && $user->hasRole('second-approver')){
                    $builder->where(function ($query) use ($userId){
                        $query->where('stage', '=', 1)
                             ->where('release_status', 'pending');
                    });
                }elseif ($user && $user->hasRole('first-disburser')){
                    $builder->where(function ($query) use ($userId){
                        $query->where('stage', '=', 2)
                            ->where('release_status', 'pending');
                    });
                }elseif ($user && $user->hasRole('second-disburser')){
                    $builder->where(function ($query) use ($userId){
                        $query->where('stage', '=', 3)
                            ->where('release_status', 'pending');
                    });
                }else{
                    $builder->where(function ($query) use ($userId){
                        $query->where('user_id', $userId)
                            ->where('release_status', 'pending');
                    });
                }
            });
        }
    }


}