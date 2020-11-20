<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromocodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promocode', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('code');
            $table->string('description');
            $table->timestamp('valid_from')->useCurrent();
            $table->timestamp('expiration')->useCurrent();
            $table->integer('usages_limit_per_coupen');
            $table->integer('limit_per_user');
            $table->tinyInteger('type');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('promocode');
    }
}
