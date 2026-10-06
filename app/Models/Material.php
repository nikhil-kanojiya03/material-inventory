<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['category_id', 'name', 'opening_balance'];

    protected $casts = [
        'opening_balance' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // All inward/outward movements recorded against this material.
    public function inwardOutwards(): HasMany
    {
        return $this->hasMany(InwardOutward::class);
    }

    // Current balance = opening balance plus every inward(+)/outward(-) quantity recorded so far.
    // Uses the withSum('inwardOutwards', 'quantity') eager aggregate when present (manage page)
    // to avoid an extra query per row, otherwise falls back to a direct sum query.
    public function getCurrentBalanceAttribute(): float
    {
        $movements = $this->attributes['inward_outwards_sum_quantity']
            ?? $this->inwardOutwards()->sum('quantity');

        return (float) $this->opening_balance + (float) $movements;
    }
}
