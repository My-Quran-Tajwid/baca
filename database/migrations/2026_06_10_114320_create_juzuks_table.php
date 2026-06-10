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
        Schema::create('juzuks', function (Blueprint $table) {
            $table->integer('juz_number');
            $table->integer('verses_count');
            $table->text('first_verse_key');
            $table->text('last_verse_key');
            $table->json('verse_mapping');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('juzuks');
    }
};
