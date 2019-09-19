<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableFieldsToProjectStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_status', function (Blueprint $table) {
            $table->string('system_id')->nullable()->change();
            $table->string('complex_id')->nullable()->change();
            $table->string('city')->nullable()->change();
            $table->string('address_contract')->nullable()->change();
            $table->string('address_gibdd')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_status', function (Blueprint $table) {
            $table->integer('system_id')->change();
            $table->integer('complex_id')->change();
            $table->string('city')->change();
            $table->string('address_contract')->change();
            $table->string('address_gibdd')->change();
        });
    }
}
