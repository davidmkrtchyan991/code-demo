<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderChecklistHistoryRecord extends Model
{

    public function orderHistoryRecord()
    {
        return $this->belongsTo(OrderHistoryRecord::class);
    }

    public function setOrderHistoryRecord($record)
    {
        $this->orderHistoryRecord()->associate($record);
    }
}