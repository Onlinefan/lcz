<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents_service_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('payment_document');
            $table->integer('number_payment_document');
            $table->date('date_payment_document');
            $table->float('count_payment_document');
            $table->string('scan_payment_document');
            $table->integer('contract_id');
            $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');
            $table->boolean('is_documents');
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
        Schema::dropIfExists('documents_service_status');
    }
}
