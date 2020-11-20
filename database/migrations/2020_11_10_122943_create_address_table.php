<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->integer('store_id');
            $table->integer('user_id');
            $table->tinyInteger('type')->nullable();
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->integer('pincode');
            $table->string('landmark')->nullable();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->string('address');
            $table->string('default')->nullable();;
            $table->tinyInteger('status')->default('1');
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
        Schema::dropIfExists('address');
    }
}
