<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profil extends Model
{
    use HasFactory;
    protected $table = 'profils';
    protected $fillable = [
        'email',
        'username',
        'image',
        'jenis_kelamin',
        'tanggal_lahir',
        'image',
        'provinsi',
        'desa',
        'alamat_lengkap',
        'pekerjaan',
    ];
}
