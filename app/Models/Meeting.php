<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Meeting extends Model
{
    protected $fillable = [
        'title_en', 'title_hi', 'date', 'location_en', 'location_hi',
        'type', 'slug', 'meeting_status',
        'agenda_en', 'agenda_hi', 'minutes_en', 'minutes_hi',
        'resolutions_en', 'resolutions_hi',
        'status', 'published_at', 'created_by',
    ];

    protected $casts = [
        'date' => 'date',
        'published_at' => 'datetime',
    ];

    public function creator(): BelongsTo { return $this->belongsTo(User::class, 'created_by'); }
    public function documents(): MorphMany { return $this->morphMany(Document::class, 'documentable'); }
    public function scopePublished($query) { return $query->where('status', 'published'); }
    public function getTitle(): string { return app()->getLocale() === 'hi' && $this->title_hi ? $this->title_hi : $this->title_en; }
    public function getLocation(): ?string { return app()->getLocale() === 'hi' && $this->location_hi ? $this->location_hi : $this->location_en; }
}
