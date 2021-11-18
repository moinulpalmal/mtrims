<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReviseStatusToPurchaseOrderMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_order_masters', function (Blueprint $table) {
            $table->integer('pi_count');
            $table->boolean('pi_generation_activated');
            $table->integer('factory_id');

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
            $table->dropColumn(['pi_count']);
            $table->dropColumn(['factory_id']);
            $table->dropColumn(['pi_generation_activated']);
            //$table->boolean('');
        });
    }
}
