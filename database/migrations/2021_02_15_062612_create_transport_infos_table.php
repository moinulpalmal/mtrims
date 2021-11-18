<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transport_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transport_name', 100)->nullable();
            $table->string('transport_no', 30)->nullable();
            $table->string('transport_licence_no', 30)->nullable();
            $table->string('driver_name')->nullable();
            $table->string('driver_contact_info')->nullable();
            $table->string('status', 2)->default('A');
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
        Schema::dropIfExists('transport_infos');
    }
}
