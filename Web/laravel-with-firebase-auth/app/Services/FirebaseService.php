<?php

namespace App\Services;

use Google\Cloud\Core\ExponentialBackoff;
use Google\Cloud\Firestore\FirestoreClient;
use Google\Cloud\Firestore\DocumentSnapshot;
use Firebase\Auth\Token\Exception\InvalidToken;
use Firebase\Auth\Token\Verifier;
use Illuminate\Support\Facades\Storage;

class FirebaseService
{
    protected $firestore;

    public function __construct()
    {
        $this->initializeFirestore();
    }

    /**
     * Initialize Firestore client
     */
    protected function initializeFirestore()
    {
        $jsonCredentials = Storage::path('firebase/credentials.json');
        $this->firestore = new FirestoreClient([
            'keyFilePath' => $jsonCredentials
        ]);
    }

    /**
     * List all Firebase users
     *
     * @return array
     */
    public function listUsers()
    {
        $users = [];
        $batch = $this->firestore->documentsIterator();

        foreach ($batch as $document) {
            $users[] = $document->data();
        }

        return $users;
    }
}
