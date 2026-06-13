<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['translation_id', 'surah_number', 'verse_number', 'text'])]
class VerseTranslation extends Model
{
    public $timestamps = false;

    public function translation(): BelongsTo
    {
        return $this->belongsTo(Translation::class);
    }
}
