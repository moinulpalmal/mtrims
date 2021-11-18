<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProformaInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proforma_invoices', function (Blueprint $table) {
            $table->bigInteger('purchase_order_master_id');
            $table->boolean('is_revise');
            $table->integer('pi_count');
            $table->string('remarks')->nullable();
            $table->string('terms_conditions');
            $table->string('bank_information');
            $table->string('to_person');
            $table->float('total_pi_amount');
            $table->bigInteger('inserted_by');
            $table->bigInteger('approved_by')->nullable();
            $table->date('pi_date')->nullable();
            $table->date('approval_date')->nullable();
            $table->string('status', 4)->default('I');

            $table->foreign('purchase_order_master_id')
                ->references('id')
                ->on('purchase_order_masters')
                ->cascadeOnDelete();

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
        Schema::dropIfExists('proforma_invoices');
    }
}
