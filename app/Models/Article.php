<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['user_id', 'category_article_id', 'title', 'slug_title', 'slug', 'old_image', 'summary',
        'description', 'status'];
}
