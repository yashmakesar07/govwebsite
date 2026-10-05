<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Page extends Model
{
    protected $fillable = [
        'title_en', 'title_hi', 'content_en', 'content_hi',
        'slug', 'template', 'status', 'published_at', 'created_by',
    ];

    protected $casts = ['published_at' => 'datetime'];

    public function creator(): BelongsTo { return $this->belongsTo(User::class, 'created_by'); }
    public function scopePublished($query) { return $query->where('status', 'published'); }
    public function getTitle(): string { return app()->getLocale() === 'hi' && $this->title_hi ? $this->title_hi : $this->title_en; }
    public function getContent(): ?string { return app()->getLocale() === 'hi' && $this->content_hi ? $this->content_hi : $this->content_en; }
}
