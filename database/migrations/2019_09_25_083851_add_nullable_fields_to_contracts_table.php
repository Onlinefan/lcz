<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableFieldsToContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->string('decree_number')->nullable()->change();
            $table->integer('decree_scan')->nullable()->change();
            $table->date('date_start')->nullable()->change();
            $table->date('date_end')->nullable()->change();
            $table->date('date_sign_acts')->nullable()->change();
            $table->string('number')->nullable()->change();
            $table->string('customer')->nullable()->change();
            $table->string('service_terms')->nullable()->change();
            $table->string('purchase_reference')->nullable()->change();
            $table->string('lcz_role')->nullable()->change();
            $table->string('article')->nullable()->change();
            $table->string('amount')->nullable()->change();
            $table->string('sign_status')->nullable()->change();
            $table->string('original_status')->nullable()->change();
            $table->integer('project_charter')->nullable()->change();
            $table->integer('plan_chart')->nullable()->change();
            $table->integer('lop')->nullable()->change();
            $table->integer('file')->nullable()->change();
            $table->integer('technical_task')->nullable()->change();
            $table->integer('risks')->nullable()->change();
            $table->string('equipment_produce')->nullable()->change();
            $table->string('equipment_supply')->nullable()->change();
            $table->string('smr_start')->nullable()->change();
            $table->string('smr_end')->nullable()->change();
            $table->string('installation_start')->nullable()->change();
            $table->string('installation_end')->nullable()->change();
            $table->string('pnr_start')->nullable()->change();
            $table->string('pnr_end')->nullable()->change();
            $table->integer('decision_sheet')->nullable()->change();
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
            $table->string('decree_number')->change();
            $table->integer('decree_scan')->change();
            $table->date('date_start')->change();
            $table->date('date_end')->change();
            $table->date('date_sign_acts')->change();
            $table->string('number')->change();
            $table->string('customer')->change();
            $table->string('service_terms')->change();
            $table->string('purchase_reference')->change();
            $table->string('lcz_role')->change();
            $table->string('article')->change();
            $table->string('amount')->change();
            $table->string('sign_status')->change();
            $table->string('original_status')->change();
            $table->integer('project_charter')->change();
            $table->integer('plan_chart')->change();
            $table->integer('lop')->change();
            $table->integer('file')->change();
            $table->integer('technical_task')->change();
            $table->integer('risks')->change();
            $table->string('equipment_produce')->change();
            $table->string('equipment_supply')->change();
            $table->string('smr_start')->change();
            $table->string('smr_end')->change();
            $table->string('installation_start')->change();
            $table->string('installation_end')->change();
            $table->string('pnr_start')->change();
            $table->string('pnr_end')->change();
            $table->integer('decision_sheet')->change();
        });
    }
}
