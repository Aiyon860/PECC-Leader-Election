<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $voterRole = Role::create(['name' => 'voter']);
        $voterPermissionToVote = Permission::create(['name' => 'do vote']);
        $voterPermissionThankYou = Permission::create(['name' => 'view thank-you page']);
        $voterRole->givePermissionTo($voterPermissionToVote);
        $voterRole->givePermissionTo($voterPermissionThankYou);
        
        $candidateRole = Role::create(['name' => 'candidate']);
        $candidateRole->givePermissionTo($voterPermissionToVote);
        $candidateRole->givePermissionTo($voterPermissionThankYou);

        $adminRole = Role::create(['name' => 'admin']);
        $adminPermissionDashboard = Permission::create(['name' => 'manage dashboard']);
        $adminPermissionResult = Permission::create(['name' => 'manage result']);
        $adminPermissionCandidates = Permission::create(['name' => 'manage candidates']);
        $adminPermissionVoters = Permission::create(['name' => 'manage voters']);
        $adminRole->givePermissionTo($adminPermissionDashboard);
        $adminRole->givePermissionTo($adminPermissionResult);
        $adminRole->givePermissionTo($adminPermissionCandidates);
        $adminRole->givePermissionTo($adminPermissionVoters);
    }
}
