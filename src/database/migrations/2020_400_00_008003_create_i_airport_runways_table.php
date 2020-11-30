<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIAirportRunwaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_airport_runways', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('airport_id')->nullable()->unsigned();
            $table->foreign('airport_id')->references('id')->on('airports');
            $table->string('name')->nullable();
            $table->string('dir')->nullable();
            $table->string('side')->nullable();
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
        Schema::dropIfExists('i_airport_radios');
    }
}
