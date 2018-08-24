<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->string('address_line_one')->nullable();
            $table->string('address_line_two')->nullable();

            $table->bigInteger('city_id');
            $table->bigInteger('state_id');

            $table->string('pincode')->nullable();
            $table->string('type')->nullable();

            $table->string('default')->default('Y')->nullable();
            $table->string('active')->default('Y')->nullable();

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
        Schema::dropIfExists('address');
    }
}
