<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pendidikan', function (Blueprint $table) {
            // Make email the primary key instead of the default 'id'
            $table->id();
            $table->string('email');

            // Menambahkan kolom jenjang pendidikan dengan tipe enum
            $table->enum('jenjang_pendidikan', ['Tidak Sekolah', 'SD', 'SMP', 'SMA', 'D3', 'D4', 'S1', 'S2', 'S3'])
                ->default('Tidak Sekolah');

            // Menambahkan kolom nama institusi yang nullable
            $table->string('nama_institusi')->nullable();

            // Menambahkan kolom jurusan yang nullable
            $table->string('jurusan')->nullable();

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendidikan');
    }
};
