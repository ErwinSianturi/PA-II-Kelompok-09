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
            $table->string('provinsi');
            $table->string('desa');
            $table->string('alamat_lengkap');
            $table->string('pekerjaan');
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
