<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerseTranslation extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'translation_id',
        'surah_number',
        'verse_number',
        'text',
    ];
}
