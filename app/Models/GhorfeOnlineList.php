<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class GhorfeOnlineList extends Model
{
    use Sluggable , SoftDeletes;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     *types of ghorfeOnline
     */
    const TYPE = [
        'service' => 'ارائه خدمات',
        'product' => 'فروش کالا',
        'all' => 'ارائه خدمات و فروش کالا',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'sms_code' => 'array',
        'footer_tag' => 'array',
    ];

    /**
     * Return the sluggable configuration array for this model.
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'en_title',
            ],
        ];
    }

    /**
     * @return string
     */
    //    public function getRouteKeyName()
    //    {
    //        return 'slug';
    //    }

    /**
     * @return string
     */
    public function path()
    {
        return "/$this->slug";
    }

    public function galleries()
    {
        return $this->morphMany(Gallery::class, 'galleryable');
    }

    /**
     * @return BelongsToMany
     */
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    /**
     * @return BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * @return BelongsToMany
     */
    public function financialPlansTypes()
    {
        return $this->belongsToMany(FinancialPlansType::class);
    }

    /**
     * @return BelongsToMany
     */
    public function factors()
    {
        return $this->belongsToMany(Factor::class);
    }

    /**
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function callcenters()
    {
        return $this->belongsToMany(Callcenter::class);
    }

    /**
     * @return MorphMany
     */
    public function articles()
    {
        return $this->morphMany(Article::class, 'articleable');
    }

    /**
     * @return MorphMany
     */
    public function tickets()
    {
        return $this->morphMany(Ticket::class, 'ticketable');
    }

    /**
     * @return MorphMany
     */
    public function sliders()
    {
        return $this->morphMany(Slider::class, 'sliderable');
    }

    /**
     * @return MorphMany
     */
    public function about()
    {
        return $this->hasOne(About::class);
    }

    /**
     * @return MorphMany
     */
    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    /**
     * @return MorphMany
     */
    public function cards()
    {
        return $this->morphMany(Card::class, 'cardable');
    }

    /**
     * @return MorphMany
     */
    public function abouts()
    {
        return $this->morphMany(About::class, 'aboutable');
    }
}
