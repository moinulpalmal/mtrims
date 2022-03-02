<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTrackingPurchaseOrderMasters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_order_masters', function (Blueprint $table) {
            $table->integer('flow_count')->nullable()->default(0);
            $table->integer('revise_count')->nullable()->default(0);
            $table->boolean('has_flow_count')->nullable()->default(false);
            $table->boolean('is_urgent')->nullable()->default(false);
            $table->string('po_type')->nullable()->default('P');
            $table->bigInteger('last_updated_by')->default(0);
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
            $table->dropColumn(['flow_count']);
            $table->dropColumn(['revise_count']);
            $table->dropColumn(['has_flow_count']);
            $table->dropColumn(['is_urgent']);
            $table->dropColumn(['po_type']);
            $table->dropColumn(['last_updated_by']);
        });
    }
}
