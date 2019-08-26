<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCafapCollageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cafap_collage', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cafap_id');
            $table->foreign('cafap_id')->references('id')->on('cafap')->onDelete('cascade');
            $table->string('file');
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
        Schema::dropIfExists('cafap_collage');
    }
}
