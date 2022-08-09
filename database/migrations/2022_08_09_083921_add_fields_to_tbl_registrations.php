<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToTblRegistrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_registrations', function (Blueprint $table) {
            //
            $table->string('user_agent')->nullable();
            $table->string('source')->nullable();
            $table->string('tracking_code')->nullable();
            $table->string('headers')->nullable();
            $table->string('coupen_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_registrations', function (Blueprint $table) {
            //
            $table->dropColumn(['user_agent','source','tracking_code','headers','coupen_code']);

        });
    }
}
