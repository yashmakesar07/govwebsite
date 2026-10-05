<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Notice extends Model
{
    protected $fillable = [
        'title_en', 'title_hi', 'content_en', 'content_hi',
        'category', 'slug', 'is_new', 'file_path',
        'status', 'published_at', 'created_by',
    ];

    protected $casts = [
        'is_new' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function creator(): BelongsTo { return $this->belongsTo(User::class, 'created_by'); }
    public function documents(): MorphMany { return $this->morphMany(Document::class, 'documentable'); }

    public function scopePublished($query) { return $query->where('status', 'published')->whereNotNull('published_at'); }

    public function getTitle(): string
    {
        $locale = app()->getLocale();
        return $locale === 'hi' && $this->title_hi ? $this->title_hi : $this->title_en;
    }

    public function getContent(): ?string
    {
        $locale = app()->getLocale();
        return $locale === 'hi' && $this->content_hi ? $this->content_hi : $this->content_en;
    }
}
