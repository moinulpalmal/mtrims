<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeftOverTrimsStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('left_over_trims_stock', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('purchase_order_master_id')->unsigned();
            $table->integer('purchase_order_detail_id')->unsigned();
            $table->float('stock_quantity', 12, 5)->default(0);
            $table->float('delivered_quantity', 12, 5)->default(0);
            $table->string('status', 4)->default('A');
            $table->bigInteger('inserted_by')->nullable();
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
        Schema::dropIfExists('left_over_trims_stocks');
    }
}
