<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChecklistItem extends Model
{
    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }

    public function setChecklist($checklist)
    {
        $this->checklist()->associate($checklist);
    }
}
