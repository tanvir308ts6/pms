<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\Role;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*reports are created for each guard*/
        $role = Role::where('name', 'guard')->first();
        $guards = $role->users;
        $guards->each(function ($guard) {
            Report::factory()->for($guard)->create();
        });
    }
}
