<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFileFieldsInCafapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cafap', function (Blueprint $table) {
            $table->integer('data_transfer_scheme')->change();
            $table->integer('location_directions')->change();
            $table->integer('speed_mode')->change();
            $table->foreign('data_transfer_scheme')->references('id')->on('files')->onDelete('cascade');
            $table->foreign('location_directions')->references('id')->on('files')->onDelete('cascade');
            $table->foreign('speed_mode')->references('id')->on('files')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cafap', function (Blueprint $table) {
            $table->dropForeign(['data_transfer_scheme']);
            $table->dropForeign(['location_directions']);
            $table->dropForeign(['speed_mode']);
            $table->string('data_transfer_scheme')->change();
            $table->string('location_directions')->change();
            $table->string('speed_mode')->change();
        });
    }
}
