<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReportAlterColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('reports', function (Blueprint $table) {
            
            $table->string('active')->nullable()->change();
            $table->string('row_start_index')->nullable()->change();
            $table->string('output_type')->nullable()->change();
            $table->string('group')->nullable()->after('id');

            $table->string('custom')->nullable()->change();
            $table->longText('sql')->nullable()->change();
            $table->longText('controller')->nullable()->change();
            $table->longText('model')->nullable()->change();
            $table->longText('template')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('reports', function (Blueprint $table) {
            $table->longText('active')->change();
            $table->longText('row_start_index')->change();
            $table->longText('output_type')->change();
            $table->dropColumn('group');

        });
    }
}
