<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldsFromIncomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('income', function (Blueprint $table) {
            $table->dropColumn('comment');
            $table->dropColumn('payment_method');
            $table->dropColumn('is_payed');
            $table->string('payment_status')->nullable();
            $table->integer('closed_document')->nullable();
            $table->integer('document')->nullable()->change();
            $table->string('document_number')->nullable();
            $table->string('stage')->nullable();
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
            $table->string('comment');
            $table->string('payment_method');
            $table->boolean('is_payed');
            $table->dropColumn('payment_status')->nullable();
            $table->dropColumn('closed_document')->nullable();
            $table->integer('document')->change();
            $table->dropColumn('document_number')->nullable();
            $table->dropColumn('stage')->nullable();
        });
    }
}
