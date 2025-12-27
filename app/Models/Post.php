<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = ['id'];

    public static function booted()
    {
        static::saving(function ($model) {
            $model->slug = str()->slug($model->title, '-', null);
        });
    }

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }
    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->width(200)
            ->optimize()
            ->nonQueued();

        $this
            ->addMediaConversion('post')
            ->fit(Fit::Crop, 600, 600)
            ->quality(60)
            ->nonQueued();
    }
}
