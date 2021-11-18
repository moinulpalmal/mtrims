<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductionTypeToProductionPlanDetailSetupsTableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('production_plan_detail_setups', function (Blueprint $table) {
            $table->string('production_type', 1)->default('I');
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
            $table->dropColumn(['production_type']);
        });
    }
}
