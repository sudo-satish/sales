<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsM extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ut_hrm_client_m', function (Blueprint $table) {
            $table->increments('id');

            $table->string('client_name');
            $table->longText('head_office_address')->nullable();
            $table->integer('order')->nullable();
            $table->string('pan')->nullable();
            $table->string('gst')->nullable();
            $table->integer('billto_client_id')->nullable();

            $table->string('active')->default('Y')->nullable();

            $table->string('credit_limit')->nullable();
            $table->string('balance')->nullable();

            $table->softDeletes();

            $table->timestamps();

            // $table->foreign('billto_client_id')->references('id')->on('ut_hrm_client_m')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ut_hrm_client_m');
    }
}
