<?php
// Test untuk memverifikasi auth routes berfungsi

echo "<!DOCTYPE html>";
echo "<html>";
echo "<head>";
echo "    <title>Test Auth Routes</title>";
echo "    <style>body { font-family: Arial, sans-serif; margin: 20px; }</style>";
echo "</head>";
echo "<body>";
echo "<h1>Auth Routes Test</h1>";

// Test URLs
$test_urls = [
    'Auth Login' => site_url('auth/login'),
    'Auth Index' => site_url('auth'),
    'Auth Register' => site_url('auth/register'),
    'Auth Logout' => site_url('auth/logout'),
    'Auth Forgot Password' => site_url('auth/forgot_password'),
];

echo "<h2>Available Auth Routes:</h2>";
echo "<ul>";
foreach ($test_urls as $name => $url) {
    echo "<li><a href='{$url}' target='_blank'>{$name}: {$url}</a></li>";
}
echo "</ul>";

echo "<h2>Test Instructions:</h2>";
echo "<ol>";
echo "<li>Klik link 'Auth Login' untuk mengakses halaman login</li>";
echo "<li>Gunakan username: admin dan password: admin123 untuk test login admin</li>";
echo "<li>Gunakan username: student dan password: student123 untuk test login student</li>";
echo "<li>Setelah login, Anda akan diarahkan ke dashboard yang sesuai</li>";
echo "</ol>";

echo "</body>";
echo "</html>";
