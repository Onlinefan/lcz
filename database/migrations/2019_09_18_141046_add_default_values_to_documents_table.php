<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultValuesToDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->string('examination')->default('Отсутствует')->change();
            $table->string('project_documentation')->default('Не требуется')->change();
            $table->string('executive_documentation')->default('Не требуется')->change();
            $table->string('verification')->default('Отсутствует')->change();
            $table->string('forms')->default('Отсутствует')->change();
            $table->string('passports')->default('Отсутствует')->change();
            $table->string('tu_220')->default('Не требуется')->change();
            $table->string('contract_220')->default('Не требуется')->change();
            $table->string('tu_footing')->default('Не требуется')->change();
            $table->string('contract_footing')->default('Не требуется')->change();
            $table->string('address_plan_agreed_cafap')->default('Отсутствует')->change();
            $table->string('data_transfer_scheme')->default('Отсутствует')->change();
            $table->string('inbox')->default('Отсутствует')->change();
            $table->string('outgoing')->default('Отсутствует')->change();
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
            //
        });
    }
}
