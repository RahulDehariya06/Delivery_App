<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('store_name');
            $table->string('phone');
            $table->date('started_at');
            $table->integer('parent_id');
            $table->integer('user_id');
            $table->string('store_open_time')->nullable();
            $table->string('store_close_time')->nullable();
            $table->string('max_delivery_time')->nullable();
            $table->string('description');
            $table->tinyInteger('approved')->default('0');
            $table->tinyInteger('rating')->nullable();
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
        Schema::dropIfExists('stores');
    }
}
