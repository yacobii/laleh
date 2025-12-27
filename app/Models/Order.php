<?php

namespace App\Models;

use App\StatusEnum;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{

    protected $fillable = ['coupon_id', 'user_id', 'code', 'status', 'body', 'total', 'total_with_coupon', 'refer'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function booted(): void
    {
        static::creating(function ($model) {
            $lastCode = static::max('code') ?? 99; // if no orders yet, start from 999
            $model->code = $lastCode + 1;
        });
    }

    protected function casts(): array
    {
        return [
            'status' => StatusEnum::class
        ];
    }

    protected function calculateTotalWithCoupon(): void
    {
        $this->total = $this->calculateSubtotal();
        $this->total_with_coupon = $this->subtotal;

        if ($this->coupon && $this->coupon->isValid()) {
            $discount = $this->subtotal * ($this->coupon->percentage / 100);
            $this->total_with_coupon = $this->subtotal - $discount;
        }
    }

    protected function calculateSubtotal(): float
    {
        return $this->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    }

//    protected function calculateTotalWithCoupon(): void
//    {
//        $this->subtotal = $this->calculateSubtotal();
//        $this->total_with_coupon = $this->subtotal;
//
//        if ($this->coupon && $this->coupon->isValid()) {
//            $discount = $this->subtotal * ($this->coupon->percentage / 100);
//            $this->total_with_coupon = $this->subtotal - $discount;
//        }
//    }
    #[Scope]
    public function completed($query)
    {
        return $query->where('status', 'completed');
    }

}
