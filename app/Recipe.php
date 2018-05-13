<?php

namespace App;

use App\Service\NullImage;
use App\Service\RenderableImage;
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
        'user_id'            => 'int',
        'serves'             => 'int',
        'oven_temperature'   => 'int',
        'lede_image_id'      => 'int',
        'thumbnail_image_id' => 'int'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_url', 'thumbnail_url'];

    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['slug']  = str_slug($title);
    }

    public function getImageUrlAttribute()
    {
        if ($this->lede) {
            return new RenderableImage($this->lede->path);
        }

        return new NullImage();
    }

    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return new RenderableImage($this->thumbnail->path);
        }

        return $this->image_url;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function thumbnail()
    {
        return $this->belongsTo(Image::class, 'thumbnail_image_id');
    }

    public function lede()
    {
        return $this->belongsTo(Image::class, 'lede_image_id');
    }

}
