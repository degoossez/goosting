<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStyleToUserpages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('userpages', function (Blueprint $table) {
            $table->string('styleSheet')->default('goostingDefault');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('userpages', function (Blueprint $table) {
            $table->dropColumn('styleSheet');
        });
    }
}
