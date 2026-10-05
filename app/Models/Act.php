<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Act extends Model
{
    protected $fillable = [
        'title_en', 'title_hi', 'description_en', 'description_hi',
        'type', 'year', 'language', 'category', 'slug',
        'file_path', 'file_size', 'status', 'published_at', 'created_by',
    ];

    protected $casts = ['published_at' => 'datetime'];

    public function creator(): BelongsTo { return $this->belongsTo(User::class, 'created_by'); }
    public function scopePublished($query) { return $query->where('status', 'published'); }
    public function getTitle(): string { return app()->getLocale() === 'hi' && $this->title_hi ? $this->title_hi : $this->title_en; }
    public function getDescription(): ?string { return app()->getLocale() === 'hi' && $this->description_hi ? $this->description_hi : $this->description_en; }
    public function getFormattedFileSize(): string {
        if (!$this->file_size) return '—';
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        $size = $this->file_size;
        while ($size >= 1024 && $i < count($units) - 1) { $size /= 1024; $i++; }
        return round($size, 1) . ' ' . $units[$i];
    }
}
