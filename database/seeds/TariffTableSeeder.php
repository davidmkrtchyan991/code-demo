<?php

use App\Tariff;
use Illuminate\Database\Seeder;
use  App\Classes\enums\TariffEnum;

class TariffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tariff1 = new Tariff();
        $tariff1->name = TariffEnum::getTranslation(TariffEnum::BASE);
        $tariff1->price = "27000";
        $tariff1->save();

        $tariff2 = new Tariff();
        $tariff2->name = TariffEnum::getTranslation(TariffEnum::MEDIUM);
        $tariff2->price = "48000";
        $tariff2->save();

        $tariff3 = new Tariff();
        $tariff3->name = TariffEnum::getTranslation(TariffEnum::PRO);
        $tariff3->price = "96000";
        $tariff3->save();
    }
}
