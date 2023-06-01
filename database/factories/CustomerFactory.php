<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_booking' => $this->faker->firstName . ' ' . $this->faker->lastName,
            'name_patient' => $this->faker->firstName . ' ' . $this->faker->lastName,
            'email' => $this->faker->email,
            'phone_booking' => $this->faker->phoneNumber,
            'phone_patient' => $this->faker->phoneNumber,
            'gender' => $this->faker->boolean,
            'birth_date' => $this->faker->date(),
        ];
    }
}
