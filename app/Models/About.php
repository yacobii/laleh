<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class About extends Model implements HasMedia
{

    protected $table = 'abouts';
    protected $guarded = ['id'];

    use InteractsWithMedia;

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->width(200)
            ->quality(50)
            ->nonQueued();

        $this
            ->addMediaConversion('about')
            ->width(1000)
            ->quality(60)
            ->nonQueued();
    }

}
