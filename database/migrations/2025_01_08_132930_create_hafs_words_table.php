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
        Schema::create('hafs_words', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('Surah')->unsigned();
            $table->smallInteger('Ayat')->unsigned();
            $table->smallInteger('PageNo')->unsigned();
            $table->tinyInteger('LineNo')->unsigned();
            $table->smallInteger('WordOrder')->unsigned();
            $table->string('WordText');
            $table->string('FontFamily');
            $table->integer('FontCode')->unsigned();
            $table->tinyInteger('Type')->unsigned()->comment('1: Quran Words, 4: Basmalah, 5: Surah Name, 6: Ayat Number, 7: Quarter Mark, 8: Sajda Marks');
            $table->string('FontUniCode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hafs_words');
    }
};
