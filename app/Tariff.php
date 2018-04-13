<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tariff extends Model
{
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $lastID = DB::table('tariffs')->max('id') ?: 0;
            $model->technicalName = "TARIFF_" . ($lastID + 1);
        });
    }


    public function maintenances()
    {
        return $this->belongsToMany(Maintenance::class);
    }

    public function checklists()
    {
        return $this->belongsToMany(Checklist::class);
    }

    public function hasMaintenance($maintenance)
    {
        return $this->maintenances->first(function ($tariffMaintenance, $key) use ($maintenance) {
            return $tariffMaintenance->id == $maintenance->id;
        });
    }
}
