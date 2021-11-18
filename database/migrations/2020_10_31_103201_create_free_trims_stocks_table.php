<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreeTrimsStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('free_trims_stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('trims_stock_id')->unsigned()->default(0);
            $table->bigInteger('purchase_order_master_id')->unsigned();
            $table->integer('purchase_order_detail_id')->unsigned();
            $table->float('stock_quantity', 12, 5)->default(0);
            $table->float('delivered_quantity', 12, 5)->default(0);
            $table->string('status', 4)->default('F');
            $table->bigInteger('inserted_by');
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
        Schema::dropIfExists('free_trims_stocks');
    }
}
