<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Encryption Configuration
|--------------------------------------------------------------------------
|
| Konfigurasi untuk library encryption URL
|
*/

// Encryption Key untuk URL encryption
// HARUS DIGANTI di production environment!
$config['encryption_key'] = 'aset-academy-2024-secure-key-change-this-in-production';

// Cipher method untuk encryption
$config['cipher'] = 'AES-256-CBC';

// Enable/disable URL encryption (untuk debugging)
$config['enable_url_encryption'] = TRUE;
