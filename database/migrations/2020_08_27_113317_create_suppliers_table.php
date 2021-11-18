<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('type')->nullable();
            $table->string('grade_details')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('owner_email')->nullable();
            $table->string('owner_designation')->nullable();
            $table->string('owner_mobile_no')->nullable();
            $table->string('primary_contact_person')->nullable();
            $table->string('primary_designation')->nullable();
            $table->string('primary_mobile_no')->nullable();
            $table->string('primary_email')->nullable();
            $table->string('secondary_contact_person')->nullable();
            $table->string('secondary_designation')->nullable();
            $table->string('secondary_mobile_no')->nullable();
            $table->string('secondary_email')->nullable();
            $table->string('status', 4)->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('suppliers');
    }
}
