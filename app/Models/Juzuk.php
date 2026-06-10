<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Juzuk extends Model
{
    protected $table = 'juzuks';

    protected $fillable = [
        'juz_number',
        'verses_count',
        'first_verse_key',
        'last_verse_key',
        'verse_mapping',
    ];
}
