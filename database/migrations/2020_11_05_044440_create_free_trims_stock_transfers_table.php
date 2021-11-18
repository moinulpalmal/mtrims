<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreeTrimsStockTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('free_trims_stock_transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('trims_stock_id')->unsigned()->default(0);
            $table->bigInteger('free_trims_stock_id')->unsigned()->default(0);
            $table->bigInteger('target_purchase_order_master_id')->unsigned();
            $table->integer('target_purchase_order_detail_id')->unsigned();
            $table->float('transfer_quantity', 12, 5)->default(0);
            $table->string('status', 4)->default('I');
            $table->bigInteger('inserted_by');
            $table->bigInteger('approved_by')->nullable();
            $table->date('approval_date')->nullable();
            $table->bigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('free_trims_stock_transfers');
    }
}
