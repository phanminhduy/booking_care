<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeDoctorsTable extends Migration
{
    public function up()
    {
        Schema::create('time_doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained();
            $table->foreignId('time_id')->constrained();
        });
    }

    public function down()
    {
        Schema::dropIfExists('time_doctors');
    }
}
