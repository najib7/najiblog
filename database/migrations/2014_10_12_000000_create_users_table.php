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
            $table->increments('id');
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('password');
            $table->timestamp('last_login')->nullable();
            $table->timestamps();
        });

        Schema::create('profiles', function(Blueprint $table) {
            $table->unsignedInteger('user_id')->primary();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('image')->nullable();
            $table->text('about')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('country');
            $table->string('phone')->nullable();
            $table->enum('gender', ['male', 'female']);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
        Schema::dropIfExists('users');
    }
}
