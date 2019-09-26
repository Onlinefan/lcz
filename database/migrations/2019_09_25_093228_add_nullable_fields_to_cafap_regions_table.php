<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableFieldsToCafapRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cafap_regions', function (Blueprint $table) {
            $table->integer('cafap_id')->nullable()->change();
            $table->integer('region_id')->nullable()->change();
            $table->integer('cafap_po')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cafap_regions', function (Blueprint $table) {
            $table->integer('cafap_id')->change();
            $table->integer('region_id')->change();
            $table->integer('cafap_po')->change();
        });
    }
}
