<?php

namespace App;

enum StatusEnum: string
{
    case New = 'new';
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';
    case CANCEL = 'cancel';

    public function label(): string
    {
        return match ($this) {
            self::New => 'جدید',
            self::PROCESSING => 'آماده‌سازی',
            self::COMPLETED => 'تکمیل',
            self::CANCEL => 'کنسل',
        };
    }



}
