<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Ward;
use Illuminate\Database\Seeder;

class WardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*wards are created*/
        $wards = Ward::factory()->count(20)->create();

        /*guards are assigned to ward*/
        $guard_role = Role::where('name', 'guard')->first();
        $guards = $guard_role->users;
        $wards->each(function ($ward) use ($guards) {
            $ward->users()->attach($guards->shift());
        });
    }
}
