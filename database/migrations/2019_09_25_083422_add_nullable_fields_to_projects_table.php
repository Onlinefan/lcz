<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableFieldsToProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('status')->nullable()->change();
            $table->string('name')->nullable()->change();
            $table->string('type')->nullable()->change();
            $table->integer('head_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('status')->change();
            $table->string('name')->change();
            $table->string('type')->change();
            $table->integer('head_id')->change();
        });
    }
}
