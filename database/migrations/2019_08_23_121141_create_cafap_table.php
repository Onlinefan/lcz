<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCafapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cafap', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('data_transfer_scheme');
            $table->string('location_directions');
            $table->string('speed_mode');
            $table->boolean('andromeda_exists');
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
        Schema::dropIfExists('cafap');
    }
}
