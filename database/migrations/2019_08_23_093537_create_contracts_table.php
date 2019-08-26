<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('project_id');
            $table->integer('decree_number');
            $table->string('decree_scan');
            $table->date('date_start');
            $table->date('date_end');
            $table->date('date_sign_acts');
            $table->integer('number');
            $table->string('customer');
            $table->string('service_terms');
            $table->string('purchase_reference');
            $table->string('lcz_role');
            $table->string('article');
            $table->float('amount');
            $table->string('sign_status');
            $table->string('original_status');
            $table->string('project_charter');
            $table->string('plan_chart');
            $table->string('lop');
            $table->string('lpp');
            $table->string('file');
            $table->string('technical_task');
            $table->string('risks');
            $table->date('equipment_produce');
            $table->date('equipment_supply');
            $table->date('smr_start');
            $table->date('smr_end');
            $table->date('installation_start');
            $table->date('installation_end');
            $table->date('pnr_start');
            $table->date('pnr_end');
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
        Schema::dropIfExists('contracts');
    }
}
