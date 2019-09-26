<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableFieldsToCafapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cafap', function (Blueprint $table) {
            $table->integer('data_transfer_scheme')->nullable()->change();
            $table->integer('location_directions')->nullable()->change();
            $table->integer('speed_mode')->nullable()->change();
            $table->integer('project_id')->nullable()->change();
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
            $table->integer('data_transfer_scheme')->change();
            $table->integer('location_directions')->change();
            $table->integer('speed_mode')->change();
            $table->integer('project_id')->change();
        });
    }
}
