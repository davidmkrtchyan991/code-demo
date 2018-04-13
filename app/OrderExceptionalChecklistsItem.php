<?php

namespace App;

use App\Classes\enums\ChecklistItemStatusEnum;
use Illuminate\Database\Eloquent\Model;

class OrderExceptionalChecklistsItem extends Model
{
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->status = ChecklistItemStatusEnum::WAITING_TO_BE_ASSIGNED;
    }

    /*relations*/
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /*parent relations setters*/
    public function setOrder($order)
    {
        $this->order()->associate($order);
    }

    public function alreadyAssigned()
    {
        return collect(ChecklistItemStatusEnum::alreadyAssignedStatuses())->contains($this->status);
    }
}
