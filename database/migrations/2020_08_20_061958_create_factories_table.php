<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factories', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('name');
            $table->string('short_name');
            $table->string('address');
            $table->boolean('is_cho');
            $table->string('vat_no')->nullable();
            $table->string('manager_info')->nullable();
            $table->string('contact_person_info')->nullable();
            $table->string('factory_head_info')->nullable();
            $table->string('factory_messenger_info')->nullable();
            $table->string('bin_no')->nullable();
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
        Schema::dropIfExists('factories');
    }
}
