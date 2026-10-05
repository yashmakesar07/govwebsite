<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'title_en', 'title_hi', 'caption_en', 'caption_hi',
        'category', 'file_path', 'thumbnail_path', 'date', 'status',
    ];

    protected $casts = ['date' => 'date'];

    public function scopePublished($query) { return $query->where('status', 'published'); }
    public function getTitle(): string { return app()->getLocale() === 'hi' && $this->title_hi ? $this->title_hi : $this->title_en; }
    public function getCaption(): ?string { return app()->getLocale() === 'hi' && $this->caption_hi ? $this->caption_hi : $this->caption_en; }
}
