<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Time;
use Illuminate\Database\Eloquent\Factories\Factory;

class Time_doctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'doctor_id' => Doctor::query()->inRandomOrder()->value('id'),
            'time_id' => Time::query()->inRandomOrder()->value('id'),
        ];
    }
}
