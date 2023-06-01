<?php

namespace Database\Factories;

use App\Enums\AppointmentStatusEnum;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Time_doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    public function definition()
    {
        return [
            'customer_id' => Customer::query()->inRandomOrder()->value('id'),
            'time_doctor_id' => Time_doctor::query()->inRandomOrder()->value('id'),
            'admin_id' => Admin::query()->inRandomOrder()->value('id'),
            'comment' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'description' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'feedback' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'price' => $this->faker->numberBetween($min = 1500, $max = 6000),
            'status' => $this->faker->randomElement(AppointmentStatusEnum::getValues()),
        ];
    }
}
