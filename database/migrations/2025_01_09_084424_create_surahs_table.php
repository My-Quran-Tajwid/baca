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
        Schema::create('surahs', function (Blueprint $table) {
            $table->id();
            $table->integer('no_surah');
            $table->integer('bilangan_ayat');
            $table->integer('muka_surat');
            $table->integer('juzuk');
            $table->string('nama_english');
            $table->string('nama_melayu');
            $table->string('nama_arab');
            $table->string('maksud_english');
            $table->string('maksud_melayu');
            $table->char('tempat_diturunkan', 1)->comment("M - Mekah, D - Madinah");
            // $table->timestamps(); // We don't need timestamp, this is just readonly data
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surahs');
    }
};
