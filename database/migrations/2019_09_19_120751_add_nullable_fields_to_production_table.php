<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableFieldsToProductionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('production', function (Blueprint $table) {
            $table->integer('shipment_status')->change();
            $table->date('date_equipment_shipment')->nullable()->change();
            $table->string('number_sim_internet')->nullable()->change();
            $table->string('number_sim_ssu')->nullable()->change();
            $table->string('number_verification')->nullable()->change();
            $table->date('date_verification_end')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('production', function (Blueprint $table) {
            $table->string('shipment_status')->change();
            $table->date('date_equipment_shipment')->change();
            $table->integer('number_sim_internet')->change();
            $table->integer('number_sim_ssu')->change();
            $table->integer('number_verification')->change();
            $table->date('date_verification_end')->change();
        });
    }
}
