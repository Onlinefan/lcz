<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableFieldsToProjectResponsibilityAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_responsibility_area', function (Blueprint $table) {
            $table->integer('project_id')->nullable()->change();
            $table->string('examination')->nullable()->change();
            $table->string('smr')->nullable()->change();
            $table->string('installation')->nullable()->change();
            $table->string('pnr')->nullable()->change();
            $table->string('support_permission')->nullable()->change();
            $table->string('tu_220')->nullable()->change();
            $table->string('tu_communication')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_responsibility_area', function (Blueprint $table) {
            $table->integer('project_id')->change();
            $table->string('examination')->change();
            $table->string('smr')->change();
            $table->string('installation')->change();
            $table->string('pnr')->change();
            $table->string('support_permission')->change();
            $table->string('tu_220')->change();
            $table->string('tu_communication')->change();
        });
    }
}
