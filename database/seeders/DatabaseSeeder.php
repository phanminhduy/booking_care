<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Doctor;
use App\Models\Specialist;
use App\Models\Time;
use App\Models\Time_doctor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Specialist::factory(30)->create();
        Admin::factory(30)->create();
        Doctor::factory(30)->create();
        Customer::factory(30)->create();
        Time::factory(30)->create();
        Time_doctor::factory(30)->create();
        Appointment::factory(30)->create();
    }
}
