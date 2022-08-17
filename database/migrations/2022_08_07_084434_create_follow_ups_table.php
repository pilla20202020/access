<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_follow_ups', function (Blueprint $table) {
            $table->id();
            $table->string('follow_up_type');
            $table->bigInteger('refrence_id')->unsigned()->index()->nullable();
            $table->date('next_schedule')->nullable();
            $table->string('follow_up_name')->nullable();
            $table->string('follow_up_by')->nullable();
            $table->text('remarks')->nullable();
            $table->string('display_order')->nullable();
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
        Schema::dropIfExists('tbl_follow_ups');
    }
}
