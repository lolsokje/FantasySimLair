<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('championship_id')->nullable()->constrained();
            $table->integer('year');
            $table->string('wdc_standings')->nullable();
            $table->string('wcc_standings')->nullable();
            $table->string('combined_standings')->nullable();
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
        Schema::dropIfExists('seasons');
    }
}
