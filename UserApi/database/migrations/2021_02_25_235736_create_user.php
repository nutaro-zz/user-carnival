<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->dateTime('created_at', $precision = 0);
            $table->dateTime('deleted_at', $precision = 0);
            $table->timestamps();

            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('id')->on('state');

            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('city');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
