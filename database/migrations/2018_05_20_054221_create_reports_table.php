<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            //$values = ['name' => 'Report 1', 'code' => 'CODE', 'custom' => '', 'sql' => 'SELECT 1', 'controller' => '', 'model' => '', 'template' => '', 'active' => 'Y', 'row_start_index' => 1, 'output_type' => 'XLSX'];
            $table->string('name');
            $table->string('code')->unique();
            $table->string('custom');
            $table->longText('sql');
            $table->longText('controller');
            $table->longText('model');
            $table->longText('template');
            $table->longText('active');
            $table->longText('row_start_index');
            $table->longText('output_type');

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
        Schema::dropIfExists('reports');
    }
}
