<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Cache Management Helper
 *
 * Helper functions untuk mengelola cache headers dan optimasi performa
 */

/**
 * Force no-cache headers untuk halaman dinamis
 * Gunakan di controller untuk halaman yang tidak boleh di-cache
 */
if (!function_exists('force_no_cache')) {
    function force_no_cache()
    {
        $CI = &get_instance();
        $CI->output
            ->set_header('Cache-Control: no-cache, no-store, must-revalidate')
            ->set_header('Expires: 0')
            ->set_header('Pragma: no-cache');
    }
}

/**
 * Set cache headers untuk assets statis
 * Gunakan untuk file CSS, JS, images yang jarang berubah
 */
if (!function_exists('set_asset_cache')) {
    function set_asset_cache($max_age = 31536000) // Default 1 tahun
    {
        $CI = &get_instance();
        $expires = gmdate('D, d M Y H:i:s', time() + $max_age) . ' GMT';

        $CI->output
            ->set_header('Cache-Control: public, max-age=' . $max_age)
            ->set_header('Expires: ' . $expires)
            ->set_header('Pragma: cache');
    }
}

/**
 * Set cache headers untuk halaman HTML
 * Gunakan untuk halaman yang relatif statis
 */
if (!function_exists('set_page_cache')) {
    function set_page_cache($max_age = 3600) // Default 1 jam
    {
        $CI = &get_instance();
        $expires = gmdate('D, d M Y H:i:s', time() + $max_age) . ' GMT';

        $CI->output
            ->set_header('Cache-Control: public, max-age=' . $max_age)
            ->set_header('Expires: ' . $expires)
            ->set_header('Pragma: cache');
    }
}

/**
 * Generate cache-busting filename dengan version hash
 * Untuk memaksa browser download ulang saat file berubah
 */
if (!function_exists('cache_bust')) {
    function cache_bust($filename, $path = '')
    {
        $CI = &get_instance();

        // Jika path tidak disediakan, gunakan base_url
        if (empty($path)) {
            $path = $CI->config->item('base_url');
        }

        // Cek apakah file ada dan dapat dibaca
        $full_path = FCPATH . $filename;
        if (file_exists($full_path)) {
            $version = filemtime($full_path);
            return $path . $filename . '?v=' . $version;
        }

        // Fallback jika file tidak ditemukan
        return $path . $filename;
    }
}

/**
 * Generate ETag untuk content
 * Membantu browser menentukan apakah content berubah
 */
if (!function_exists('generate_etag')) {
    function generate_etag($content)
    {
        $etag = md5($content);
        $CI = &get_instance();

        $CI->output->set_header('ETag: "' . $etag . '"');

        // Check If-None-Match header
        $if_none_match = $CI->input->get_request_header('If-None-Match');
        if ($if_none_match && trim($if_none_match, '"') === $etag) {
            $CI->output->set_status_header(304);
            $CI->output->_display();
            exit;
        }
    }
}

/**
 * Clear browser cache dengan meta tags
 * Untuk halaman yang memerlukan refresh cache
 */
if (!function_exists('clear_cache_meta')) {
    function clear_cache_meta()
    {
        echo '<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />' . PHP_EOL;
        echo '<meta http-equiv="Pragma" content="no-cache" />' . PHP_EOL;
        echo '<meta http-equiv="Expires" content="0" />' . PHP_EOL;
    }
}

/**
 * Get optimal cache time berdasarkan file type
 */
if (!function_exists('get_cache_time')) {
    function get_cache_time($filename)
    {
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        $cache_times = [
            // Assets statis - 1 tahun
            'css' => 31536000,
            'js' => 31536000,
            'png' => 31536000,
            'jpg' => 31536000,
            'jpeg' => 31536000,
            'gif' => 31536000,
            'ico' => 31536000,
            'svg' => 31536000,
            'woff' => 31536000,
            'woff2' => 31536000,
            'ttf' => 31536000,
            'eot' => 31536000,

            // Fonts - 1 tahun
            'otf' => 31536000,

            // Documents - 1 minggu
            'pdf' => 604800,
            'doc' => 604800,
            'docx' => 604800,
            'xls' => 604800,
            'xlsx' => 604800,
            'ppt' => 604800,
            'pptx' => 604800,

            // Audio/Video - 1 bulan
            'mp3' => 2592000,
            'mp4' => 2592000,
            'webm' => 2592000,
            'avi' => 2592000,

            // HTML - 1 jam
            'html' => 3600,
            'htm' => 3600,

            // Default - 1 jam
            'default' => 3600
        ];

        return isset($cache_times[$extension]) ? $cache_times[$extension] : $cache_times['default'];
    }
}
