<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsReplaceInfoDeliveryMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery_masters', function (Blueprint $table) {
            $table->boolean('is_replacement_challan')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('delivery_masters', function (Blueprint $table) {
            $table->dropColumn(['is_replacement_challan']);
        });
    }
}
