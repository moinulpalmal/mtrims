<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStockInfoToDeliveryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery_details', function (Blueprint $table) {
            $table->float('gross_weight', 12, 5)->default(0);
            $table->bigInteger('trims_stock_id');
            $table->float('gross_quantity_factor', 12,5)->default(0);
            $table->float('gross_delivered_quantity', 12,5)->default(0);
            $table->string('gross_unit', '2')->nullable();


            $table->dropColumn(['production_plan_detail_setup_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('delivery_details', function (Blueprint $table) {
            $table->dropColumn(['gross_weight']);
            $table->dropColumn(['trims_stock_id']);
            $table->dropColumn(['gross_quantity_factor']);
            $table->dropColumn(['gross_delivered_quantity']);
            $table->dropColumn(['gross_unit']);


            $table->bigInteger('production_plan_detail_setup_id');
        });
    }
}
