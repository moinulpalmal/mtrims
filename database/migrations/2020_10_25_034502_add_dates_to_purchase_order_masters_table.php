<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDatesToPurchaseOrderMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_order_masters', function (Blueprint $table) {
            $table->dropColumn(['proposed_production_start_date']);
            $table->dropColumn(['proposed_delivery_end_date']);
            $table->dropColumn(['approved_production_start_date']);
            $table->dropColumn(['approved_delivery_end_date']);


            $table->date('sample_submission_date')->nullable();
            $table->date('production_start_date')->nullable();
            $table->date('production_end_date')->nullable();
            $table->date('delivery_start_date')->nullable();
            $table->date('delivery_end_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_order_masters', function (Blueprint $table) {
            $table->date('proposed_production_start_date')->nullable();
            $table->date('proposed_delivery_end_date')->nullable();
            $table->date('approved_production_start_date')->nullable();
            $table->date('approved_delivery_end_date')->nullable();

            $table->dropColumn(['sample_submission_date']);
            $table->dropColumn(['production_start_date']);
            $table->dropColumn(['production_end_date']);
            $table->dropColumn(['delivery_start_date']);
            $table->dropColumn(['delivery_end_date']);
        });
    }
}
