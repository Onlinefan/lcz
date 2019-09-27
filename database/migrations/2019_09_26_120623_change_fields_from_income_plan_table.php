<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldsFromIncomePlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('income_plan', function (Blueprint $table) {
            $table->dropColumn('stage');
            $table->dropColumn('count');
            $table->dropColumn('payed');
            $table->date('income_date')->nullable()->change();
            $table->string('name')->nullable()->change();
            $table->float('plan', 15, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('income_plan', function (Blueprint $table) {
            $table->string('stage')->nullable()->change();
            $table->float('count', 15, 2)->nullable()->change();
            $table->float('payed', 15, 2)->nullable()->change();
            $table->date('income_date')->change();
            $table->string('name')->change();
            $table->float('plan', 15, 2)->change();
        });
    }
}
