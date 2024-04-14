<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermission extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => 'loan_approve',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'loan_return',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'loan_reject',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        permission::insert($data);


        $roles = [
            'first-approver',
            'second-approver',
            'first-disburser',
            'second-disburser',
        ];

        $permissionDisburs = [1,2,3];
        $permissionRequest = [1,2];
        foreach ($roles as $roleName) {
            $role = Role::create(['name' => $roleName]);
            if ($roleName == 'first-approver') {
                $role->givePermissionTo($permissionRequest);
            }elseif ($roleName == 'second-approver') {
                $role->givePermissionTo($permissionRequest);
            }elseif ($roleName == 'first-disburser') {
                $role->givePermissionTo($permissionDisburs);
            }else{
                $role->givePermissionTo($permissionDisburs);
            }
        }
    }
}
