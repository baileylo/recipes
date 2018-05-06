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

    protected $casts = [
        'user_id' => 'int',
        'serves' => 'int',
        'oven_temperature' => 'int'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_url'];

    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['slug']  = str_slug($title);
    }

    public function getImageUrlAttribute()
    {
        return 'https://food.fnr.sndimg.com/content/dam/images/food/fullset/2003/9/29/0/ig1a07_roasted_potatoes.jpg';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
