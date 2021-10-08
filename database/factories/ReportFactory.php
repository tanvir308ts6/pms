<?php

namespace Database\Factories;

use App\Models\Report;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Report::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $guard_role = Role::where('name', 'guard')->first();
        return [
            'title'=> $this->faker->title,
            'description'=> $this->faker->text(255),
            'user_id' => $guard_role->users->random()->id,
        ];
    }
}
