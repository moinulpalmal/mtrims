<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCloseStatusInfoToPurchaseOrderMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_order_masters', function (Blueprint $table) {
            $table->bigInteger('close_requested_by')->nullable();
            $table->bigInteger('close_approved_by')->nullable();
            $table->boolean('close_request')->default(false);
            $table->date('close_request_date')->nullable();
            $table->date('close_approval_date')->nullable();
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
            $table->dropColumn(['close_requested_by']);
            $table->dropColumn(['close_approved_by']);
            $table->dropColumn(['close_request']);
            $table->dropColumn(['close_request_date']);
            $table->dropColumn(['close_approval_date']);
            //$table->bigInteger('close_approved_by')->nullable();
            //$table->bigInteger('close_request')->nullable();
            //$table->('close_approval_date')->nullable();
        });
    }
}
