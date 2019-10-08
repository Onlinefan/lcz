<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SwapFieldsFromCountriesTableToRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('code');
        });
        Schema::table('regions', function (Blueprint $table) {
            $table->string('code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('countries', function (Blueprint $table) {
            Schema::table('countries', function (Blueprint $table) {
                $table->string('code')->nullable();
            });
            Schema::table('regions', function (Blueprint $table) {
                $table->dropColumn('code');
            });
        });
    }
}
