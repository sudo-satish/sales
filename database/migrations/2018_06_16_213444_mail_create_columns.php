<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MailCreateColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mails', function (Blueprint $table) {
            $table->string('template_name');
            $table->string('code')->unique();
            $table->string('subject');
            $table->string('to');
            $table->string('cc')->nullable();
            $table->string('bcc')->nullable();
            $table->string('active')->nullable();
            $table->longText('verbose')->nullable();
            $table->string('attachement')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mails', function (Blueprint $table) {
            $table->dropColumn('template_name');
            $table->dropColumn('code');
            $table->dropColumn('subject');
            $table->dropColumn('to');
            $table->dropColumn('cc');
            $table->dropColumn('bcc');
            $table->dropColumn('active');
            $table->dropColumn('verbose');
            $table->dropColumn('attachement');
        });
    }
}
