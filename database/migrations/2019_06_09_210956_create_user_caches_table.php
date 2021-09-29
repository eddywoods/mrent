<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_caches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('surname');
            $table->string('other_name');
            $table->string('id_number');
            $table->string('gender');
            $table->string('first_name');
            $table->string('dob');
            $table->string('citizenship');
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
        Schema::dropIfExists('user_caches');
    }
}
