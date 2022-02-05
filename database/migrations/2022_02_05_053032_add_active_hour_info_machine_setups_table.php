<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActiveHourInfoMachineSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('machine_setups', function (Blueprint $table) {
            $table->dropColumn(['is_sub_con']);
            $table->integer('active_hours')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('machine_setups', function (Blueprint $table) {
            $table->boolean('is_sub_con')->default(false);
            $table->dropColumn(['active_hours']);
        });
    }
}
