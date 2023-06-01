<?php

namespace Database\Factories;

use App\Models\Specialist;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'specialist_id' => Specialist::query()->inRandomOrder()->value('id'),
            'name' => $this->faker->firstName . ' ' . $this->faker->lastName,
            'avatar' => $this->faker->imageUrl(),
            'birth_date' => $this->faker->date(),
            'email' => $this->faker->unique()->email,
            'password' => $this->faker->password,
            'phone' => $this->faker->unique()->phoneNumber,
            'gender' => $this->faker->boolean,
            'address' => $this->faker->city,
            'nationality' => $this->faker->country,
            'degree' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'experience' => $this->faker->numberBetween(1, 60),
            'price' => $this->faker->numberBetween($min = 1500, $max = 6000),

        ];
    }
}
