<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $firebaseService;

    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

    public function showUsers()
    {
        $users = $this->firebaseService->listUsers();
        return view('Chat.list', compact('users'));
    }
}
