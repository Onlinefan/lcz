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
        Schema::create('documents_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('payment_document');
            $table->string('number_payment_document');
            $table->date('date_payment_document');
            $table->float('count_payment_document', 15, 2);
            $table->integer('scan_payment_document');
            $table->integer('contract_id');
            $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');
            $table->foreign('scan_payment_document')->references('id')->on('files')->onDelete('cascade');
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
        Schema::table('documents_status', function (Blueprint $table) {
            $table->dropForeign(['contract_id']);
            $table->dropForeign(['scan_payment_document']);
        });
        Schema::dropIfExists('documents_status');
    }
}
