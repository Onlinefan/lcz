<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldTypesFromIncomePlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('income_plan', function (Blueprint $table) {
            $table->float('count', 15, 2)->nullable()->change();
            $table->float('plan', 15, 2)->nullable()->change();
            $table->float('payed', 15, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('income_plan', function (Blueprint $table) {
            $table->float('count')->nullable()->change();
            $table->float('plan')->nullable()->change();
            $table->float('payed')->nullable()->change();
        });
    }
}
