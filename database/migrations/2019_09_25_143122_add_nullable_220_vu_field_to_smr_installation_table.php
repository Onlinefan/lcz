<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullable220VuFieldToSmrInstallationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smr_installation', function (Blueprint $table) {
            $table->integer('220_vu')->nullable()->change();
            $table->integer('link_contract')->nullable()->change();
            $table->integer('dislocation_strapping')->nullable()->change();
            $table->integer('installation_status')->nullable()->change();
            $table->integer('transferred_pnr')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smr_installation', function (Blueprint $table) {
            $table->integer('220_vu')->change();
            $table->integer('link_contract')->change();
            $table->integer('dislocation_strapping')->change();
            $table->integer('installation_status')->change();
            $table->integer('transferred_pnr')->change();
        });
    }
}
