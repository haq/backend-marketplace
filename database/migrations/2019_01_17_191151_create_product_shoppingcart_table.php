<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductShoppingcartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_shoppingcart', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('product_id')->unsigned();

            $table->integer('shoppingcart_id')->unsigned();
            $table->foreign('shoppingcart_id')->references('id')->on('shopping_carts')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_shoppingcart');
    }
}
