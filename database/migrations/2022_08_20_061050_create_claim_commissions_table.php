<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_claim_commissions', function (Blueprint $table) {
            $table->id('claim_commissions_id');
            $table->string('client_name');
            $table->bigInteger('commission_id')->unsigned()->index()->nullable();
            $table->foreign('commission_id')->references('commissions_id')->on('tbl_commissions')->onUpdate('cascade')->onDelete('cascade');
            $table->date('commission_claim_date');
            $table->string('claim_remarks');
            $table->enum('commissions_claim_status',['pending','paid','defer'])->nullable();
            $table->string('display_order')->nullable();
            $table->string('remarks')->nullable();
            $table->enum('status',['active','in_active'])->nullable();
            $table->bigInteger('created_by')->unsigned()->index()->nullable();
            $table->bigInteger('last_updated_by')->unsigned()->index()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('last_updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_claim_commissions');
    }
}
