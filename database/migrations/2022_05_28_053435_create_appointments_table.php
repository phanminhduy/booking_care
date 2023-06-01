<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('time_doctor_id')->constrained();
            $table->foreignId('admin_id')->nullable()->constrained();
            $table->string('comment')->nullable();
            $table->string('description');
            $table->string('feedback')->nullable();
            $table->integer('price');
            $table->smallInteger('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
