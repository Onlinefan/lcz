<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldTypesFromFinancialStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('financial_status', function (Blueprint $table) {
            $table->float('contract_amount', 15, 2)->nullable()->change();
            $table->float('fulfilled_obligations', 15, 2)->nullable()->change();
            $table->float('amount_of_paid_work', 15, 2)->nullable()->change();
            $table->float('amount_revenue_contract', 15, 2)->nullable()->change();
            $table->float('project_costs', 15, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('financial_status', function (Blueprint $table) {
            $table->float('contract_amount')->nullable()->change();
            $table->float('fulfilled_obligations')->nullable()->change();
            $table->float('amount_of_paid_work')->nullable()->change();
            $table->float('amount_revenue_contract')->nullable()->change();
            $table->float('project_costs')->nullable()->change();
        });
    }
}
