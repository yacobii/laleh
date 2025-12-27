<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Maize\Markable\Markable;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Maize\Markable\Models\Favorite;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model implements HasMedia, Sitemapable
{
    use InteractsWithMedia, Markable;

    protected $guarded = false;

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }


    public static function booted()
    {
        static::creating(function ($model) {
            if (is_null($model->slug)) {
                $model->slug = str()->slug($model->title, '-', null);
            }
        });

//        static::addGlobalScope('active', function (Builder $builder) {
//            $builder->where('active', 1);
//        });

    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
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




    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_size');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_product');
    }

    public function product_discount(): float|int
    {
        return ($this->price * $this->discount_rate) / 100;
    }


    public function product_with_discount()
    {
        return $this->price - $this->product_discount();
    }

    // New product_price method
    public function product_price(): float|int
    {
        return $this->discounted
            ? $this->product_with_discount()
            : $this->price;
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'product_user');
    }


    public function toSitemapTag(): Url|string|array
    {
        return Url::create(route('product', $this));

    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    protected static $marks = [
        Favorite::class,
    ];
}
