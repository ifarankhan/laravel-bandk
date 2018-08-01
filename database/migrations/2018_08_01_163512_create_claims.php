<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaims extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('claim_type_id');
            $table->integer('user_id');
            $table->string('estimate')->nullable();
            $table->dateTime('date')->nullable();
            $table->integer('claim_mechanic_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->text('description')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('claims');
    }
}
