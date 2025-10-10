<?php
// Test decryption for the given encrypted parameter
require_once 'index.php';

$CI =& get_instance();
$CI->load->library('encryption_url');

$encrypted = 'p0w_d6Nns-exg5KFUeEVl3ZyMS9pQ0FmTVRUdUVLSmY1ZnIydkE9PQ';
$decrypted = $CI->encryption_url->decode($encrypted);

echo "Encrypted: $encrypted\n";
echo "Decrypted: $decrypted\n";
echo "Is valid: " . ($decrypted !== false ? 'YES' : 'NO') . "\n";
echo "Type: " . gettype($decrypted) . "\n";
