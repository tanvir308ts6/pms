<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $roles = [
            'admin',
            'director',
            'guard',
            'prisoner'
        ];

        /**
         * Register default roles
         *
         * Using Eloquent model
         */
        foreach ($roles as $role) {
            Role::create([
                'name' => $role
            ]);
        }
    }
}
