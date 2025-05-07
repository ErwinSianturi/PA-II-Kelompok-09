<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth as FirebaseAuth;
use Illuminate\Http\Request;

class FirebaseController extends Controller
{
    protected $auth;

    public function __construct()
    {
        $this->auth = (new Factory)
            ->withServiceAccount(env('FIREBASE_CREDENTIALS')) // Explicitly set the credentials
            ->createAuth();
    }

    public function listUsers()
    {
        try {
            $users = [];
            $nextPageToken = null;

            // Fetch users in batches of 1000
            do {
                $listUsers = $this->auth->listUsers(1000, $nextPageToken);
                foreach ($listUsers->users() as $user) {
                    $users[] = $user->jsonSerialize();
                }
                $nextPageToken = $listUsers->pageToken();
            } while ($nextPageToken);

            return response()->json($users);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
