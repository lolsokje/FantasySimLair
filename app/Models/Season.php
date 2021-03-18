<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Season extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function championship(): BelongsTo
    {
        return $this->belongsTo(Championship::class);
    }
}
