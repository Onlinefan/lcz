<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableFieldsToProductionPlanTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('production_plan', function (Blueprint $table) {
            $table->string('month')->nullable()->change();
            $table->integer('region_id')->nullable()->change();
            $table->integer('product_id')->nullable()->change();
            $table->integer('project_id')->nullable()->change();
            $table->integer('rk_count')->nullable()->change();
            $table->date('date_shipping')->nullable()->change();
            $table->string('priority')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('production_plan', function (Blueprint $table) {
            $table->string('month')->change();
            $table->integer('region_id')->change();
            $table->integer('product_id')->change();
            $table->integer('project_id')->change();
            $table->integer('rk_count')->change();
            $table->date('date_shipping')->change();
            $table->string('priority')->change();
        });
    }
}
