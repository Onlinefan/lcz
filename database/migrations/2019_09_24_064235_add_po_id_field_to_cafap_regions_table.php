<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPoIdFieldToCafapRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cafap_regions', function (Blueprint $table) {
            $table->integer('cafap_po');
            $table->foreign('cafap_po')->references('id')->on('cafap_region_po')->onDelete('cascade');
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
            $table->dropForeign(['cafap_po']);
            $table->dropColumn('cafap_po');
        });
    }
}
