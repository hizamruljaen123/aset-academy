<?php
// Simple migration runner
require_once 'index.php';

$CI =& get_instance();
$CI->load->library('migration');

if ($CI->migration->current() === FALSE) {
    show_error($CI->migration->error_string());
} else {
    echo "Migration successful!\n";
}

echo "All done!\n";
