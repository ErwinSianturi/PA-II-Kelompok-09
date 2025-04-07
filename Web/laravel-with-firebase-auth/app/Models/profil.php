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
        'foto profil',
        'jenis_kelamin',
        'tanggal_lahir',
        'image',
        'provinsi',
        'alamat_lengkap',
        'pekerjaan',
    ];
}
