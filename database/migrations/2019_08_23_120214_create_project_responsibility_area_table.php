<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectResponsibilityAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_responsibility_area', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('project_id');
            $table->foreign('project_id')->references('id')->on('projects');
            $table->string('examination');
            $table->string('smr');
            $table->string('installation');
            $table->string('pnr');
            $table->string('support_permission');
            $table->string('tu_220');
            $table->string('tu_communication');
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
        Schema::dropIfExists('project_responsibility_area');
    }
}
