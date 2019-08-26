<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinancialStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('contract_amount');
            $table->float('fulfilled_obligations');
            $table->float('amount_of_paid_work');
            $table->float('amount_revenue_contract');
            $table->float('project_costs');
            $table->integer('contract_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financial_status');
    }
}
