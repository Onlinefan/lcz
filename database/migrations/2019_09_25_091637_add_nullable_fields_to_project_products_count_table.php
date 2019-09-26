<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableFieldsToProjectProductsCountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_products_count', function (Blueprint $table) {
            $table->integer('count')->nullable()->change();
            $table->integer('product_id')->nullable()->change();
            $table->integer('project_id')->nullable()->change();
            $table->integer('road_id')->nullable()->change();
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
            $table->integer('count')->change();
            $table->integer('product_id')->change();
            $table->integer('project_id')->change();
            $table->integer('road_id')->change();
        });
    }
}
