<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToCostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cost', function (Blueprint $table) {
            $table->string('payment_document');
            $table->string('number');
            $table->string('number_payment');
            $table->string('date_payment');
            $table->string('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cost', function (Blueprint $table) {
            $table->dropColumn(['payment_document', 'number', 'number_payment', 'date_payment', 'payment_method']);
        });
    }
}
