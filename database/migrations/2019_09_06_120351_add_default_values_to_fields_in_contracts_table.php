<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultValuesToFieldsInContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->string('equipment_produce')->default('Не требуется')->change();
            $table->string('equipment_supply')->default('Не требуется')->change();
            $table->string('smr_start')->default('Не требуется')->change();
            $table->string('smr_end')->default('Не требуется')->change();
            $table->string('installation_start')->default('Не требуется')->change();
            $table->string('installation_end')->default('Не требуется')->change();
            $table->string('pnr_start')->default('Не требуется')->change();
            $table->string('pnr_end')->default('Не требуется')->change();
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
            $table->date('equipment_produce')->default('1970-12-31')->change();
            $table->date('equipment_supply')->default('1970-12-31')->change();
            $table->date('smr_start')->default('1970-12-31')->change();
            $table->date('smr_end')->default('1970-12-31')->change();
            $table->date('installation_start')->default('1970-12-31')->change();
            $table->date('installation_end')->default('1970-12-31')->change();
            $table->date('pnr_start')->default('1970-12-31')->change();
            $table->date('pnr_end')->default('1970-12-31')->change();
        });
    }
}
