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
            $table->text('syarat_ketentuan')->nullable();
            $table->text('lokasi')->nullable();
            $table->enum('status_pekerjaan', ['Tersedia', 'Dalam Proses','Selesai'])->default('Tersedia');
            $table->enum('jenis_pekerjaan', ['Kebersihan', 'Perbaikan Rumah','Perbaikan Kendaraan','Perbaikan Elektronik', 'Tutor', 'Rumah Tangga', 'Fotografi & videografi', 'Lainnya'])->default('Lainnya');
            $table->enum('status_pekerja',['Menunggu', 'Bekerja', 'Selesai'])->nullable();
            $table->integer('time');
            $table->timestamp('tanggaldanwaktu');
            $table->string('email_pengambil')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
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
