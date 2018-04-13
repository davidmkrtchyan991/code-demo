<?php

use App\ChecklistItem;
use App\Classes\enums\MaintenanceEnum;
use App\Maintenance;
use App\Tariff;
use Illuminate\Database\Seeder;
use App\Checklist;
use Illuminate\Support\Facades\App;

class ChecklistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            'задача номер ',
            'задача номер ',
            'задача номер ',
            'задача номер ',
        ];

        for ($i = 0; $i < 10; $i++) {
            $checklist = new Checklist();
            $maintenance = Maintenance::find($i + 1);
            $checklist->setChecklistMaintenance($maintenance);

            $checklist->save();

            if (App::isLocal()) {
                if ($i <= 3) {
                    $checklist->tariffs()->attach(Tariff::find(1));
                } else if ($i < 7) {
                    $checklist->tariffs()->attach(Tariff::find(2));
                } else {
                    $checklist->tariffs()->attach(Tariff::find(3));
                }
            }

            if (!$maintenance->isKeywords) {
                collect($arr)->each(function ($name, $key) use ($checklist) {
                    if ($name) {
                        $item = new ChecklistItem;
                        $item->name = $name . ' ' . $key;
                        $item->setChecklist($checklist);
                        $item->save();
                    }
                });
            }

        }

    }
}
