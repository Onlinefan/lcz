<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToProductionPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('production_plan', function (Blueprint $table) {
            $table->integer('preliminary_calculation_equipment');
            $table->integer('final_calculation_equipment');
            $table->foreign('preliminary_calculation_equipment')->references('id')->on('files')->onDelete('cascade');
            $table->foreign('final_calculation_equipment')->references('id')->on('files')->onDelete('cascade');
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
            $table->dropForeign(['preliminary_calculation_equipment']);
            $table->dropForeign(['final_calculation_equipment']);
            $table->dropColumn('preliminary_calculation_equipment');
            $table->dropColumn('final_calculation_equipment');
        });
    }
}
