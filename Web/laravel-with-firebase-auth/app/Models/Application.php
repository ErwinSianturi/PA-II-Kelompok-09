<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $table = 'applications';

    protected $fillable = [
        'user_email',
        'job_posting_id',
        'alasan',
    ];

    // Define the inverse relationship with JobPosting
    public function jobPosting()
    {
        return $this->belongsTo(JobPosting::class);
    }
}
