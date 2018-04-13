<?php

namespace App;

use App\Classes\enums\ChecklistItemStatusEnum;
use Illuminate\Database\Eloquent\Model;

class OrderChecklistsItem extends Model
{
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->status = ChecklistItemStatusEnum::WAITING_TO_BE_ASSIGNED;
    }

    /*relations*/

    public function orderChecklist()
    {
        return $this->belongsTo(OrderChecklist::class);
    }

    /*parent relations setters*/

    public function setOrderChecklist($checklist)
    {
        $this->orderChecklist()->associate($checklist);
    }

    /*Scopes*/

    public function scopeFindByOrderAndChecklistItem($query, $order, $item)
    {
        return $query->whereHas('checklistItem', function ($q) use ($item) {
            $q->where('id', $item->id);
        });
    }


    public function alreadyAssigned()
    {
        return collect(ChecklistItemStatusEnum::alreadyAssignedStatuses())->contains($this->status);
    }
}
