<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToTblAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_admissions', function (Blueprint $table) {
            //

            $table->bigInteger('country_id')->unsigned()->index()->nullable()->after('id');
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('state_id')->unsigned()->index()->nullable();
            $table->foreign('state_id')->references('id')->on('states')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('college_id')->unsigned()->index()->nullable();
            $table->foreign('college_id')->references('id')->on('colleges')->onUpdate('cascade')->onDelete('cascade');
            $table->date('commenced_date')->nullable();
            $table->enum('commenced_status',['pending','applied'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_admissions', function (Blueprint $table) {
            //
            $table->dropColumn(['country_id','state_id','college_id','commenced_date','commenced_status']);

        });

    }
}
