<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFloatToPurchaseOrderDetailsTableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_order_details', function (Blueprint $table) {
            $table->float('unit_price_in_usd', 12, 5)->default(0);
            $table->float('total_price_in_usd', 12, 5)->default(0);

            $table->float('item_order_quantity', 12, 5)->default(0);
            $table->float('finished_quantity', 12, 5)->default(0);
            $table->float('delivered_quantity', 12, 5)->default(0);

            $table->float('sub_con_order_quantity', 12, 5)->default(0);
            $table->float('sub_con_finished_quantity', 12, 5)->default(0);
            $table->float('sub_con_delivered_quantity', 12, 5)->default(0);
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
}
