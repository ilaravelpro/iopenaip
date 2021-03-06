<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 2/3/21, 3:23 PM
 * Copyright (c) 2021. Powered by iamir.net
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirportRunwaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airport_runways', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('airport_id')->nullable()->unsigned();
            $table->foreign('airport_id')->references('id')->on('airports');
            $table->string('name')->nullable();
            $table->string('mag_bearing')->nullable();
            $table->string('dir')->nullable();
            $table->string('pcn')->nullable();
            $table->string('length')->nullable();
            $table->string('width')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('airport_radios');
    }
}
