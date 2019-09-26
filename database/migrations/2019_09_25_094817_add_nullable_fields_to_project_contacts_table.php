<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableFieldsToProjectContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_contacts', function (Blueprint $table) {
            $table->integer('contact_id')->nullable()->change();
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
        Schema::table('project_contacts', function (Blueprint $table) {
            $table->integer('contact_id')->change();
            $table->integer('project_id')->change();
        });
    }
}
