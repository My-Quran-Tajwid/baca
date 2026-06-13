<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Juzuk extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'juzuks';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'juz_number';

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
