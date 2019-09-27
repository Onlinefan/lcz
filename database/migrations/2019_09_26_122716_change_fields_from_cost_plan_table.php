<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldsFromCostPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cost_plan', function (Blueprint $table) {
            $table->dropColumn('date_cost');
            $table->dropColumn('count');
            $table->dropColumn('comment');
            $table->dropColumn('payment_method');
            $table->string('article')->nullable()->change();
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
            $table->date('date_cost')->nullable();
            $table->float('count', 15, 2)->nullable();
            $table->string('comment')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('article')->change();
            $table->float('plan', 15, 2)->change();
        });
    }
}
