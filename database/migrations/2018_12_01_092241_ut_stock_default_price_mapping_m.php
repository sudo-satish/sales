<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UtStockDefaultPriceMappingM extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ut_stock_default_price_mapping_m', function (Blueprint $table) {
           $table->increments('id');

            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('ut_hrm_client_m')->onDelete('cascade');

            $table->integer('price_mapping_id')->unsigned();
            $table->foreign('price_mapping_id')->references('id')->on('ut_stock_price_mapping_m')->onDelete('cascade');

            $table->date('from_date');
            $table->date('to_date');
            
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
        Schema::dropIfExists('ut_stock_default_price_mapping_m');
    }
}
