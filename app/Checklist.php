<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    public $isEditable = false;

    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class);
    }

    public function tariffs()
    {
        return $this->belongsToMany(Tariff::class);
    }

    public function items()
    {
        return $this->hasMany(ChecklistItem::class);
    }

    public function setChecklistMaintenance($maintenance)
    {
        $this->maintenance()->associate($maintenance);
    }
}
