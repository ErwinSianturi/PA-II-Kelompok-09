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
        Schema::create('profils', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('username');
            $table->enum('jenis_kelamin',['Laki-laki', 'Perempuan']);
            $table->date('tanggal_lahir');
            $table->enum('kecamatan', [
                'Ajibata',
                'Balige',
                'Bonatua Lunasi',
                'Borbor',
                'Habinsaran',
                'Laguboti',
                'Lumban Julu',
                'Nassau',
                'Parmaksian',
                'Pintu Pohan Meranti',
                'Porsea',
                'Siantar Narumonda',
                'Sigumpar',
                'Silaen',
                'Tampahan',
                'Uluan'
            ]);
            $table->string('WA');
            $table->enum('status_akun', ['Aktif', 'Non-Aktif'])->default('Aktif');
            $table->string('desa');
            $table->string('alamat_lengkap')->nullable();
            $table->string('pekerjaan');
            $table->string('Pembayaran')->nullable();
            $table->enum('status_pekerja',['Menunggu', 'Bekerja', 'Selesai'])->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profils');
    }
};
