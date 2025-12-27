<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    public static function booted()
    {
        static::saving(function ($model) {
            $model->slug = str_replace(' ', '-', $model->title);
        });
    }

    public function parent()
    {
        return $this->belongsTo(City::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(City::class, 'parent_id')->oldest();
    }
}
