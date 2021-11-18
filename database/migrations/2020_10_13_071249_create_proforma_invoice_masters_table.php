<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProformaInvoiceMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proforma_invoice_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('lpd');
            $table->integer('job_no');
            $table->integer('job_year');
            $table->bigInteger('purchase_order_master_id');
            $table->boolean('is_revise')->nullable();
            $table->boolean('is_follow_pi')->nullable();
            $table->integer('pi_revise_count')->nullable();
            $table->integer('pi_follow_count')->nullable();
            $table->string('remarks')->nullable();
            $table->text('terms_conditions')->nullable();
            $table->text('bank_information')->nullable();
            $table->text('to_person')->nullable();
            $table->float('total_pi_amount', 16, 5)->nullable();
            $table->text('total_pi_amount_words')->nullable();
            $table->bigInteger('inserted_by')->nullable();
            $table->bigInteger('updated_by')->nullable();;
            $table->bigInteger('approved_by')->nullable();
            $table->date('pi_date')->nullable();
            $table->date('approval_date')->nullable();
            $table->string('status', 4)->default('I');
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
        Schema::dropIfExists('proforma_invoice_masters');
    }
}
