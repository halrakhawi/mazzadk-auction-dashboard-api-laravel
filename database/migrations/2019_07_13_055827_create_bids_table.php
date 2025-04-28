<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->bigIncrements('bidid');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id');
            $table->double('bidprice',8,2);
            $table->double('currentprice',8,2)->nullable();
            $table->dateTime('biddingtime');
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
        Schema::dropIfExists('bids');
    }
}
