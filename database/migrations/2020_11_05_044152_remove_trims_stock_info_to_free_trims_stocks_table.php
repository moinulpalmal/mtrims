<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTrimsStockInfoToFreeTrimsStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('free_trims_stocks', function (Blueprint $table) {
            $table->dropColumn(['trims_stock_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('free_trims_stocks', function (Blueprint $table) {
            $table->bigInteger('trims_stock_id')->unsigned()->default(0);
        });
    }
}
