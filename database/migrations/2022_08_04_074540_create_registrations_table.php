<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_registrations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('campaign_id')->unsigned()->index()->nullable();
            $table->foreign('campaign_id')->references('id')->on('tbl_campaigns')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zone')->nullable();
            $table->text('nearest_landmark')->nullable();
            $table->string('see_year')->nullable();
            $table->string('see_grade')->nullable();
            $table->string('see_stream')->nullable();
            $table->string('see_school')->nullable();
            $table->string('plus2_year')->nullable();
            $table->string('plus2_grade')->nullable();
            $table->string('plus2_stream')->nullable();
            $table->string('plus2_college')->nullable();
            $table->string('bachelors_year')->nullable();
            $table->string('bachelors_grade')->nullable();
            $table->string('bachelors_stream')->nullable();
            $table->string('bachelors_college')->nullable();
            $table->string('highest_qualification')->nullable();
            $table->string('highest_grade')->nullable();
            $table->string('highest_stream')->nullable();
            $table->string('highest_college')->nullable();
            $table->string('preparation_class')->nullable();
            $table->string('preparation_score')->nullable();
            $table->string('preparation_bandscore')->nullable();
            $table->string('preparation_date')->nullable();
            $table->text('test_name')->nullable();
            $table->string('test_score')->nullable();
            $table->string('preffered_location')->nullable();
            $table->string('intrested_for_country')->nullable();
            $table->string('intrested_course')->nullable();
            $table->string('display_order')->nullable();
            $table->text('remarks')->nullable();
            $table->enum('status',['active','in_active'])->nullable();
            $table->bigInteger('created_by')->unsigned()->index()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->date('created_on')->nullable();
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
        Schema::dropIfExists('tbl_registrations');
    }
}
