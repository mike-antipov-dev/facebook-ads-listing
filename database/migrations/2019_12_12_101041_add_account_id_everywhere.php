<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccountIdEverywhere extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adsets', function (Blueprint $table) {
            $table->bigInteger('account_id')->after('id');
        });

        Schema::table('ads', function (Blueprint $table) {
            $table->bigInteger('account_id')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adsets', function (Blueprint $table) {
            $table->dropColumn('account_id');
        });

        Schema::table('ads', function (Blueprint $table) {
            $table->dropColumn('account_id');
        });
    }
}
