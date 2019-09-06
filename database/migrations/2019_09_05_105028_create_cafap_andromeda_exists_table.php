<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCafapAndromedaExistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cafap_andromeda_exists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('region_id');
            $table->integer('cafap_id');
            $table->boolean('exist');
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
            $table->foreign('cafap_id')->references('id')->on('cafap')->onDelete('cascade');
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
        Schema::table('cafap_andromeda_exists', function (Blueprint $table) {
            $table->dropForeign('cafap_andromeda_exists_region_id_foreign');
            $table->dropForeign('cafap_andromeda_exists_cafap_id_foreign');
        });
        Schema::dropIfExists('cafap_andromeda_exists');
    }
}
