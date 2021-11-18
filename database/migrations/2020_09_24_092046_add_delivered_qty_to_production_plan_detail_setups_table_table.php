<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveredQtyToProductionPlanDetailSetupsTableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('production_plan_detail_setups', function (Blueprint $table) {
            $table->float('delivered_production', 12, 5)->default(0);
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
            $table->dropColumn(['delivered_production']);
        });
    }
}
