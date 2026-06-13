<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['language_code', 'authority', 'slug', 'description'])]
class Translation extends Model
{
    public $timestamps = false;

    public function verseTranslations(): HasMany
    {
        return $this->hasMany(VerseTranslation::class);
    }
}
