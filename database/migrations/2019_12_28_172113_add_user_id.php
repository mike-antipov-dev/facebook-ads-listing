<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::table('adsets', function (Blueprint $table) {
            $table->bigInteger('user_id')->after('id');
        });

        Schema::table('ads', function (Blueprint $table) {
            $table->bigInteger('user_id')->after('id');
        });

        Schema::table('campaigns', function (Blueprint $table) {
            $table->bigInteger('user_id')->after('id');
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
            $table->dropColumn('user_id');
        });

        Schema::table('ads', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
