<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

class FirebaseService
{
    private $auth;

    public function __construct()
    {
        try {
            // Initialize Firebase Auth using the service account key
            $firebase = (new Factory)
                ->withServiceAccount(base_path('resources/credentials/firebase_credentials.json')) // Absolute path to the service account key
                ->createAuth();  // Use createAuth to get the Firebase Auth instance

            $this->auth = $firebase;
        } catch (\Exception $e) {
            // Handle any errors that occur during initialization
            die('Error initializing Firebase Auth: ' . $e->getMessage());
        }
    }

    // Function to list all users
    public function listAllUsers()
    {
        try {
            $users = [];
            $pageToken = null;
            $batchSize = 1000;  // Set a valid batch size (1000 users per request)

            // Loop to paginate through all users
            do {
                // Get users with pagination, passing the batch size and page token
                $result = $this->auth->listUsers($batchSize, $pageToken);
                $users = array_merge($users, iterator_to_array($result->users())); // Merge users in a single array
                $pageToken = $result->pageToken();  // Get the next page token if more users exist
            } while ($pageToken);  // Continue until no more users are available

            return $users; // Return all users

        } catch (\Exception $e) {
            // Handle errors when trying to list users
            return ['error' => 'Error listing users: ' . $e->getMessage()];
        }
    }
}
