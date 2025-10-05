<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| Cloud Storage configuration
| NOTE: This file contains credentials. For production, prefer environment variables or
| a secure secret manager and avoid committing secrets into version control.
*/

$config['cloud_storage'] = [
    'ACCESS_KEY' => '112HPA3FIMQSDSD2Z23Q',
    'SECRET_KEY' => '8Nh1QbARDpa0HbBCDXQ7tP0M6uh8r5ikgQZyAWqf',
    'SERVER'     => 'is3.cloudhost.id',
    'NAME'       => 'pantaoumedia',
    'PATH'       => '/asset_academy/',
    // Optional region; adjust if needed by your S3-compatible provider
    'REGION'     => 'us-east-1'
];
