<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChecklistTariffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklist_tariff', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('tariff_id')->nullable()->unsigned();
            $table->integer('checklist_id')->nullable()->unsigned();

            $table->foreign('tariff_id')->references('id')->on('tariffs');
            $table->foreign('checklist_id')->references('id')->on('checklists');

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
        Schema::dropIfExists('checklist_tariff');
    }
}
