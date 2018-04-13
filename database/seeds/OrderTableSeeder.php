<?php

use App\Tariff;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\User;
use App\Order;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order = new Order();
        $order->companyName = "Медиа Холдинг";
        $order->email = "media@mail.ru";
        $order->userName = "Михаил";
        $order->userSurname = "Баранов";
        $order->domain = "mediagrand.ru";
        $order->mobNumber = "+7 945 789 65 41";
        $order->additionalMobNumber = "+7 945 789 65 42";
        $order->offerNumber = "1878985576";
        $order->comment = "Нужно занять топ 5 позиций в поиске на тему медиа";
        $order->startDate = Carbon::now();
        $order->endDate = Carbon::tomorrow();
        $order->setOrderTariff(Tariff::find(3));
        $order->setOrderUser(User::findByEmail("client@example.com")->get()->first());
        $order->save();


        $order = new Order();
        $order->companyName = "Мега Молл";
        $order->email = "megamall@mail.ru";
        $order->userName = "Михаил";
        $order->userSurname = "Штольц";
        $order->domain = "megamall.ru";
        $order->mobNumber = "+7 945 789 65 43";
        $order->additionalMobNumber = "+7 945 789 65 44";
        $order->offerNumber = "1878985577";
        $order->comment = "Нужно обогнать наших конкурентов";
        $order->startDate = Carbon::now();
        $order->endDate = Carbon::tomorrow();
        $order->setOrderTariff(Tariff::find(1));
        $order->setOrderUser(User::findByEmail("client1@example.com")->get()->first());
        $order->save();

        $order = new Order();
        $order->companyName = "Мега Игрушки";
        $order->email = "megamall1@mail.ru";
        $order->userName = "Михаил";
        $order->userSurname = "Штольц";
        $order->domain = "megamall1.ru";
        $order->mobNumber = "+7 945 789 65 43";
        $order->additionalMobNumber = "+7 945 789 65 44";
        $order->offerNumber = "1878985578";
        $order->comment = "Нужно привлечь больше поставщиков";
        $order->startDate = Carbon::now();
        $order->endDate = Carbon::tomorrow();
        $order->setOrderTariff(Tariff::find(2));
        $order->setOrderUser(User::findByEmail("client1@example.com")->get()->first());
        $order->save();

    }
}
