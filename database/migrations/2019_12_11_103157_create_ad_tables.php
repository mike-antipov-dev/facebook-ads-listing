<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->bigInteger('account_id');
            $table->string('name', 100);
            $table->timestamps();
        });

        Schema::create('adsets', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->bigInteger('campaign_id');
            $table->string('name', 100);
            $table->timestamps();
        });

        Schema::create('ads', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->bigInteger('campaign_id');
            $table->bigInteger('adset_id');
            $table->string('name', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
        Schema::dropIfExists('adsets');
        Schema::dropIfExists('ads');
    }
}
