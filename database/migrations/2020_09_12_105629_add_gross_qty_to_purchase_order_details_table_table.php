<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGrossQtyToPurchaseOrderDetailsTableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_order_details', function (Blueprint $table) {
            $table->float('gross_calculation_amount', 12,5)->default(0);
            $table->float('gross_item_order_quantity', 12,5)->default(0);
            $table->float('add_amount_percent', 12,5)->default(0);
            $table->float('gross_unit_price', 12,5)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_order_details', function (Blueprint $table) {
            $table->dropColumn(['gross_calculation_amount']);
            $table->dropColumn(['gross_item_order_quantity']);
            $table->dropColumn(['add_amount_percent']);
            $table->dropColumn(['gross_unit_price']);
        });
    }
}
