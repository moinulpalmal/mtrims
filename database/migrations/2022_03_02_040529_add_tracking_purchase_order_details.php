<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTrackingPurchaseOrderDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_order_details', function (Blueprint $table) {
            $table->float('sample_item_order_quantity', 12, 5)->default(0);
            $table->float('sample_finished_quantity', 12, 5)->default(0);
            $table->float('sample_delivered_quantity', 12, 5)->default(0);
            $table->float('gross_sample_item_order_quantity', 12,5)->default(0);
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
            $table->dropColumn(['sample_item_order_quantity']);
            $table->dropColumn(['sample_finished_quantity']);
            $table->dropColumn(['sample_delivered_quantity']);
            $table->dropColumn(['gross_sample_item_order_quantity']);
        });
    }
}
