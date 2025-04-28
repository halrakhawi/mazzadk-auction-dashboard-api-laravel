<?php


use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;


class CreateProductsTable extends Migration

{

    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

        Schema::create('products', function (Blueprint $table) {

            $table->unsignedInteger('id')->autoIncrement();
            $table->string('productname');
            $table->text('productdetail');
            $table->text('picture')->nullable();
            $table->string('size')->nullable();
            $table->dateTime('remainingtime');
            $table->double('price',8,2);
            $table->Integer('veiws')->nullable();
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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

        Schema::dropIfExists('products');

    }

}