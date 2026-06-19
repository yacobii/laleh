<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthCode extends Model
{
    /**
     * @var string
     */
    protected $table = 'auth_code';

    /**
     * @var string[]
     */
    protected $fillable = ['code', 'phone', 'expiration_time', 'time_code_again'];
}
