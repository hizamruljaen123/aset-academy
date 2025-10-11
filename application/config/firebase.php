<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Firebase Configuration
|--------------------------------------------------------------------------
|
| This file contains the configuration for Firebase services.
| All sensitive data is loaded from environment variables.
|
*/

$config['firebase'] = [
    // Firebase Web SDK Configuration
    'api_key' => env('FIREBASE_API_KEY'),
    'auth_domain' => env('FIREBASE_AUTH_DOMAIN'),
    'project_id' => env('FIREBASE_PROJECT_ID'),
    'storage_bucket' => env('FIREBASE_STORAGE_BUCKET'),
    'messaging_sender_id' => env('FIREBASE_MESSAGING_SENDER_ID'),
    'app_id' => env('FIREBASE_APP_ID'),
    
    // Firebase Admin SDK Configuration
    'admin' => [
        'type' => env('FIREBASE_ADMIN_TYPE'),
        'project_id' => env('FIREBASE_ADMIN_PROJECT_ID'),
        'private_key_id' => env('FIREBASE_ADMIN_PRIVATE_KEY_ID'),
        'private_key' => env('FIREBASE_ADMIN_PRIVATE_KEY'),
        'client_email' => env('FIREBASE_ADMIN_CLIENT_EMAIL'),
        'client_id' => env('FIREBASE_ADMIN_CLIENT_ID'),
        'auth_uri' => env('FIREBASE_ADMIN_AUTH_URI'),
        'token_uri' => env('FIREBASE_ADMIN_TOKEN_URI'),
        'auth_provider_x509_cert_url' => env('FIREBASE_ADMIN_AUTH_PROVIDER_CERT_URL'),
        'client_x509_cert_url' => env('FIREBASE_ADMIN_CLIENT_CERT_URL'),
        'universe_domain' => env('FIREBASE_ADMIN_UNIVERSE_DOMAIN') ?: 'googleapis.com'
    ]
];
