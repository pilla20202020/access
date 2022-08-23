<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_commissions', function (Blueprint $table) {
            $table->id('commissions_id');
            $table->string('title');
            $table->bigInteger('admission_id')->unsigned()->index()->nullable();
            $table->foreign('admission_id')->references('id')->on('tbl_admissions')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('student_id')->unsigned()->index()->nullable();
            $table->foreign('student_id')->references('id')->on('tbl_students')->onUpdate('cascade')->onDelete('cascade');
            $table->date('claim_date');
            $table->string('fees');
            $table->enum('commissions_status',['pending','paid'])->nullable();
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
        Schema::dropIfExists('tbl_commissions');
    }
}
