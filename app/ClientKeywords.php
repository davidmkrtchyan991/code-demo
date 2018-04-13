<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientKeywords extends Model
{

    protected $fillable = [
        'keywords'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function setOrder($order)
    {
        $this->order()->associate($order);
    }
}
