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
        // Ward assignment
        $guard_role = Role::where('name', 'guard')->first();
        $guards = $guard_role->users;
        $wards = Ward::factory()->count(25)->create();
        $wards->each(function ($ward)use($guards){
            $ward->users()->attach($guards->random()->id);
        });
    }
}
