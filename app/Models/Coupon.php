<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends Model
{
    protected $fillable = [
        'title',
        'code', 'count',
        'percentage',
        'active',
        'expired_at',
    ];

    protected $casts = [
        'active' => 'boolean',
        'expired_at' => 'datetime',
        'percentage' => 'decimal:2',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'coupon_id');
    }

    public function isValid(): bool
    {
        return $this->active && ($this->expired_at === null || $this->expired_at->isFuture());
    }
}
