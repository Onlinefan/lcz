<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('examination');
            $table->string('project_documentation');
            $table->string('executive_documentation');
            $table->string('verification');
            $table->string('forms');
            $table->string('passports');
            $table->string('tu_220');
            $table->string('contract_220');
            $table->string('tu_footing');
            $table->string('contract_footing');
            $table->string('address_plan_agreed_cafap');
            $table->string('data_transfer_scheme');
            $table->string('inbox');
            $table->string('outgoing');
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
        Schema::dropIfExists('documents');
    }
}
