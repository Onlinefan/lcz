<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cost_plan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('plan');
            $table->string('article');
            $table->date('date_cost');
            $table->float('count');
            $table->string('comment');
            $table->string('payment_method');
            $table->integer('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::dropIfExists('cost_plan');
    }
}
