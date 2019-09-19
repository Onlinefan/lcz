<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableFieldsToInitialDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('initial_data', function (Blueprint $table) {
            $table->integer('speed_mode')->nullable()->change();
            $table->integer('borders_number')->nullable()->change();
            $table->integer('koap')->nullable()->change();
            $table->integer('stoplines_count')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('initial_data', function (Blueprint $table) {
            $table->integer('speed_mode')->change();
            $table->integer('borders_number')->change();
            $table->integer('koap')->change();
            $table->integer('stoplines_count')->change();
        });
    }
}
