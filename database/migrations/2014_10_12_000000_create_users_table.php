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
            $table->string('phone')->unique();
            $table->string('dob')->nullable();
            $table->string('photo')->nullable();
            
           
            $table->integer('address_id');
            $table->tinyInteger('is_admin');
            $table->tinyInteger('user_type');
            $table->tinyInteger('status')->default('1');
            $table->tinyInteger('verified_email')->default('0');
            $table->tinyInteger('verified_phone');
            $table->string('phone_token')->nullable();
            $table->string('email_token')->nullable();
            
            
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
