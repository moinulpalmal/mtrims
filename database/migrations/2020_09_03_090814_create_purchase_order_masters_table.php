<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('lpd_po_no');
            $table->integer('job_no')->nullable();
            $table->integer('buyer_id');
            $table->string('buyer_po_no')->nullable();
            $table->integer('job_year')->nullable();
            $table->integer('primary_delivery_location_id')->nullable();
            $table->date('po_date')->nullable();
            $table->date('approval_date')->nullable();
            $table->string('status', 4)->default('I');
            $table->string('remarks')->nullable();
            $table->date('proposed_production_start_date')->nullable();
            $table->date('proposed_delivery_end_date')->nullable();
            $table->date('approved_production_start_date')->nullable();
            $table->date('approved_delivery_end_date')->nullable();
            $table->bigInteger('inserted_by');
            $table->bigInteger('approved_by')->nullable();
            $table->tinyInteger('lpd');
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
        Schema::dropIfExists('purchase_order_masters');
    }
}
