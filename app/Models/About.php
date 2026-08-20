<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class About extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['ghorfe_online_list', 'image_two', 'image_three', 'image_four', 'image_five', 'content', 'content2',
        'content_one', 'content_two', 'content_three', 'content_four', 'content_five'];

    /**
     * @return BelongsTo
     */
    public function ghorfeOnline()
    {
        return $this->belongsTo(GhorfeOnlineList::class, 'ghorfe_online_list_id');
    }

    public function getImageOneUrlAttribute()
    {
        return optional($this->image_one)->getFirstMediaUrl('images');
    }

    public function getImageTwoUrlAttribute()
    {
        return optional($this->image_two)->getFirstMediaUrl('images');
    }

    public function getImageThreeUrlAttribute()
    {
        return optional($this->image_three)->getFirstMediaUrl('images');
    }

    public function getImageFourUrlAttribute()
    {
        return optional($this->image_four)->getFirstMediaUrl('images');
    }
}
