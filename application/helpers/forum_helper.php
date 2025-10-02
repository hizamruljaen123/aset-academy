<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Forum Helper
 * 
 * Provides helper functions for forum functionality
 */

if (!function_exists('timespan')) {
    /**
     * Timespan function to format time difference
     * 
     * @param int $seconds Timestamp
     * @param int $now Current timestamp
     * @param int $levels Number of levels to show
     * @return string Formatted time difference
     */
    function timespan($seconds, $now = '', $levels = 2) {
        if ($seconds == '' OR $seconds == 'now' OR $seconds == 0) {
            return 'baru saja';
        }

        if (!is_numeric($seconds)) {
            $seconds = time() - $seconds;
        }

        if (!is_numeric($now)) {
            $now = time();
        }

        // Difference in seconds
        $difference = $now - $seconds;

        // Set the periods of time
        $periods = [
            'tahun' => 31556926,
            'bulan' => 2629744,
            'minggu' => 604800,
            'hari' => 86400,
            'jam' => 3600,
            'menit' => 60,
            'detik' => 1
        ];

        $output = '';

        foreach ($periods as $period => $value) {
            if ($difference >= $value) {
                $time = floor($difference / $value);
                $difference %= $value;
                $output .= $time . ' ' . $period;
                
                if ($time > 1) {
                    $output .= 's';
                }
                
                $levels--;
                
                if ($levels == 0) {
                    break;
                }
            }
        }

        return $output . ' yang lalu';
    }
}

if (!function_exists('format_forum_content')) {
    /**
     * Format forum content for display
     * 
     * @param string $content Raw content
     * @return string Formatted content
     */
    function format_forum_content($content) {
        // Convert newlines to HTML line breaks
        $content = nl2br(html_escape($content));
        
        // Simple URL parsing (basic implementation)
        $content = preg_replace('/(https?:\/\/[^\s]+)/', '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>', $content);
        
        return $content;
    }
}

if (!function_exists('get_user_avatar')) {
    /**
     * Get user avatar HTML
     * 
     * @param string $username Username
     * @param int $size Avatar size
     * @return string HTML for avatar
     */
    function get_user_avatar($username, $size = 40) {
        $initial = strtoupper(substr($username, 0, 1));
        $colors = ['bg-blue-500', 'bg-green-500', 'bg-purple-500', 'bg-pink-500', 'bg-indigo-500'];
        $color = $colors[ord($initial) % count($colors)];
        
        return '<div class="w-' . ($size/10) . ' h-' . ($size/10) . ' rounded-full ' . $color . ' flex items-center justify-center text-white font-medium text-sm">
                    ' . $initial . '
                </div>';
    }
}