<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderHistoryRecord extends Model
{

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function checklistHistory()
    {
        return $this->hasMany(OrderChecklistHistoryRecord::class);
    }

    public function setOrder($order)
    {
        $this->order()->associate($order);
    }

    public function setUser($user)
    {
        $this->user()->associate($user);
    }

    public function scopeRecentsForUser($query, $user)
    {
        return $query->whereHas('order', function ($q) use ($user) {
            $q->withUser($user->id);
        })->orderBy('created_at', 'desc')->skip(0)->take(5);
    }
}