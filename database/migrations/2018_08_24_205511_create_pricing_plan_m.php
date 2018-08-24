<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricingPlanM extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ut_hrm_pricing_plan_m', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('ut_hrm_client_m')->onDelete('cascade');
            
            $table->string('item_name');
            $table->string('gsm')->nullable();
            $table->string('default_price')->nullable();
            $table->string('actual_price')->nullable();
            $table->string('unit')->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();

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
        Schema::dropIfExists('ut_hrm_pricing_plan_m');
    }
}
