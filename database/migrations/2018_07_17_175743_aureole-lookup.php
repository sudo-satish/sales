<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AureoleLookup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aureole_lookups', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('translation_type')->nullable();
            $table->string('code');
            $table->string('meaning');
            $table->string('tip')->nullable();
            $table->string('order');
            $table->string('active')->nullable();
            $table->longText('description')->nullable();
            
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
        Schema::dropIfExists('aureole_lookups');
    }
}
