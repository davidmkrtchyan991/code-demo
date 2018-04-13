<?php

namespace App;

use App\Classes\enums\ChecklistItemStatusEnum;
use Illuminate\Database\Eloquent\Model;

class OrderChecklist extends Model
{
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class);
    }

    public function items()
    {
        return $this->hasMany(OrderChecklistsItem::class);
    }

    public function setOrder($order)
    {
        $this->order()->associate($order);
    }

    public function setMaintenance($maintenance)
    {
        $this->maintenance()->associate($maintenance);
    }

    public function hasAlreadyAssignedItem()
    {
        return $this->items->first(function ($item, $key) {
            return $item->alreadyAssigned();
        });
    }

    public function allItemsCompleted()
    {
        return $this->items->every(function ($item, $key) {
            return $item->status == ChecklistItemStatusEnum::DONE;
        });
    }

}
