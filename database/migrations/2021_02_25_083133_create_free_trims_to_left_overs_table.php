<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreeTrimsToLeftOversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('free_trims_to_left_overs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('free_trims_stock_id')->unsigned();
            $table->string('left_over_reason')->nullable();
            $table->float('requested_left_over_quantity', 12,5)->default(0);
            $table->float('approved_left_over_quantity', 12,5)->default(0);
            $table->float('stored_quantity', 12,5)->default(0);
            $table->string('status', 3)->default('I');
            $table->boolean('is_stored')->default(false);
            $table->boolean('is_left_over_stored')->default(false);
            $table->date('request_date')->nullable();
            $table->date('request_approve_date')->nullable();
            $table->bigInteger('inserted_by')->default(0);
            $table->bigInteger('last_updated_by')->default(0);
            $table->bigInteger('approved_by')->default(0);
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('free_trims_to_left_overs');
    }
}
