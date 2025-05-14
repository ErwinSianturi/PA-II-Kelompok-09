<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    // Set the $fillable property to allow mass assignment for sender_email, receiver_email, and message
    protected $fillable = ['sender_email', 'receiver_email', 'message'];

    // Define the relationship to the sender (Profil model) based on email instead of ID
    public function sender()
    {
        return $this->belongsTo(Profil::class, 'sender_email', 'email');
    }

    // Define the relationship to the receiver (Profil model) based on email instead of ID
    public function receiver()
    {
        return $this->belongsTo(Profil::class, 'receiver_email', 'email');
    }
}
