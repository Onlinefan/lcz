<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pir', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('survey_status');
            $table->string('survey_comment');
            $table->string('design_documentation');
            $table->string('new_footing_fvf');
            $table->string('new_footing_lep');
            $table->integer('rk_count');
            $table->integer('ok_count');
            $table->float('equipment_power');
            $table->string('request_tu');
            $table->string('request_footing');
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
        Schema::dropIfExists('pir');
    }
}
