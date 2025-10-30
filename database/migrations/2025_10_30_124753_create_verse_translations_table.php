<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('verse_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('translation_id'); // References translations.id
            $table->unsignedTinyInteger('surah_number');
            $table->unsignedSmallInteger('verse_number');
            $table->text('text');
            
            $table->unique(['translation_id', 'surah_number', 'verse_number'], 'verse_translation_unique');
            $table->index(['surah_number', 'verse_number']);
            $table->index('translation_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verse_translations');
    }
};
