<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldToInitialDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('initial_data', function (Blueprint $table) {
            $table->integer('equipment_type')->change();
            $table->integer('road_type')->change();
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
            $table->string('equipment_type')->change();
            $table->string('road_type')->change();
        });
    }
}
