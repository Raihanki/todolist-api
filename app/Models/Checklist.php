<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Checklist extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    /**
     * Get the user that owns the checklist (relation).
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the checklist items for the checklist (relation).
     *
     * @return HasMany
     */
    public function checklistItems(): HasMany
    {
        return $this->hasMany(ChecklistItem::class);
    }
}
