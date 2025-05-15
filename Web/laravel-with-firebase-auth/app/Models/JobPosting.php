<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Application;

class JobPosting extends Model
{
    use HasFactory;

    protected $table = 'job_postings';

    protected $fillable = [
        'nama_pekerjaan',
        'email',
        'harga_pekerjaan',
        'deskripsi',
        'syarat_ketentuan',
        'lokasi',
        'status_pekerjaan',
        'jenis_pekerjaan',
        'status_pekerja',
        'time',
        'tanggaldanwaktu',
        'email_pengambil',
        'image1',
        'image2',
        'image3',
        'status'
    ];

    protected $casts = [
        'tanggaldanwaktu' => 'datetime',
    ];

    // Define the relationship with the Application model
    public function applications()
    {
        return $this->hasMany(Application::class, 'job_posting_id');
    }

    public function profil()
    {
        return $this->hasOne(Profil::class, 'user_id');
    }
}
