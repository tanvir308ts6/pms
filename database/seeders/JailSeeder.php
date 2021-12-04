<?php

namespace Database\Seeders;

use App\Models\Jail;
use App\Models\Role;
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

        /*prisoners are assigned to jail*/
        $prisoner_role = Role::where('name', 'prisoner')->first();
        $prisoners = $prisoner_role->users;
        $jails = Jail::all();
        $jails->each(function ($jail) use ($prisoners) {
            $jail->users()->attach($prisoners->shift($jail->capacity));
        });
    }
}
