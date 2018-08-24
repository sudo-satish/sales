<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserTableProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->integer('designation_id')->nullable();
            $table->integer('location_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->string('email_official')->nullable();
            $table->string('roles_id')->nullable();
            $table->string('employee_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
             $table->dropColumn(['designation_id', 'location_id', 'department_id', 'email_official', 'roles_id', 'employee_code']);
        });
    }
}
