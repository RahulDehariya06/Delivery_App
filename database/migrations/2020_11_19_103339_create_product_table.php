<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('store_id');
            $table->string('product_name');
            $table->string('description');
            $table->string('price');
            $table->tinyInteger('discount_active')->default('0');
            $table->tinyInteger('type')->nullable();
            $table->tinyInteger('status');
            $table->tinyInteger('approved')->default('0');
            $table->integer('total_view')->default('0');
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
        Schema::dropIfExists('product');
    }
}
