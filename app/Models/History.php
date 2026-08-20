<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class History extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function historiable()
    {
        return $this->morphTo();
    }

    /**
     * @return BelongsTo
     */
    public function reason()
    {
        return $this->belongsTo(Reason::class);
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function callcenter()
    {
        return $this->belongsTo(User::class, 'callcenter_id');
    }

    // get status history

    /**
     * @return string
     */
    protected static function status($status)
    {
        switch ($status) {
            case 0:
                return 'لینک ارسال شده';
            case 1:
                return 'تعلیق شده';
            default:
                return 'انتقال به همکار دیگر';
        }
    }

    /**
     * @param  mixed  $task
     * @param  mixed  $callcenter
     * @param  mixed  $reason
     * @param  mixed  $description
     * @return void
     */
    public static function create($task, $callcenter, $reason, $status, $description)
    {
        $task->histories()->create([
            'user_id' => auth()->user() ? auth()->user()->id : $task->reg_id,
            'callcenter_id' => $callcenter,
            'status' => $status,
            'reason_id' => $reason,
            'description' => $description,
        ]);

        $task->update(['description' => $description]);
    }

    /**
     * Summary of contractHistoryCreate
     *
     * @param  mixed  $item
     * @param  mixed  $callcenter
     * @param  mixed  $user
     * @param  mixed  $reason
     * @param  mixed  $status
     * @param  mixed  $description
     * @return void
     */
    public static function contractHistoryCreate($item, $callcenter, $user, $reason, $status, $description)
    {
        $item->histories()->create([
            'user_id' => $user,
            'callcenter_id' => $callcenter,
            'status' => $status,
            'reason_id' => $reason,
            'description' => $description,
        ]);
    }
}
