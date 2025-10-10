<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Midtrans configuration for testing.
 *
 * The SDK will use these credentials when instantiated through our helper.
 * For production, override via environment variables.
 */
$config['midtrans_is_production'] = getenv('MIDTRANS_IS_PRODUCTION') === 'true';
$config['midtrans_server_key'] = getenv('MIDTRANS_SERVER_KEY') ?: 'Mid-server-KXtae-QeXAJ737ZpyqRAzsNO';
$config['midtrans_client_key'] = getenv('MIDTRANS_CLIENT_KEY') ?: 'Mid-client-AtOLqdbsCvYgyBse';
$config['midtrans_merchant_id'] = getenv('MIDTRANS_MERCHANT_ID') ?: 'G457493821';

$config['midtrans_sanitize_callbacks'] = true;
$config['midtrans_enable_3ds'] = true;
