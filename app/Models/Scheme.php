<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Scheme extends Model
{
    protected $fillable = [
        'title_en', 'title_hi', 'description_en', 'description_hi',
        'objectives_en', 'objectives_hi', 'eligibility_en', 'eligibility_hi',
        'slug', 'progress_percentage', 'financial_allocation',
        'beneficiaries_count', 'scheme_status', 'status',
        'image_path', 'published_at', 'created_by',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'financial_allocation' => 'decimal:2',
    ];

    public function creator(): BelongsTo { return $this->belongsTo(User::class, 'created_by'); }
    public function documents(): MorphMany { return $this->morphMany(Document::class, 'documentable'); }
    public function scopePublished($query) { return $query->where('status', 'published'); }
    public function getTitle(): string { return app()->getLocale() === 'hi' && $this->title_hi ? $this->title_hi : $this->title_en; }
    public function getDescription(): ?string { return app()->getLocale() === 'hi' && $this->description_hi ? $this->description_hi : $this->description_en; }
    public function getObjectives(): ?string { return app()->getLocale() === 'hi' && $this->objectives_hi ? $this->objectives_hi : $this->objectives_en; }
    public function getEligibility(): ?string { return app()->getLocale() === 'hi' && $this->eligibility_hi ? $this->eligibility_hi : $this->eligibility_en; }
}
