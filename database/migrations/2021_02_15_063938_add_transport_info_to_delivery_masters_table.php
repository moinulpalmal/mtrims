<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransportInfoToDeliveryMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery_masters', function (Blueprint $table) {
            $table->bigInteger('transport_info_id')->unsigned()->default(0);

            $table->dropColumn(['driver_name']);
            $table->dropColumn(['truck_no']);
            $table->dropColumn(['licence_no']);
            $table->dropColumn(['transport_name']);
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
            $table->dropColumn(['transport_info_id']);

            $table->string('driver_name')->nullable();
            $table->string('truck_no', 20)->nullable();
            $table->string('licence_no', 30)->nullable();
            $table->string('transport_name', 100)->nullable();
        });
    }
}
