<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FinancialDisclosure extends Model
{
    protected $fillable = [
        'financial_year', 'quarter', 'fund_receipts', 'expenditure',
        'project_allocation', 'project_category',
        'remarks_en', 'remarks_hi',
        'status', 'published_at', 'created_by',
    ];

    protected $casts = [
        'fund_receipts' => 'decimal:2',
        'expenditure' => 'decimal:2',
        'project_allocation' => 'decimal:2',
        'published_at' => 'datetime',
    ];

    public function creator(): BelongsTo { return $this->belongsTo(User::class, 'created_by'); }
    public function scopePublished($query) { return $query->where('status', 'published'); }
    public function getRemarks(): ?string { return app()->getLocale() === 'hi' && $this->remarks_hi ? $this->remarks_hi : $this->remarks_en; }
}
