<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressFieldsToTblRegistrations extends Migration
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
            $table->bigInteger('country_id')->unsigned()->index()->nullable();
            $table->bigInteger('state_id')->unsigned()->index()->nullable();
            $table->bigInteger('district_id')->unsigned()->index()->nullable();
            $table->string('municipality_name',255)->nullable();
            $table->unsignedInteger('ward_no')->nullable();
            $table->string('village_name',255)->nullable();
            $table->string('full_address',255)->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onUpdate('cascade')->onDelete('cascade');

            $table->dropColumn(['address','city','state','zone','nearest_landmark']);

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
            $table->dropColumn(['country_id','state_id','district_id','municipality_name','ward_no','village_name','full_address']);
        });
    }
}
