<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiceAmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mice_ams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('available');
            $table->string('total_pax');
            $table->string('personal');
            $table->string('Products');
            $table->string('Extra');
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
        Schema::dropIfExists('mice_ams');
    }
}
