<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumptionPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumption_plans', function (Blueprint $table) {
            $table->bigInteger('purchase_order_master_id')->unsigned()->nullable();
            $table->integer('purchase_order_detail_id')->unsigned()->nullable();

            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->bigInteger('default_unit_id')->unsigned()->nullable();

            $table->decimal('planned_qty', 62,5)->nullable();
            $table->decimal('issued_qty', 62,5)->nullable();
            $table->decimal('used_qty', 62,5)->nullable();

            $table->string('status', 4)->nullable();
            $table->string('color', 150)->nullable();

            $table->bigInteger('inserted_by')->default(0);
            $table->bigInteger('last_updated_by')->default(0);
            $table->string('remarks', 255)->nullable();
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
        Schema::dropIfExists('consumption_plans');
    }
}
