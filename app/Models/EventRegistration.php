<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    protected $fillable = [
        'career_event_id',
        'user_id',
        'status',
        'registered_at',
    ];

    protected function casts(): array
    {
        return [
            'registered_at' => 'datetime',
        ];
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(CareerEvent::class, 'career_event_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
