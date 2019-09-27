<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldsFromCostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cost', function (Blueprint $table) {
            $table->date('date_payment')->nullable()->change();
            $table->float('count', 15, 2)->nullable()->change();
            $table->string('comment')->nullable()->change();
            $table->string('payment_method')->nullable()->change();
            $table->dropColumn('document');
            $table->dropColumn('payment_document');
            $table->dropColumn('number_payment');
            $table->dropColumn('number');
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
            $table->date('date_payment')->change();
            $table->float('count', 15, 2)->change();
            $table->string('comment')->change();
            $table->string('payment_method')->change();
            $table->integer('document');
            $table->integer('payment_document');
            $table->string('number_payment');
            $table->string('number');
        });
    }
}
