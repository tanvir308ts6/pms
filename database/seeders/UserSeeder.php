<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * User with a specific role are created
         */
        /*users with admin role*/
        $admin_role = Role::where('name', 'admin')->first();

        User::factory()->for($admin_role)->count(5)->create(); //using Factory
        //$admin_role->users()->saveMany(User::factory()->count(3)->make()); //using Eloquent

        /*users with director role*/
        $director_role = Role::where('name', 'director')->first();
        User::factory()->for($director_role)->count(5)->create();

        /*users with guard role*/
        $guard_role = Role::where('name', 'guard')->first();
        User::factory()->for($guard_role)->count(15)->create();

        /*users with prisoner role*/
        $prisoner_role = Role::where('name', 'prisoner')->first();
        User::factory()->for($prisoner_role)->count(30)->create();

    }
}
