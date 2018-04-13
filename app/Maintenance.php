<?php

namespace App;

use App\Classes\enums\MaintenanceEnum;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $fillable = [
        'name'
    ];

    public function tariffs()
    {
        return $this->belongsToMany(Tariff::class);
    }

    public function checklists()
    {
        return $this->hasMany(Checklist::class);
    }

    public function isKeywords()
    {
        return $this->isKeywords;
    }

    public function scopeKeywordsWithTariff($query, $tariffId)
    {
        return $query->where('isKeywords', true)->whereHas('tariffs', function ($q) use ($tariffId) {
            $q->where('tariffs.id', $tariffId);
        });
    }

    public function scopeAdditionals($query)
    {
        return $query->where('isAdditional', true);
    }

    public function scopeWithName($query, $name)
    {
        return $query->where('name', $name);
    }
}
