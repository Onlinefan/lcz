<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableEquipmentTypeFieldToInitialDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('initial_data', function (Blueprint $table) {
            $table->integer('equipment_type')->nullable()->change();
            $table->integer('road_type')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('initial_data', function (Blueprint $table) {
            $table->integer('equipment_type')->change();
            $table->integer('road_type')->nullable()->change();
        });
    }
}
