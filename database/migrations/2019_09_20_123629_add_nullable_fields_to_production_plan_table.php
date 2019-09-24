<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableFieldsToProductionPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('production_plan', function (Blueprint $table) {
            $table->integer('preliminary_calculation_equipment')->nullable()->change();
            $table->integer('final_calculation_equipment')->nullable()->change();
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
            $table->integer('preliminary_calculation_equipment')->change();
            $table->integer('final_calculation_equipment')->change();
        });
    }
}
