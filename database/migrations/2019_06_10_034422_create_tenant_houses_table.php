<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_houses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('building_id')->nullable();
            $table->string('pricing_id')->nullable();
            $table->bigInteger('tenant_id')->nullable();
            $table->string('unit_number')->nullable();
            $table->string('account_number')->nullable();
            $table->string('tenant_deposit_amount')->nullable();
            $table->string('tenant_rent_amount')->nullable();
            $table->string('unit_id')->nullable();
            $table->string('entry_date')->nullable();
            $table->string('occupancy_status')->default(0);
            $table->string('vacate_date')->nullable();
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
        Schema::dropIfExists('tenant_houses');
    }
}
