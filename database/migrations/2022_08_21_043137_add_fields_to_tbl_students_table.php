<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToTblStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_students', function (Blueprint $table) {
            //
            $table->string('intake_year')->nullable();
            $table->string('intake_month')->nullable()->after('intake_year');
            $table->string('preffered_location')->nullable();
            $table->string('intrested_for_country')->nullable();
            $table->string('intrested_course')->nullable();

        });

        Schema::table('tbl_admissions', function (Blueprint $table) {
            //

            $table->string('intake_year')->nullable();
            $table->string('intake_month')->nullable()->after('intake_year');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_students', function (Blueprint $table) {
            //
            $table->dropColumn(['intake_year','intake_month','preffered_location','intrested_for_country','intrested_course']);
        });

        Schema::table('tbl_admissions', function (Blueprint $table) {
            //
            $table->dropColumn(['intake_year','intake_month']);
        });
    }
}
