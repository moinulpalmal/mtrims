<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYarnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yarns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('yarn_count_id');
            $table->integer('unit_id');
            $table->string('color', 50);
            $table->string('status', 2)->default('A');
            $table->string('category', 1)->default('R');
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
        Schema::dropIfExists('yarns');
    }
}
