<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldTypesFromOtherContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('other_contracts', function (Blueprint $table) {
            $table->date('date_contract')->nullable()->change();
            $table->string('type')->nullable()->change();
            $table->string('number')->nullable()->change();
            $table->string('base')->nullable()->change();
            $table->string('contractor')->nullable()->change();
            $table->integer('contract')->nullable()->change();
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
        Schema::table('other_contracts', function (Blueprint $table) {
            $table->date('date_contract')->change();
            $table->string('type')->change();
            $table->string('number')->change();
            $table->string('base')->change();
            $table->string('contractor')->change();
            $table->integer('contract')->change();
            $table->integer('project_id')->change();
        });
    }
}
