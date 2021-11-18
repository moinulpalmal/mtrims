<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->bigInteger('challan_no');
            $table->integer('store_id');
            $table->string('driver_name')->nullable();
            $table->string('truck_no', 20)->nullable();

            $table->string('licence_no', 30)->nullable();
            $table->date('challan_date')->nullable();
            $table->string('account_info', 100)->nullable();
            $table->string('transport_name', 100)->nullable();
            $table->float('gross_weight', 12,5)->default(0);
            $table->float('net_weight', 12,5)->default(0);
            $table->bigInteger('inserted_by');
            $table->bigInteger('updated_by')->nullable();
            $table->string('status', 4)->default('A');
            $table->text('remarks')->nullable();
            $table->bigInteger('purchase_order_master_id');
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
        Schema::dropIfExists('delivery_masters');
    }
}
