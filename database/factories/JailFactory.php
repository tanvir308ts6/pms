<?php

namespace Database\Factories;

use App\Models\Jail;
use Illuminate\Database\Eloquent\Factories\Factory;

class JailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Jail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->streetName,
            'code' => $this->faker->iban(),
            'type' => $this->faker->randomElement(['low', 'medium', 'high']),
            'capacity' => $this->faker->numberBetween($min = 2, $max = 5),
            'description' => $this->faker->text(255),
        ];
    }
}
