<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    public function scopeExisting($query)
    {
        return $query->whereNotNull('id');
    }

    public function scopeWithCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeQuestionIsMatching($query, $question)
    {
        $query->whereRaw('MATCH (question) AGAINST (?)' , array($question));
    }
}
