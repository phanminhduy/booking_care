<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->firstName . ' ' . $this->faker->lastName,
            'avatar' => $this->faker->imageUrl(),
            'birth_date' => $this->faker->date(),
            'email' => $this->faker->unique()->email,
            'password' => $this->faker->password,
            'phone' => $this->faker->unique()->phoneNumber,
            'gender' => $this->faker->boolean,
            'address' => $this->faker->city,
            'role' => $this->faker->numberBetween(0,1),
        ];
    }
}
