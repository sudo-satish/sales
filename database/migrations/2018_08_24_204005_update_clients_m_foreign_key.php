<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateClientsMForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ut_hrm_client_m', function (Blueprint $table) {
            //
            $table->integer('billto_client_id')->unsigned()->change();
            $table->foreign('billto_client_id')->references('id')->on('ut_hrm_client_m')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ut_hrm_client_m', function (Blueprint $table) {
            //
        });
    }
}
