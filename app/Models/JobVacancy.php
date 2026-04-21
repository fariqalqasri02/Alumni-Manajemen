<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{
    protected $fillable = [
        'title',
        'company',
        'location',
        'employment_type',
        'salary_min',
        'salary_max',
        'deadline',
        'is_published',
        'description',
        'requirements',
        'application_link',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'deadline' => 'date',
            'is_published' => 'boolean',
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }
}
