<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourProgramAmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_program_ams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tour_am_id');
            $table->string("day")->nullable();
            $table->string("fromTo")->nullable();
            $table->text("description")->nullable();
            $table->string("distance")->nullable();
            $table->string("duration")->nullable();
            $table->string("food")->nullable();
            $table->string("location")->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('tour_program_ams');
    }
}
