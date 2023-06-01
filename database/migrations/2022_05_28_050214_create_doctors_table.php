<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('specialist_id')->constrained();
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->date('birth_date');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->unique();
            $table->boolean('gender')->default(false);
            $table->string('address');
            $table->string('nationality');
            $table->string('degree');
            $table->unsignedTinyInteger('experience');
            $table->integer('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
