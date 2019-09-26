<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldTypesFromCostPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cost_plan', function (Blueprint $table) {
            $table->float('count', 15, 2)->nullable()->change();
            $table->float('plan', 15, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cost_plan', function (Blueprint $table) {
            $table->float('count')->nullable()->change();
            $table->float('plan')->nullable()->change();
        });
    }
}
