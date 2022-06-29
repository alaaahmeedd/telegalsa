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
            $table->string('fname');
            $table->string('lname');
            $table->string('email');
            $table->string('password');
            $table->string('password_confirm');
            $table->boolean('specialist');
            $table->boolean('client');
            $table->boolean('male');
            $table->boolean('female');
            $table->string('age');
            $table->string('job_title');
            $table->string('job_address');
            $table->boolean('Is_Here')->default(false);
            $table->string('api_token')->default('');
            $table->string('mobile_token')->default('');
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
