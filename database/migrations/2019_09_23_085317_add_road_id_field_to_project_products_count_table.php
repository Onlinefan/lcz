<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoadIdFieldToProjectProductsCountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_products_count', function (Blueprint $table) {
            $table->integer('road_id');
            $table->foreign('road_id')->references('id')->on('road_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_products_count', function (Blueprint $table) {
            $table->dropForeign(['road_id']);
            $table->dropColumn('road_id');
        });
    }
}
