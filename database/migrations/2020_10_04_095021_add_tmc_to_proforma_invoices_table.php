<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTmcToProformaInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proforma_invoices', function (Blueprint $table) {
            $table->text('terms_conditions')->nullable();
            $table->text('bank_information')->nullable();
            $table->string('hs_code')->nullable();
            $table->dropColumn(['to_person']);
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
            $table->dropColumn(['terms_conditions']);
            $table->dropColumn(['bank_information']);
            $table->dropColumn(['hs_code']);
            $table->string('to_person')->nullable();
        });
    }
}
