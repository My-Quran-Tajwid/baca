<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Translation extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'language_code',
        'authority',
        'slug',
        'description',
    ];

    public function verseTranslations(): HasMany
    {
        return $this->hasMany(VerseTranslation::class);
    }
}
