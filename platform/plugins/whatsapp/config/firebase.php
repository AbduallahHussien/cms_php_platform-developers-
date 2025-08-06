<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Firebase Service Account
    |--------------------------------------------------------------------------
    |
    | Path to the Firebase service account credentials JSON file you downloaded
    | from your Firebase Console. This is required for Laravel to connect to
    | Firebase securely.
    |
    */

    'credentials' => [
        'file' => plugin_path('whatsapp\\whatsapp.json'), // 👈 Put your JSON here
    ],

    /*
    |--------------------------------------------------------------------------
    | Firebase Realtime Database URL
    |--------------------------------------------------------------------------
    |
    | Your Firebase Realtime Database URL from the Firebase console.
    | Example: https://your-project-id.firebaseio.com
    |
    */

    'database' => [
        'url' => env('FIREBASE_DATABASE_URL', 'https://your-project-id.firebaseio.com'),
    ],

];
