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
        'kecamatan',
        'desa',
        'alamat_lengkap',
        'pekerjaan',
        'WA',
        'Status',
        'Pembayaran',
        'status_akun',
    ];

    // Set email as the primary key (if it's not already)
    protected $primaryKey = 'email';

    // Optionally, if 'email' is not automatically treated as unique, you can make it unique in the migration
    protected $keyType = 'string';

    public function jobPosting()
    {
        return $this->belongsTo(JobPosting::class, 'user_id');
    }
}
