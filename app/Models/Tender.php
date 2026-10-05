<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Tender extends Model
{
    protected $fillable = [
        'tender_number', 'title_en', 'title_hi', 'description_en', 'description_hi',
        'department', 'category', 'slug', 'published_date', 'closing_date',
        'tender_status', 'status', 'estimated_value',
        'contact_name', 'contact_email', 'contact_phone',
        'published_at', 'created_by',
    ];

    protected $casts = [
        'published_date' => 'date',
        'closing_date' => 'date',
        'published_at' => 'datetime',
        'estimated_value' => 'decimal:2',
    ];

    public function creator(): BelongsTo { return $this->belongsTo(User::class, 'created_by'); }
    public function documents(): MorphMany { return $this->morphMany(Document::class, 'documentable'); }
    public function scopePublished($query) { return $query->where('status', 'published'); }
    public function getTitle(): string { return app()->getLocale() === 'hi' && $this->title_hi ? $this->title_hi : $this->title_en; }
    public function getDescription(): ?string { return app()->getLocale() === 'hi' && $this->description_hi ? $this->description_hi : $this->description_en; }

    public function getTenderStatusBadgeColor(): string {
        return match($this->tender_status) {
            'active' => 'green',
            'upcoming' => 'blue',
            'closing_soon' => 'yellow',
            'closed' => 'gray',
            default => 'gray',
        };
    }
}
