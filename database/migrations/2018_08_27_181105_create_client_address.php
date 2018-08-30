<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ut_hrm_client_address_m', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('client_id')->unsigned();

            $table->string('name')->nullable();
            $table->string('address_line_one')->nullable();
            $table->string('address_line_two')->nullable();

            $table->foreign('client_id')->references('id')->on('ut_hrm_client_m')->onDelete('cascade');

            $table->bigInteger('city_id');
            $table->bigInteger('state_id');

            $table->string('pincode')->nullable();
            $table->string('type')->nullable();

            $table->string('default')->default('Y')->nullable();
            $table->string('active')->default('Y')->nullable();

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
        Schema::dropIfExists('ut_hrm_client_address_m');
    }
}
