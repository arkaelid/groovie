<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crée le rôle admin
        $adminRole = Role::create(['name' => 'admin']);

        // Assigner ce rôle à l'utilisateur avec ID 1 (ou un autre utilisateur)
        $user = User::find(1); // L'utilisateur avec l'ID 1
        $user->assignRole($adminRole);
    }
}
