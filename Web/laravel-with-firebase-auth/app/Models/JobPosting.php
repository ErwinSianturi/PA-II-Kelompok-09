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
        'time',
        'syarat_ketentuan',
        'lingkup_kerja',
        'status_pekerjaan',
        'jenis_pekerjaan',
        'image1',
        'image2',
        'image3',
    ];

    // Define the relationship with the Application model
    public function applications()
    {
        return $this->hasMany(Application::class, 'job_posting_id');
    }
}
