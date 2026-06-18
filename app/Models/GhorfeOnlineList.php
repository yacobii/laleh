<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class GhorfeOnlineList extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];
    protected $table = 'ghorfe_online_lists';

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
        'footer_tag' => 'array'
    ];
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'en_title'
            ]
        ];
    }



    public function path()
    {
        return "/$this->slug";
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


//    public function products()
//    {
//        return $this->belongsToMany(Product::class);
//    }


 // yacobi code
    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'ghorfe_online_list_product',
            'ghorfe_online_list_id',
            'product_id'
        )
            ->withPivot([
                'price',
                'stock',
                'purchase_type',
                'pay_type',
                'tariff_id',
                'guarantee'
            ])
            ->wherePivotNull('deleted_at');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function financialPlansTypes()
    {
        return $this->belongsToMany(FinancialPlansType::class);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function factors()
    {
        return $this->belongsToMany(Factor::class);
    }
     /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
     /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function callcenters()
    {
        return $this->belongsToMany(Callcenter::class);
    }
     /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function articles()
    {
        return $this->morphMany(Article::class , 'articleable');
    }
     /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function tickets()
    {
        return $this->morphMany(Ticket::class , 'ticketable');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function sliders()
    {
        return $this->morphMany(Slider::class , 'sliderable');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function about()
    {
        return $this->hasOne(About::class);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function contacts()
    {
        return $this->morphMany(Contact::class , 'contactable');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function cards()
    {
        return $this->morphMany(Card::class , 'cardable');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function abouts()
    {
        return $this->morphMany(About::class , 'aboutable');
    }
}
