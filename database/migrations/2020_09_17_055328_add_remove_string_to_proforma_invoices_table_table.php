<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRemoveStringToProformaInvoicesTableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proforma_invoices', function (Blueprint $table) {
            $table->dropColumn(['remarks']);
            $table->dropColumn(['terms_conditions']);
            $table->dropColumn(['bank_information']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proforma_invoices', function (Blueprint $table) {
            $table->string('remarks')->nullable();
            $table->string('terms_conditions');
            $table->string('bank_information');
        });
    }
}
