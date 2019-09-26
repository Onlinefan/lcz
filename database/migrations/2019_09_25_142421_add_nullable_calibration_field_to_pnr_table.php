<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableCalibrationFieldToPnrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pnr', function (Blueprint $table) {
            $table->integer('calibration_2000')->nullable()->change();
            $table->integer('kp')->nullable()->change();
            $table->integer('analysis_result')->nullable()->change();
            $table->integer('complex_to_monitoring')->nullable()->change();
            $table->integer('andromeda_unloading')->nullable()->change();
            $table->integer('in_cafap')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pnr', function (Blueprint $table) {
            $table->integer('calibration_2000')->change();
            $table->integer('kp')->change();
            $table->integer('analysis_result')->change();
            $table->integer('complex_to_monitoring')->change();
            $table->integer('andromeda_unloading')->change();
            $table->integer('in_cafap')->change();
        });
    }
}
