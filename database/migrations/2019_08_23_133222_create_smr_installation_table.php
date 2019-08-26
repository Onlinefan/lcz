<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmrInstallationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smr_installation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('link_root_task');
            $table->string('220_vu');
            $table->string('link_contract');
            $table->string('dislocation_strapping');
            $table->string('installation_status');
            $table->string('transferred_pnr');
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
        Schema::dropIfExists('smr_installation');
    }
}
