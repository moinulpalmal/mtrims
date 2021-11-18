<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveReplacementToDeliveryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery_details', function (Blueprint $table) {
            $table->dropColumn(['g_replace_quantity']);
            $table->dropColumn(['replace_quantity']);
            $table->dropColumn(['ap_g_replace_quantity']);
            $table->dropColumn(['ap_replace_quantity']);
            $table->dropColumn(['is_replace_requested']);
            $table->dropColumn(['replace_status']);
            $table->dropColumn(['replace_inserted_by']);
            $table->dropColumn(['replace_approved_by']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('delivery_details', function (Blueprint $table) {
            $table->float('g_replace_quantity', 12,5)->default(0);
            $table->float('replace_quantity', 12,5)->default(0);
            $table->float('ap_g_replace_quantity', 12,5)->default(0);
            $table->float('ap_replace_quantity', 12,5)->default(0);
            $table->boolean('is_replace_requested')->default(0);
            $table->string('replace_status', 4)->default('I');
            $table->bigInteger('replace_inserted_by')->nullable();
            $table->bigInteger('replace_approved_by')->nullable();
        });
    }
}
