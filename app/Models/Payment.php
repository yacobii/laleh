<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = ['id'];


    protected function casts(): array
    {
        return [
            'payment_data' => 'json'
        ];
    }
}
