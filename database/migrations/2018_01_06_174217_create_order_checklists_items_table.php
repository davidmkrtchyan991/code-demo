<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderChecklistsItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_checklists_items', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('status');
            $table->string('name');

            $table->integer('order_checklist_id')->unsigned();
            $table->foreign('order_checklist_id')->references('id')->on('order_checklists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_checklists_items');
    }
}
