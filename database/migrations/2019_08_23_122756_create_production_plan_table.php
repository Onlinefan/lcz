<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductionPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_plan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('month');
            $table->integer('region_id');
            $table->integer('product_id');
            $table->integer('project_id');
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->integer('rk_count');
            $table->date('date_shipping');
            $table->integer('priority');
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
        Schema::dropIfExists('production_plan');
    }
}
