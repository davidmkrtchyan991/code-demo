<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('orderNumber')->unique();
            $table->string('companyName');
            $table->string('email');
            $table->string('userName');
            $table->string('userSurname');
            $table->string('domain');
            $table->string('mobNumber');
            $table->string('additionalMobNumber');
            $table->string('offerNumber');
            $table->string('comment')->nullable();
            $table->string('status');
            $table->text('keywords')->nullable();
            $table->dateTime('startDate');
            $table->dateTime('endDate');

            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->integer('tariff_id')->unsigned();
            $table->foreign('tariff_id')->references('id')->on('tariffs');

            $table->integer('optimizer_id')->nullable()->unsigned()->nullable();
            $table->foreign('optimizer_id')->references('id')->on('users')->onDelete('set null');

            $table->string('ftpHost');
            $table->string('ftpPort');
            $table->string('ftpLogin');
            $table->string('ftpPassword');
            $table->string('ftpCmsUrl');
            $table->string('ftpCmsLogin');
            $table->string('ftpCmsPassword');

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
        Schema::dropIfExists('orders');
    }
}
