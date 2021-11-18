<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLeftOverInfoProductionPlanDetailSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('production_plan_detail_setups', function (Blueprint $table) {
            $table->boolean('is_left_over_stored')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('production_plan_detail_setups', function (Blueprint $table) {
            $table->dropColumn(['is_left_over_stored']);
        });
    }
}
