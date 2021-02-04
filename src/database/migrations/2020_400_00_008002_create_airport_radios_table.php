<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirportRadiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airport_radios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('airport_id')->nullable()->unsigned();
            $table->foreign('airport_id')->references('id')->on('airports');
            $table->string('category')->nullable();
            $table->string('frequency')->nullable();
            $table->string('type')->nullable();
            $table->string('spec')->nullable();
            $table->text('description')->nullable();
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
