<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInsights extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::table('adsets', function (Blueprint $table) {
            $table->string('action_values')->after('name')->nullable();
            $table->string('clicks')->after('name')->nullable();
            $table->string('conversion_values')->after('name')->nullable();
        });

        Schema::table('ads', function (Blueprint $table) {
            $table->string('action_values')->after('name')->nullable();
            $table->string('clicks')->after('name')->nullable();
            $table->string('conversion_values')->after('name')->nullable();
        });

        Schema::table('campaigns', function (Blueprint $table) {
            $table->string('action_values')->after('name')->nullable();
            $table->string('clicks')->after('name')->nullable();
            $table->string('conversion_values')->after('name')->nullable();
            $table->string('buying_type')->after('name')->nullable();
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
            $table->dropColumn('action_values');
            $table->dropColumn('clicks');
            $table->dropColumn('conversion_values');
        });

        Schema::table('ads', function (Blueprint $table) {
            $table->dropColumn('action_values');
            $table->dropColumn('clicks');
            $table->dropColumn('conversion_values');
        });

        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn('action_values');
            $table->dropColumn('clicks');
            $table->dropColumn('conversion_values');
            $table->dropColumn('buying_type');
        });
    }
}
