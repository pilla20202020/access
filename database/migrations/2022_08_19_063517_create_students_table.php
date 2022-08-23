<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_students', function (Blueprint $table) {
            $table->id('id');
            // $table->unsignedBigInteger('user_id');
            $table->string('applicant',255)->nullable();
            $table->string('first_name',255)->nullable();
            $table->string('middle_name',255)->nullable();
            $table->string('last_name',255)->nullable();
            $table->enum('gender',['male','female','other'])->default('Male');
            $table->enum('material_status',['Yes','No'])->default('No')->nullable();
            $table->string('spouse_name',255)->nullable();
            $table->string('father_name',255)->nullable();
            $table->string('mother_name',255)->nullable();
            $table->decimal('mobile_no',10,0)->nullable();
            $table->decimal('alternate_mobile_no',10,0)->nullable();
            $table->string('email',255)->nullable();
            $table->date('dob')->nullable();
            $table->enum('source_ref',['direct','location','agent'])->default('direct')->nullable();
            $table->string('ref_id',255)->nullable();
            $table->bigInteger('country_id')->unsigned()->index()->nullable();
            $table->bigInteger('state_id')->unsigned()->index()->nullable();
            $table->bigInteger('district_id')->unsigned()->index()->nullable();
            $table->string('municipality_name',255)->nullable();
            $table->unsignedInteger('ward_no')->nullable();
            $table->string('village_name',255)->nullable();
            $table->string('full_address',255)->nullable();
            $table->string('display_order')->nullable();
            $table->string('remarks')->nullable();
            $table->enum('status',['active','in_active'])->nullable();
            $table->bigInteger('created_by')->unsigned()->index()->nullable();
            $table->bigInteger('last_updated_by')->unsigned()->index()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('last_updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_students');
    }
}
