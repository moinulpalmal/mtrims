<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrimsTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trims_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 15);
            $table->tinyInteger('lpd');
            $table->string('description', 60)->nullable();
            $table->string('remarks', 20)->nullable();
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
        Schema::dropIfExists('trims_types');
    }
}
