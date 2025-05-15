<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public $fillable = [
        'email',
        'job_id',
        'price',
        'biaya_admin',
        'status',
        'snap_token',
    ];
}
