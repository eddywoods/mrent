<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('tenant_id')->nullable();
            $table->string('phone')->nullable();
            $table->integer('amount');
            $table->string('account');
            $table->string('transaction_number')->nullable();
            $table->dateTime('transaction_date');
            $table->string('payment_reason');
            $table->boolean('processed')->default(0);
            $table->boolean('confirmed')->default(0);
            $table->string('payment_method')->nullable();
            $table->string('utility_type')->nullable();
            $table->string('payment_description')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
