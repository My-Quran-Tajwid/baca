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
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->string('language_code', 10); // 'en', 'ms'
            $table->string('authority', 100); // 'Abdel Haleem', 'Abdullah Basmeih'
            $table->string('slug', 50)->unique()->comment('e.g., en-haleem, ms-basmeih');
            $table->text('description')->nullable();
            
            $table->index('language_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translations');
    }
};
