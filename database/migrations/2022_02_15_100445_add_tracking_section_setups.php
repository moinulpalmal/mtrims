<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTrackingSectionSetups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('section_setups', function (Blueprint $table) {
            $table->bigInteger('inserted_by')->default(0);
            $table->bigInteger('last_updated_by')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('section_setups', function (Blueprint $table) {
            $table->dropColumn(['inserted_by']);
            $table->dropColumn(['last_updated_by']);
        });
    }
}