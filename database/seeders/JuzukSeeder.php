<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class JuzukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Database source: https://qul.tarteel.ai/resources/quran-metadata/68
        $csv = Reader::createFromPath(resource_path('quran-data/qul-juz.csv'), 'r');
        $csv->setHeaderOffset(0);

        $records = $csv->getRecords();
        foreach ($records as $record) {
            DB::table('juzuks')->insert([
                'juz_number' => $record['juz_number'],
                'verses_count' => $record['verses_count'],
                'first_verse_key' => $record['first_verse_key'],
                'last_verse_key' => $record['last_verse_key'],
                'verse_mapping' => json_encode(json_decode($record['verse_mapping'])),
            ]);
        }
    }
}
