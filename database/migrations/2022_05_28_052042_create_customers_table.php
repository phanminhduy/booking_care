<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name_booking')->nullable();
            $table->string('phone_booking')->unique()->nullable();
            $table->string('name_patient');
            $table->string('phone_patient')->unique()->nullable();
            $table->string('email')->unique();
            $table->boolean('gender')->default(false);
            $table->date('birth_date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
