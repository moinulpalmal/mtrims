<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProformaInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proforma_invoice_details', function (Blueprint $table) {
            $table->bigInteger('proforma_invoice_master_id');
            $table->bigInteger('purchase_order_master_id');
            $table->bigInteger('purchase_order_detail_id');
            $table->integer('item_count');

            $table->float('item_order_quantity',12,5)->default(0);
            $table->float('gross_calculation_amount', 12,5)->default(0);
            $table->float('gross_item_order_quantity', 12,5)->default(0);

            $table->float('item_unit_price', 12,5)->default(0);
            $table->float('add_amount_percent', 12,5)->default(0);
            $table->float('gross_unit_price', 12,5)->default(0);
            $table->float('total_price', 12,5)->default(0);
            $table->text('item_remarks')->nullable();
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
        Schema::dropIfExists('proforma_invoice_details');
    }
}
