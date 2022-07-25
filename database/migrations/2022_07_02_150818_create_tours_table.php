<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('destination_id');
            $table->string("name")->nullable();
            $table->string("type")->nullable();
            $table->string("duration")->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string("price")->nullable();
            $table->string("one_day_price")->nullable();
            $table->string("one_week_price")->nullable();
            $table->string("one_month_price")->nullable();
            $table->string("one_year_price")->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('tours');
    }
}
