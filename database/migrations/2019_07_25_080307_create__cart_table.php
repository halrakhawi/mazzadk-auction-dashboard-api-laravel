<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Cart', function (Blueprint $table) {
            $table->string('id');
            $table->string('key');
            $table->unsignedInteger('userID')->nullable();
            $table->unsignedInteger('auctionid')->nullable();
            $table->nullableTimestamps();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Cart');
    }
}
