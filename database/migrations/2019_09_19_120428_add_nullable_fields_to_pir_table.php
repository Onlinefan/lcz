<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableFieldsToPirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pir', function (Blueprint $table) {
            $table->string('survey_status')->nullable()->change();
            $table->string('survey_comment')->nullable()->change();
            $table->string('design_documentation')->nullable()->change();
            $table->string('new_footing_fvf')->nullable()->change();
            $table->string('new_footing_lep')->nullable()->change();
            $table->integer('rk_count')->nullable()->change();
            $table->integer('ok_count')->nullable()->change();
            $table->float('equipment_power', 15, 2)->nullable()->change();
            $table->string('request_tu')->nullable()->change();
            $table->string('request_footing')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pir', function (Blueprint $table) {
            $table->string('survey_status')->change();
            $table->string('survey_comment')->change();
            $table->string('design_documentation')->change();
            $table->string('new_footing_fvf')->change();
            $table->string('new_footing_lep')->change();
            $table->integer('rk_count')->change();
            $table->integer('ok_count')->change();
            $table->float('equipment_power')->change();
            $table->string('request_tu')->change();
            $table->string('request_footing')->change();
        });
    }
}
