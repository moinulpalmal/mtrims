<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionPlanDetailSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_plan_detail_setups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('production_plan_master_id')->nullable();

            $table->integer('delivery_location_id');
            $table->bigInteger('purchase_order_master_id');
            $table->integer('purchase_order_detail_id');
            $table->float('unit_price_in_usd', 12, 5)->default(0);


            $table->bigInteger('machine_id');
            $table->integer('no_of_heads');
            $table->float('production_hour')->nullable();
            $table->float('production_rate_hourly', 12, 5)->nullable();
            $table->float('target_production', 12, 5);
            $table->integer('item_unit_id');
            $table->float('achievement_production', 12, 5)->default(0);
            $table->float('variation_production', 12, 5)->default(0);
            $table->date('production_date');
            $table->float('total_revenue_in_usd', 12, 5)->default(0);

            $table->bigInteger('inserted_by');
            $table->bigInteger('updated_by')->nullable();
            $table->string('status', 4)->default('A');

            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->foreign('purchase_order_master_id')
                ->references('id')
                ->on('purchase_order_masters')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('production_plan_detail_setups');
    }
}
