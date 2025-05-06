<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengalamanKerja extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural form of the model name
    protected $table = 'pengalaman_kerja';

    // Define the fillable attributes
    protected $fillable = [
        'user_id',
        'position',
        'company_name',
        'country',
        'city',
        'start_date',
        'end_date',
        'is_current',
        'job_function',
        'industry',
        'job_level',
        'job_type',
        'description',
    ];

    // Define the relationship with the Profil model
    public function profil()
    {
        return $this->belongsTo(Profil::class, 'user_id');
    }
}
