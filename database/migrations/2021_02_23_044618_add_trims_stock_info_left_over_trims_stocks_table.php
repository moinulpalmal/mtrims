<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTrimsStockInfoLeftOverTrimsStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('left_over_trims_stocks', function (Blueprint $table) {
            $table->bigInteger('trims_stock_id')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('left_over_trims_stocks', function (Blueprint $table) {
            $table->dropColumn(['trims_stock_id']);
        });
    }
}
