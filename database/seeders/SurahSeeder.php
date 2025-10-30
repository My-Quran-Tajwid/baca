<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class SurahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Database source: Smart Quran DB
        $csv = Reader::createFromPath(resource_path('quran-data/surahs-smartquran.csv'), 'r');
        $csv->setHeaderOffset(0);

        $records = $csv->getRecords();
        foreach ($records as $record) {
            DB::table('surahs')->insert([
                'no_surah' => $record['no_surah'],
                'bilangan_ayat' => $record['bilangan_ayat'],
                'muka_surat' => $record['muka_surat'],
                'juzuk' => $record['juzuk'],
                'nama_english' => $record['nama_english'],
                'nama_melayu' => $record['nama_melayu'],
                'nama_arab' => $record['nama_arab'],
                'maksud_english' => $record['maksud_english'],
                'maksud_melayu' => $record['maksud_melayu'],
                'tempat_diturunkan' => $record['tempat_diturunkan'],
            ]);
        }
    }
}
