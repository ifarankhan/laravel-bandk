<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpadteAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->string('zip_code')->nullable();
            $table->string('city')->nullable();
            $table->string('build_year')->nullable();
            $table->string('m2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn('zip_code');
            $table->dropColumn('city');
            $table->dropColumn('build_year');
            $table->dropColumn('m2');
        });
    }
}
