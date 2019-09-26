<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeIncomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('income', function (Blueprint $table) {
            $table->dropColumn('payment_document');
            $table->dropColumn('number');
            $table->dropColumn('number_payment');
            $table->boolean('is_payed')->nullable();
            $table->string('payment_method')->nullable();
            $table->float('count', 15, 2)->nullable()->change();
            $table->integer('document')->nullable()->change();
            $table->string('comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('income', function (Blueprint $table) {
            $table->string('payment_document');
            $table->string('number');
            $table->string('number_payment');
            $table->dropColumn('is_payed');
            $table->dropColumn('payment_method');
            $table->float('count', 15, 2)->change();
            $table->integer('document')->change();
            $table->dropColumn('comment');
        });
    }
}
