<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimesTable extends Migration
{
    public function up()
    {
        Schema::create('times', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time_start');
            $table->time('time_end');
        });
    }

    public function down()
    {
        Schema::dropIfExists('times');
    }
}
