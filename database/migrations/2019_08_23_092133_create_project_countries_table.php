<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('project_id');
            $table->integer('country_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('country')->onDelete('cascade');
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
        Schema::dropIfExists('project_countries');
    }
}
