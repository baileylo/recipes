<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'source',
        'serves',
        'cooking_time',
        'oven_temperature',
        'ingredients',
        'directions'
    ];

    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['slug']  = str_slug($title);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
