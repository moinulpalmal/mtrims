<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_details', function (Blueprint $table) {
            $table->bigInteger('purchase_order_master_id');
            $table->string('item_size');
            $table->string('item_color');
            $table->string('item_description');
            $table->integer('item_unit_id');
            $table->float('unit_price_in_usd');
            $table->float('total_price_in_usd');
            $table->string('remarks')->nullable();

            $table->float('item_order_quantity');
            $table->float('finished_quantity')->nullable();
            $table->float('delivered_quantity')->nullable();

            $table->float('sub_con_order_quantity')->nullable();
            $table->float('sub_con_finished_quantity')->nullable();
            $table->float('sub_con_delivered_quantity')->nullable();

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
        Schema::dropIfExists('purchase_order_details');
    }
}
