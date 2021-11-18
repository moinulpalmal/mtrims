<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTrimsValuesToTrimsTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trims_types', function (Blueprint $table) {
            $table->float('gross_calculation_amount', 12, 5)->nullable();
            $table->float('add_amount_percent', 12, 5)->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trims_types', function (Blueprint $table) {
            $table->dropColumn(['gross_calculation_amount']);
            $table->dropColumn(['add_amount_percent']);
        });
    }
}
