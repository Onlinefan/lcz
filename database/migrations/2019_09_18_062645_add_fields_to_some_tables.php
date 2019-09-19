<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToSomeTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_status', function (Blueprint $table) {
            $table->integer('region_id');
            $table->foreign('region_id')->references('id')->on('region')->onDelete('cascade');
        });
        Schema::table('initial_data', function (Blueprint $table) {
            $table->integer('region_id');
            $table->foreign('region_id')->references('id')->on('region')->onDelete('cascade');
        });
        Schema::table('pir', function (Blueprint $table) {
            $table->integer('region_id');
            $table->foreign('region_id')->references('id')->on('region')->onDelete('cascade');
        });
        Schema::table('production', function (Blueprint $table) {
            $table->integer('region_id');
            $table->foreign('region_id')->references('id')->on('region')->onDelete('cascade');
        });
        Schema::table('smr_installation', function (Blueprint $table) {
            $table->integer('region_id');
            $table->foreign('region_id')->references('id')->on('region')->onDelete('cascade');
        });
        Schema::table('pnr', function (Blueprint $table) {
            $table->integer('region_id');
            $table->foreign('region_id')->references('id')->on('region')->onDelete('cascade');
        });
        Schema::table('documents', function (Blueprint $table) {
            $table->integer('region_id');
            $table->foreign('region_id')->references('id')->on('region')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_status', function (Blueprint $table) {
            $table->dropForeign(['region_id']);
            $table->dropColumn(['region_id']);
        });
        Schema::table('initial_data', function (Blueprint $table) {
            $table->dropForeign(['region_id']);
            $table->dropColumn(['region_id']);
        });
        Schema::table('pir', function (Blueprint $table) {
            $table->dropForeign(['region_id']);
            $table->dropColumn(['region_id']);
        });
        Schema::table('production', function (Blueprint $table) {
            $table->dropForeign(['region_id']);
            $table->dropColumn(['region_id']);
        });
        Schema::table('smr_installation', function (Blueprint $table) {
            $table->dropForeign(['region_id']);
            $table->dropColumn(['region_id']);
        });
        Schema::table('pnr', function (Blueprint $table) {
            $table->dropForeign(['region_id']);
            $table->dropColumn(['region_id']);
        });
        Schema::table('documents', function (Blueprint $table) {
            $table->dropForeign(['region_id']);
            $table->dropColumn(['region_id']);
        });
    }
}
