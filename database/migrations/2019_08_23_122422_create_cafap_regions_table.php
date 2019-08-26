<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCafapRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cafap_regions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cafap_id');
            $table->integer('region_id');
            $table->foreign('cafap_id')->references('id')->on('cafap');
            $table->foreign('region_id')->references('id')->on('regions');
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
        Schema::dropIfExists('cafap_regions');
    }
}
