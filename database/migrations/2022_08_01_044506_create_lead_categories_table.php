<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_lead_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alias')->nullable();
            $table->string('color_code');
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
        Schema::dropIfExists('tbl_lead_categories');
    }
}
