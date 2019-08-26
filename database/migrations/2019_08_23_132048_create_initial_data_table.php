<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('initial_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('equipment_type');
            $table->string('road_type');
            $table->integer('speed_mode');
            $table->integer('borders_number');
            $table->integer('koap');
            $table->integer('stoplines_count');
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
        Schema::dropIfExists('initial_data');
    }
}
