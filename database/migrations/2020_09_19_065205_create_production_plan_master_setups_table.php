<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionPlanMasterSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_plan_master_setups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('production_date');

            $table->float('machine_cost_in_usd', 12, 5)->default(0);
            $table->float('material_cost_in_usd', 12, 5)->default(0);
            $table->float('total_cost_in_usd', 12, 5)->default(0);
            $table->float('total_revenue_in_usd', 12, 5)->default(0);
            $table->float('total_profit_in_usd', 12, 5)->default(0);

            $table->integer('total_machine');
            $table->integer('total_running_machine');
            $table->integer('total_idle_machine');

            $table->bigInteger('inserted_by');
            $table->bigInteger('updated_by')->nullable();
            $table->string('status', 4)->default('A');

            $table->text('remarks')->nullable();

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
        Schema::dropIfExists('production_plan_master_setups');
    }
}
