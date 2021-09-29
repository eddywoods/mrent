<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tenant_id')->nullable();
            $table->bigInteger('building_id')->nullable();
            $table->string('amount_due');
            $table->string('amount_paid');
            $table->string('bill_type')->nullable();
            $table->string('unit_number');
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
        Schema::dropIfExists('tenant_transactions');
    }
}
