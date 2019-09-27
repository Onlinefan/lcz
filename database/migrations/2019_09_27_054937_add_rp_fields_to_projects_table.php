<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRpFieldsToProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->integer('realization_id')->nullable();
            $table->integer('exploitation_id')->nullable();
            $table->foreign('realization_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('exploitation_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['realization_id']);
            $table->dropForeign(['exploitation_id']);
            $table->dropColumn('realization_id');
            $table->dropColumn('exploitation_id');
        });
    }
}
