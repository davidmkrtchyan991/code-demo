<?php

namespace App\Traits\auth;

trait UserSearchHelper
{
    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("name", "LIKE","%$keyword%")
                    ->orWhere("email", "LIKE", "%$keyword%")
                    ->orWhere("surname", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }

    public function scopeFindByEmail($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("email", "LIKE","%$keyword%");
            });
        }
        return $query;
    }
}