<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Order;
use App\Faq;
use App\Classes\enums\RoleEnum;

class FaqTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $checklist1 = new Faq();
        $checklist1->category = "Оплата заказа";
        $checklist1->question = "Как просиходит оплата?";
        $checklist1->answer = "Пользователь оплачивает либо переводом денежных средств, либо наличными в нашей компании";
        $checklist1->save();

        $checklist2 = new Faq();
        $checklist2->category = "Оплата заказа";
        $checklist2->question = "Возможно ли получить деньги обратно?";
        $checklist2->answer = "Да, при невыполнении некоторых обязанностей";
        $checklist2->save();

        $checklist3 = new Faq();
        $checklist3->category = "Контактная информация";
        $checklist3->question = "Где находиться оффис?";
        $checklist3->answer = "Всю информацию вы можете найти на странице о нас";
        $checklist3->save();


    }
}
