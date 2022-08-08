<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangesFieldTypeOfTblCampaigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('tbl_campaigns', function (Blueprint $table) {
            $table->text('ogtags')->change();
            $table->text('details')->change();
            $table->string('email_success')->nullable();
            $table->string('offered_course')->nullable();

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
        Schema::table('tbl_campaigns', function (Blueprint $table) {
            $table->dropColumn(['email_success','offered_course']);
        });
    }
}
