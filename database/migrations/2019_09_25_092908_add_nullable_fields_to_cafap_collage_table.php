<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableFieldsToCafapCollageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cafap_collage', function (Blueprint $table) {
            $table->integer('cafap_id')->nullable()->change();
            $table->integer('file')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cafap_collage', function (Blueprint $table) {
            $table->integer('cafap_id')->change();
            $table->integer('file')->change();
        });
    }
}
