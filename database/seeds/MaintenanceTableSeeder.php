<?php

use App\Maintenance;
use Illuminate\Database\Seeder;
use  App\Classes\enums\MaintenanceEnum;

class MaintenanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service1 = new Maintenance();
        $service1->name = MaintenanceEnum::getTranslation(MaintenanceEnum::SECURITY);
        $service1->save();

        $service3 = new Maintenance();
        $service3->name = MaintenanceEnum::getTranslation(MaintenanceEnum::OPTIMIZATION);
        $service3->save();

        $service4 = new Maintenance();
        $service4->name = MaintenanceEnum::getTranslation(MaintenanceEnum::TEXT_UNIQUENESS);
        $service4->save();

        $service5 = new Maintenance();
        $service5->name = MaintenanceEnum::getTranslation(MaintenanceEnum::CONTEXTUAL_ADVERTISING);
        $service5->save();

        $service6 = new Maintenance();
        $service6->name = MaintenanceEnum::getTranslation(MaintenanceEnum::REPUTATION_MANAGEMENT);
        $service6->save();

        $service7 = new Maintenance();
        $service7->name = MaintenanceEnum::getTranslation(MaintenanceEnum::IMAGES_UNIQUENESS);
        $service7->save();

        $service8 = new Maintenance();
        $service8->name = MaintenanceEnum::getTranslation(MaintenanceEnum::USABILITY_IMPROVEMENT);
        $service8->save();

        $service9 = new Maintenance();
        $service9->name = MaintenanceEnum::getTranslation(MaintenanceEnum::SOCIAL_MANAGEMENT);
        $service9->isAdditional = true;
        $service9->save();

        $service10 = new Maintenance();
        $service10->name = MaintenanceEnum::getTranslation(MaintenanceEnum::PHOTO_VIDEO);
        $service10->isAdditional = true;
        $service10->save();

        $service11 = new Maintenance();
        $service11->name = MaintenanceEnum::getTranslation(MaintenanceEnum::MOBILE_APP_DEVELOPMENT);
        $service11->isAdditional = true;
        $service11->save();


        $service2 = new Maintenance();
        $service2->name = MaintenanceEnum::getTranslation(MaintenanceEnum::KEY_WORDS, 200);
        $service2->isKeywords = true;
        $service2->keywords_count = 200;
        $service2->save();

        $service21 = new Maintenance();
        $service21->name = MaintenanceEnum::getTranslation(MaintenanceEnum::KEY_WORDS, 500);
        $service21->isKeywords = true;
        $service21->keywords_count = 500;
        $service21->save();

        $service22 = new Maintenance();
        $service22->name = MaintenanceEnum::getTranslation(MaintenanceEnum::KEY_WORDS, 1000);
        $service22->isKeywords = true;
        $service22->keywords_count = 1000;
        $service22->save();
    }
}
