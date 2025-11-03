<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VerseTranslation extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'translation_id',
        'surah_number',
        'verse_number',
        'text',
    ];

    public function translation(): BelongsTo
    {
        return $this->belongsTo(Translation::class);
    }
}
