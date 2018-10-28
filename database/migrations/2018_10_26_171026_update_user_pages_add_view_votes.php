<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserPagesAddViewVotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('userpages', function (Blueprint $table) {
            $table->string('summary');
            $table->integer('views')->default(1);
            $table->integer('vote_positive')->default(0);
            $table->integer('vote_negative')->default(0);
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
            $table->dropColumn('summary');
            $table->dropColumn('views');
            $table->dropColumn('vote_positive');
            $table->dropColumn('vote_negative');
        });
    }
}
