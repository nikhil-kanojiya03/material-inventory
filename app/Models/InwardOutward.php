<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InwardOutward extends Model
{
    use HasFactory;

    protected $fillable = ['material_id', 'entry_date', 'quantity'];

    protected $casts = [
        'entry_date' => 'date',
        'quantity' => 'decimal:2',
    ];

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
}
