<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Error Helper
 * 
 * Helper functions untuk menampilkan error dengan lebih mudah
 */

if (!function_exists('show_error_with_code')) {
    /**
     * Show error dengan status code yang benar
     * 
     * @param string $message Error message yang akan ditampilkan
     * @param int $status_code HTTP status code (default: 500)
     * @param string $heading Optional heading (default: auto-generate dari status code)
     * @return void
     */
    function show_error_with_code($message, $status_code = 500, $heading = null)
    {
        // Auto-generate heading berdasarkan status code
        if ($heading === null) {
            $headings = [
                400 => 'Bad Request',
                401 => 'Unauthorized',
                403 => 'Access Denied',
                404 => 'Not Found',
                405 => 'Method Not Allowed',
                500 => 'Internal Server Error',
                503 => 'Service Unavailable'
            ];
            
            $heading = isset($headings[$status_code]) ? $headings[$status_code] : 'Error';
        }
        
        // Pilih template berdasarkan status code
        $template = 'error_general';
        if ($status_code == 404) {
            $template = 'error_404';
        } elseif ($status_code == 403) {
            $template = 'error_403';
        }
        
        // Pastikan status_code adalah numeric
        $status_code = (int)$status_code;
        
        // Call show_error dengan urutan parameter yang benar
        show_error($heading, $message, $template, $status_code);
    }
}

if (!function_exists('show_403')) {
    /**
     * Shortcut untuk menampilkan 403 Forbidden error
     * 
     * @param string $message Error message
     * @return void
     */
    function show_403($message = 'You do not have permission to access this resource.')
    {
        show_error_with_code($message, 403, 'Access Denied');
    }
}

if (!function_exists('show_404')) {
    /**
     * Shortcut untuk menampilkan 404 Not Found error
     * 
     * @param string $message Error message
     * @return void
     */
    function show_404_error($message = 'The requested resource was not found.')
    {
        show_error_with_code($message, 404, 'Not Found');
    }
}

if (!function_exists('show_500')) {
    /**
     * Shortcut untuk menampilkan 500 Internal Server Error
     * 
     * @param string $message Error message
     * @return void
     */
    function show_500($message = 'An internal server error occurred.')
    {
        show_error_with_code($message, 500, 'Internal Server Error');
    }
}

