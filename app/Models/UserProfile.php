<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'address',
        'graduation_year',
        'study_program',
        'education_history',
        'skills',
        'work_experience',
        'current_company',
        'current_position',
        'linkedin_url',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
