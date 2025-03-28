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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pekerjaan');
            $table->string('email');
            $table->decimal('harga_pekerjaan', 10, 2);
            $table->text('deskripsi');
            $table->enum('status_pekerjaan', ['Tersedia', 'Dalam Proses','Selesai'])->default('Tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
