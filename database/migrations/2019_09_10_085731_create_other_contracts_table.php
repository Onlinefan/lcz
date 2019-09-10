<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtherContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date_contract');
            $table->string('type');
            $table->string('number');
            $table->string('base');
            $table->string('contractor');
            $table->integer('contract');
            $table->foreign('contract')->references('id')->on('files')->onDelete('cascade');
            $table->integer('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('other_contracts', function (Blueprint $table) {
            $table->dropForeign(['contract']);
            $table->dropForeign(['project_id']);
        });
        Schema::dropIfExists('other_contracts');
    }
}
