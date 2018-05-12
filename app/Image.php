<?php

namespace App;

use App\Service\RenderableImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Image extends Model
{
    protected $casts = [
        'id'      => 'integer',
        'width'   => 'integer',
        'height'  => 'integer',
        'bytes'   => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUrlAttribute()
    {
        return (string)(new RenderableImage($this->path));
    }

    /**
     * @param UploadedFile $uploaded_file
     * @param User         $uploaded_by
     *
     * @return Image
     */
    public static function createFromUpload(UploadedFile $uploaded_file, User $uploaded_by): Image
    {
        $image            = new Image();
        $imagick          = new \Imagick($uploaded_file->getRealPath());
        $image->width     = $imagick->getImageWidth();
        $image->height    = $imagick->getImageHeight();
        $image->signature = $imagick->getImageSignature();
        $image->bytes     = $imagick->getImageLength();
        $image->mime_type = $imagick->getImageMimeType();

        $image->user_id = $uploaded_by->id;
        $image->path    = $uploaded_file->store('recipe-images');

        $image->save();

        return $image;
    }
}