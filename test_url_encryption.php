<?php
// Test URL encryption
require_once 'application/libraries/Encryption_url.php';

$encryption = new Encryption_url();

// Test cases
$test_ids = [1, 42, 123, 999];

echo "<h1>URL Encryption Test</h1>";
echo "<h2>Testing encryption and decryption</h2>";

echo "<table border='1' cellpadding='10'>";
echo "<tr><th>Original ID</th><th>Encrypted</th><th>Decrypted</th><th>Match</th></tr>";

foreach ($test_ids as $original_id) {
    $encrypted = $encryption->encode($original_id);
    $decrypted = $encryption->decode($encrypted);
    $match = ($decrypted === $original_id) ? '✅' : '❌';
    
    echo "<tr>";
    echo "<td>{$original_id}</td>";
    echo "<td>{$encrypted}</td>";
    echo "<td>{$decrypted}</td>";
    echo "<td>{$match}</td>";
    echo "</tr>";
}

echo "</table>";

echo "<h2>Testing URL Safety</h2>";
foreach ($test_ids as $id) {
    $encrypted = $encryption->encode($id);
    $url = "http://localhost/aset-academy/workshops/detail/{$encrypted}";
    echo "ID {$id}: <a href='{$url}' target='_blank'>{$url}</a><br>";
}
?>
