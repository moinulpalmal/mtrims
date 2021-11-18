<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryDetailReplacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_detail_replaces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('purchase_order_master_id')->unsigned();
            $table->bigInteger('purchase_order_detail_id')->unsigned();
            $table->bigInteger('delivery_master_id')->unsigned();
            $table->bigInteger('delivery_detail_id')->unsigned();
            $table->string('replacement_reason')->nullable();
            $table->float('requested_replace_quantity', 12,5)->default(0);
            $table->float('production_replace_quantity', 12,5)->default(0);
            $table->float('non_production_replace_quantity', 12,5)->default(0);
            $table->float('stored_quantity', 12,5)->default(0);
            $table->string('status', 3)->default('I');
            $table->boolean('is_stored')->default(false);
            $table->boolean('is_non_production_stored')->default(false);
            $table->date('request_date')->nullable();
            $table->date('request_approve_date')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('delivery_detail_replaces');
    }
}
