<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('buildings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('building_name');
            $table->string('contact_number');
            $table->string('bank_id');
            $table->string('location');
            $table->string('invoicing_date');
            $table->bigInteger('owned_by')->unsigned()->nullable();
            $table->foreign('owned_by')->references('id')->on('users')->onDelete('cascade');
            $table->string('account_number')->nullable();
            $table->double('address_latitude')->nullable();
            $table->double('address_longitude')->nullable();
            $table->string('grouping_type')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('buildings');
    }
}
