<?php

namespace Database\Seeders;

use App\Models\Jail;
use App\Models\Ward;
use Illuminate\Database\Seeder;

class JailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Jails are created for each ward*/
        $wards = Ward::all();
        $wards->each(function ($ward) {
            Jail::factory()->for($ward)->count(5)->create();
        });
    }
}
