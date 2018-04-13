<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderChecklistHistoryRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_checklist_history_records', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('newStatus');
            $table->string('itemName');

            $table->integer('order_history_record_id')->unsigned();
            $table->foreign('order_history_record_id')->references('id')->on('order_history_records');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_checklist_history_records');
    }
}
