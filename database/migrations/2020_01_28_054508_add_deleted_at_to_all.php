<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeletedAtToAll extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('companies', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('claim_conversations', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('claim_conversation_files', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('claim_images', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('teams', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('user_companies', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('addresses', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('claim_types', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('claim_mechanics', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('contents', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->dropColumn('deleted_at ');
        });
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('deleted_at ');
        });
        Schema::table('claim_conversations', function (Blueprint $table) {
            $table->dropColumn('deleted_at ');
        });
        Schema::table('claim_images', function (Blueprint $table) {
            $table->dropColumn('deleted_at ');
        });
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('deleted_at ');
        });
        Schema::table('claim_conversation_files', function (Blueprint $table) {
            $table->dropColumn('deleted_at ');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('deleted_at ');
        });
        Schema::table('user_companies', function (Blueprint $table) {
            $table->dropColumn('deleted_at ');
        });
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn('deleted_at ');
        });
        Schema::table('claim_types', function (Blueprint $table) {
            $table->dropColumn('deleted_at ');
        });
        Schema::table('claim_mechanics', function (Blueprint $table) {
            $table->dropColumn('deleted_at ');
        });
        Schema::table('contents', function (Blueprint $table) {
            $table->dropColumn('deleted_at ');
        });
    }
}
