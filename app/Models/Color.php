<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Color extends Model
{

    protected $guarded = ['id'];

    public static function booted()
    {
        static::saving(function ($model) {
            if (is_null($model->slug)) {
                $model->slug = str()->slug($model->title, '-', null);
            }
        });

    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'color_product');
    }

}
