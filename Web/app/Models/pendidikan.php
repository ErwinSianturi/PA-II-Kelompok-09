<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pendidikan extends Model
{
    use HasFactory;
    protected $table = 'pendidikan';

    // Define the fillable attributes
    protected $fillable = [
        'email',
        'jenjang_pendidikan',
        'nama_institusi',
        'jurusan',
    ];
}
