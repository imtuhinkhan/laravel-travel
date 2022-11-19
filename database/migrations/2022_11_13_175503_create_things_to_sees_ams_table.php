<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThingsToSeesAmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('things_to_see_ams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('related_id')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->longText('description')->nullable();
            $table->string('time');    
            $table->string('address');
            $table->string('duration');
            $table->string('period');
            $table->string('distance');
            $table->string('price');
            $table->longText('map');
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
        Schema::dropIfExists('things_to_sees_ams');
    }
}