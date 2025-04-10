<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    use HasFactory;
    protected $table = 'job_postings';
    protected $fillable = [
        'nama_pekerjaan',
        'email',
        'harga_pekerjaan',
        'deskripsi',
        'status_pekerjaan',
        'jenis_pekerjaan',
        'image'
    ];
}
