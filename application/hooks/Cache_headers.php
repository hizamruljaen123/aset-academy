<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Cache Headers Hook
 *
 * Menambahkan expires headers dan cache control untuk optimasi performa
 * Mengikuti best practices dari Google PageSpeed dan YSlow
 */
class Cache_headers {

    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    /**
     * Set cache headers berdasarkan file type
     * Dipanggil di post_controller_constructor
     */
    public function set_cache_headers()
    {
        // Skip untuk AJAX requests
        if ($this->ci->input->is_ajax_request()) {
            return;
        }

        // Skip untuk admin area (untuk menghindari cache issues)
        if ($this->ci->uri->segment(1) === 'admin' ||
            $this->ci->uri->segment(1) === 'teacher' ||
            strpos($this->ci->uri->uri_string(), 'auth') !== false) {
            return;
        }

        // Get current URI
        $uri = $this->ci->uri->uri_string();

        // Set cache headers berdasarkan file type
        if (preg_match('/\.(css|js|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot)(\?.*)?$/i', $uri)) {
            $this->set_asset_cache_headers();
        } elseif (preg_match('/\.(pdf|doc|docx|xls|xlsx|ppt|pptx)(\?.*)?$/i', $uri)) {
            $this->set_document_cache_headers();
        } else {
            $this->set_html_cache_headers();
        }
    }

    /**
     * Cache headers untuk assets (CSS, JS, Images, Fonts)
     * Cache selama 1 tahun untuk assets dengan version/hash
     */
    protected function set_asset_cache_headers()
    {
        $expires = gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT'; // 1 tahun

        $this->ci->output
            ->set_header('Cache-Control: public, max-age=31536000')
            ->set_header('Expires: ' . $expires)
            ->set_header('Pragma: cache');
    }

    /**
     * Cache headers untuk dokumen (PDF, Word, Excel, dll)
     * Cache selama 1 minggu
     */
    protected function set_document_cache_headers()
    {
        $expires = gmdate('D, d M Y H:i:s', time() + 604800) . ' GMT'; // 1 minggu

        $this->ci->output
            ->set_header('Cache-Control: public, max-age=604800')
            ->set_header('Expires: ' . $expires)
            ->set_header('Pragma: cache');
    }

    /**
     * Cache headers untuk halaman HTML
     * Cache selama 1 jam untuk performa, tapi tetap fresh
     */
    protected function set_html_cache_headers()
    {
        $expires = gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT'; // 1 jam

        $this->ci->output
            ->set_header('Cache-Control: public, max-age=3600')
            ->set_header('Expires: ' . $expires)
            ->set_header('Pragma: cache');
    }

    /**
     * Force no-cache untuk halaman dinamis tertentu
     */
    public function force_no_cache()
    {
        $this->ci->output
            ->set_header('Cache-Control: no-cache, no-store, must-revalidate')
            ->set_header('Expires: 0')
            ->set_header('Pragma: no-cache');
    }
}
