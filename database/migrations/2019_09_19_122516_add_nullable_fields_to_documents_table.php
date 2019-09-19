<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableFieldsToDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->string('examination')->nullable()->change();
            $table->string('project_documentation')->nullable()->change();
            $table->string('executive_documentation')->nullable()->change();
            $table->string('verification')->nullable()->change();
            $table->string('forms')->nullable()->change();
            $table->string('passports')->nullable()->change();
            $table->string('tu_220')->nullable()->change();
            $table->string('contract_220')->nullable()->change();
            $table->string('tu_footing')->nullable()->change();
            $table->string('contract_footing')->nullable()->change();
            $table->string('address_plan_agreed_cafap')->nullable()->change();
            $table->string('data_transfer_scheme')->nullable()->change();
            $table->string('inbox')->nullable()->change();
            $table->string('outgoing')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->string('examination')->change();
            $table->string('project_documentation')->change();
            $table->string('executive_documentation')->change();
            $table->string('verification')->change();
            $table->string('forms')->change();
            $table->string('passports')->change();
            $table->string('tu_220')->change();
            $table->string('contract_220')->change();
            $table->string('tu_footing')->change();
            $table->string('contract_footing')->change();
            $table->string('address_plan_agreed_cafap')->change();
            $table->string('data_transfer_scheme')->change();
            $table->string('inbox')->change();
            $table->string('outgoing')->change();
        });
    }
}
