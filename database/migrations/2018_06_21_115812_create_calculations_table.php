<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalculationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->integer('cashbox_a');
            $table->integer('takings');
            $table->integer('reservations');
            $table->integer('income_others');
            $table->integer('income_sum');
            $table->integer('shopping');
            $table->integer('salaries');
            $table->integer('costs_others');
            $table->integer('costs_sum');
            $table->integer('cashbox');
            $table->string('day_of_the_week');
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
        Schema::dropIfExists('calculations');
    }
}
