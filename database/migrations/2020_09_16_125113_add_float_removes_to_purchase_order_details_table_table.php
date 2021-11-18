<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFloatRemovesToPurchaseOrderDetailsTableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_order_details', function (Blueprint $table) {
            $table->dropColumn(['unit_price_in_usd']);
            $table->dropColumn(['total_price_in_usd']);

            $table->dropColumn(['item_order_quantity']);
            $table->dropColumn(['finished_quantity']);
            $table->dropColumn(['delivered_quantity']);

            $table->dropColumn(['sub_con_order_quantity']);
            $table->dropColumn(['sub_con_finished_quantity']);
            $table->dropColumn(['sub_con_delivered_quantity']);
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
            $table->float('unit_price_in_usd');
            $table->float('total_price_in_usd');

            $table->float('item_order_quantity');
            $table->float('finished_quantity')->nullable();
            $table->float('delivered_quantity')->nullable();

            $table->float('sub_con_order_quantity')->nullable();
            $table->float('sub_con_finished_quantity')->nullable();
            $table->float('sub_con_delivered_quantity')->nullable();
        });
    }
}
