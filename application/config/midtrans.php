<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Midtrans configuration for testing.
 *
 * The SDK will use these credentials when instantiated through our helper.
 * For production, override via environment variables.
 */
// Validate required environment variables for Midtrans

$config['midtrans_is_production'] = env('MIDTRANS_IS_PRODUCTION') === 'true';
$config['midtrans_server_key'] = env('MIDTRANS_SERVER_KEY');
$config['midtrans_client_key'] = env('MIDTRANS_CLIENT_KEY');
$config['midtrans_merchant_id'] = env('MIDTRANS_MERCHANT_ID');

$config['midtrans_sanitize_callbacks'] = true;
$config['midtrans_enable_3ds'] = true;
