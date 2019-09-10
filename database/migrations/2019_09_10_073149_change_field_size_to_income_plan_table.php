<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldSizeToIncomePlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('income_plan', function (Blueprint $table) {
            $table->float('plan', 15, 2)->change();
            $table->float('count', 15, 2)->change();
            $table->float('payed', 15, 2)->change();
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
            $table->float('plan')->change();
            $table->float('count')->change();
            $table->float('payed')->change();
        });
    }
}
