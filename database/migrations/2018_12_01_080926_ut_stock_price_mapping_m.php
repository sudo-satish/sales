<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UtStockPriceMappingM extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ut_stock_price_mapping_m', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('ut_stock_item_m')->onDelete('cascade');

            $table->string('bf')->comment('translation=GSM');
            $table->string('gsm')->comment('translation=BF');

            $table->float('price');
           
            $table->softDeletes();
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
        Schema::dropIfExists('ut_stock_price_mapping_m');
    }
}
