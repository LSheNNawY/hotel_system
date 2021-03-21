<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            // for managers and users
            $table->string("national_id")->nullable()->unique();
            $table->string("avatar")->nullable();
            // users
            $table->string("mobile")->nullable()->unique();
            $table->string("country")->nullable();
            $table->enum("gender", ["male", "female"])->nullable();
            $table->boolean("approved")->default(false);
            $table->unsignedBigInteger("approved_by")->unsigned()->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
