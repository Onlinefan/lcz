<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableFieldsToContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('fio')->nullable()->change();
            $table->string('position')->nullable()->change();
            $table->string('mobile_number')->nullable()->change();
            $table->string('work_number')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('company')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('fio')->change();
            $table->string('position')->change();
            $table->string('mobile_number')->change();
            $table->string('work_number')->change();
            $table->string('email')->change();
            $table->string('address')->change();
            $table->string('company')->change();
        });
    }
}
