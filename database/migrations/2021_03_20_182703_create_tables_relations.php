<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign("approved_by")->references('id')->on('users');
        });

        Schema::table('floors', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users');
        });

        Schema::table('rooms', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('floor_id')->references('id')->on('floors');
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('client_id')->references('id')->on('users');
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
