<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

/**
 * @method static create(string[] $category)
 */
class Category extends Model implements Sitemapable, HasMedia
{

    use InteractsWithMedia, HasRecursiveRelationships;

    protected $guarded = ['id'];


    public static function booted()
    {
        static::saving(function ($model) {
            if (is_null($model->slug)) {
                $model->slug = str()->slug($model->title, '-', null);
            }
        });

    }


    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 200, 200)
            ->nonQueued();

        $this
            ->addMediaConversion('cover')
            ->fit(Fit::Contain, 500, 500)
            ->nonQueued();

        $this
            ->addMediaConversion('main')
            ->fit(Fit::Contain, 1000, 1000)
            ->nonQueued();
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('products')
            ->useFallbackUrl(asset('fallback/fallback-slider.jpg'));

    }

    protected function casts(): array
    {
        return [
            'active' => 'boolean'
        ];
    }

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function toSitemapTag(): Url|string|array
    {
        return Url::create(route('category.products', $this));
    }

}
