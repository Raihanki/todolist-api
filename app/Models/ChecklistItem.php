<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChecklistItem extends Model
{
    use HasFactory;

    protected $fillable = ['item_name', 'is_completed'];

    /**
     * Get checklist that owns the checklist item (relation)
     *
     * @return BelongsTo
     */
    public function checklist(): BelongsTo
    {
        return $this->belongsTo(Checklist::class);
    }
}
