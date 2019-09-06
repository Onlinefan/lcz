<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFileFieldsInContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->integer('decree_scan')->change();
            $table->integer('project_charter')->change();
            $table->integer('plan_chart')->change();
            $table->integer('lop')->change();
            $table->integer('lpp')->change();
            $table->integer('file')->change();
            $table->integer('technical_task')->change();
            $table->integer('risks')->change();
            $table->foreign('decree_scan')->references('id')->on('files')->onDelete('cascade');
            $table->foreign('project_charter')->references('id')->on('files')->onDelete('cascade');
            $table->foreign('plan_chart')->references('id')->on('files')->onDelete('cascade');
            $table->foreign('lop')->references('id')->on('files')->onDelete('cascade');
            $table->foreign('lpp')->references('id')->on('files')->onDelete('cascade');
            $table->foreign('file')->references('id')->on('files')->onDelete('cascade');
            $table->foreign('technical_task')->references('id')->on('files')->onDelete('cascade');
            $table->foreign('risks')->references('id')->on('files')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropForeign(['decree_scan']);
            $table->dropForeign(['project_charter']);
            $table->dropForeign(['plan_chart']);
            $table->dropForeign(['lop']);
            $table->dropForeign(['lpp']);
            $table->dropForeign(['file']);
            $table->dropForeign(['technical_task']);
            $table->dropForeign(['risks']);
            $table->string('decree_scan')->change();
            $table->string('project_charter')->change();
            $table->string('plan_chart')->change();
            $table->string('lop')->change();
            $table->string('lpp')->change();
            $table->string('file')->change();
            $table->string('technical_task')->change();
            $table->string('risks')->change();
        });
    }
}
