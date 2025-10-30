<?php

namespace Database\Seeders;

use App\Models\Translation;
use App\Models\VerseTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VerseTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $translations = [
            [
                'lang' => 'en',
                'authority' => 'abdel haleem',
                'json_path' => 'quran-data/en-haleem-simple.json',
                'description' => 'English translation by M.A.S. Abdel Haleem',
            ],
            [
                'lang' => 'ms',
                'authority' => 'abdullah basmeih',
                'json_path' => 'quran-data/abdullah-basamia-simple.json',
                'description' => 'Malay translation by Abdullah Muhammad Basmeih',
            ],
        ];

        foreach ($translations as $translationData) {
            $this->seedTranslation($translationData);
        }
    }

    private function seedTranslation(array $data): void
    {
        // Generate slug from lang + authority
        $slug = Str::slug($data['lang'] . '-' . $data['authority']);

        // Check if translation already exists
        $translation = Translation::where('slug', $slug)->first();

        if ($translation) {
            $this->command->info("Translation '{$slug}' already exists. Skipping...");
            return;
        }

        // Create new translation record
        $translation = Translation::create([
            'language_code' => $data['lang'],
            'authority' => $data['authority'],
            'slug' => $slug,
            'description' => $data['description'] ?? null,
        ]);

        $this->command->info("  Seeding translation: {$slug}");

        $jsonPath = resource_path($data['json_path']);
        
        if (!file_exists($jsonPath)) {
            $this->command->error("JSON file not found: {$jsonPath}");
            return;
        }

        $verses = json_decode(file_get_contents($jsonPath), true);

        if (!$verses) {
            $this->command->error("Failed to parse JSON file: {$jsonPath}");
            return;
        }

        // Prepare verse translations for batch insert
        $verseTranslations = [];
        foreach ($verses as $key => $value) {
            [$surahNumber, $verseNumber] = explode(':', $key);
            
            $verseTranslations[] = [
                'translation_id' => $translation->id,
                'surah_number' => (int) $surahNumber,
                'verse_number' => (int) $verseNumber,
                'text' => $value['t'],
            ];
        }

        $chunks = array_chunk($verseTranslations, 500);
        $totalChunks = count($chunks);
        
        foreach ($chunks as $index => $chunk) {
            DB::table('verse_translations')->insert($chunk);
            $this->command->info("  Inserted chunk " . ($index + 1) . " of {$totalChunks}");
        }

        $this->command->info("  Successfully seeded {$slug} with " . count($verseTranslations) . " verses");
    }
}
