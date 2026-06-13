<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

#[Table('juzuks', key: 'juz_number')]
class Juzuk extends Model
{
    /**
     * The first Surah for the Juzuk.
     */
    protected function firstSurah(): Attribute
    {
        return Attribute::make(
            get: fn () => Surah::find((int) explode(':', $this->first_verse_key)[0])
        );
    }

    /**
     * The first verse number for the Juzuk.
     */
    protected function firstVerse(): Attribute
    {
        return Attribute::make(
            get: fn () => explode(':', $this->first_verse_key)[1]
        );
    }

    /**
     * The last Surah for the Juzuk.
     */
    protected function lastSurah(): Attribute
    {
        return Attribute::make(
            get: fn () => Surah::find((int) explode(':', $this->last_verse_key)[0])
        );
    }

    /**
     * The last verse number for the Juzuk.
     */
    protected function lastVerse(): Attribute
    {
        return Attribute::make(
            get: fn () => explode(':', $this->last_verse_key)[1]
        );
    }
}
