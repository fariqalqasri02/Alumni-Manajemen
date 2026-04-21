<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class TracerStudy extends Model
{
    protected $fillable = [
        'user_id',
        'employment_status',
        'company_name',
        'job_title',
        'relevance_level',
        'waiting_period_months',
        'salary',
        'feedback',
        'survey_year',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
