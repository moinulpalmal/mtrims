<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_details', function (Blueprint $table) {
            $table->bigInteger('delivery_master_id');
            $table->bigInteger('production_plan_detail_setup_id');
            $table->integer('purchase_order_detail_id');
            $table->integer('item_count');
            $table->float('delivered_quantity', 12,5)->default(0);
            $table->string('remarks', 70)->nullable();
            $table->timestamps();


            $table->foreign('delivery_master_id')
                ->references('id')
                ->on('delivery_masters')
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
        Schema::dropIfExists('delivery_details');
    }
}
