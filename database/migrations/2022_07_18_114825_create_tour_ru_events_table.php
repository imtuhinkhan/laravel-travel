<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourRuEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_ru_events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->string('time');
            $table->string('type');
            $table->string('period');
            $table->string('settlement');
            $table->string('distance');
            $table->string('duration');
            $table->string('price');
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
        Schema::dropIfExists('tour_ru_events');
    }
}
