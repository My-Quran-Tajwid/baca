<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class HafsWordSeeder extends Seeder
{
    /**
     * Run the database seeds. This seeder will take some time to complete. On
     * my machine, it took 348,990 ms (~5.8 minute) to seed 84,109 rows.
     */
    public function run(): void
    {
        // Database source: Quran Publisher App by Mujamma Malik Fahd. Exported to CSV from db.
        $csv = Reader::createFromPath(resource_path('csv/_Hafs_Word__202501082128.csv'), 'r');
        $csv->setHeaderOffset(0);

        // Total rows: 84109 rows
        $records = $csv->getRecords();

        // To speed up the seeding process, we will insert the records in batches
        // From 5 minutes, down to 2.4 secs!
        $batchSize = 500; // Define the batch size
        $batch = [];

        DB::transaction(function () use ($records, $batchSize, &$batch, &$batchCount) {
            foreach ($records as $record) {
                $batch[] = [
                    'Surah' => $record['Sura'],
                    'Ayat' => $record['Verse'],
                    'PageNo' => $record['PageNo'],
                    'LineNo' => $record['LineNo'],
                    'WordOrder' => $record['WordNum'],
                    'WordText' => $record['WordText'],
                    'FontFamily' => $record['FontName'],
                    'FontCode' => $record['FontCode'],
                    'Type' => $record['Type'],
                    'FontUniCode' => $record['FontUniCode'],
                ];

                if (count($batch) === $batchSize) {
                    DB::table('hafs_words')->insert($batch);
                    $batch = []; // Clear the batch
                }
            }

            // Insert any remaining rows
            if (!empty($batch)) {
                DB::table('hafs_words')->insert($batch);
            }
        });
    }
}
