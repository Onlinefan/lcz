<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePnrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pnr', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('calibration_2000');
            $table->string('kp');
            $table->string('analysis_result');
            $table->string('complex_to_monitoring');
            $table->boolean('andromeda_unloading');
            $table->boolean('unloading');
            $table->boolean('in_cafap');
            $table->integer('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pnr');
    }
}
