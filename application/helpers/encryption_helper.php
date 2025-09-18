<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Encryption Helper
 * Helper functions untuk URL encryption
 */

if (!function_exists('encrypt_url_id')) {
    /**
     * Enkripsi ID untuk URL
     * 
     * @param int|string $id
     * @return string
     */
    function encrypt_url_id($id)
    {
        $CI =& get_instance();
        $CI->load->library('encryption_url');
        return $CI->encryption_url->encode($id);
    }
}

if (!function_exists('decrypt_url_id')) {
    /**
     * Dekripsi ID dari URL
     * 
     * @param string $encrypted_id
     * @return int|false
     */
    function decrypt_url_id($encrypted_id)
    {
        $CI =& get_instance();
        $CI->load->library('encryption_url');
        return $CI->encryption_url->decode($encrypted_id);
    }
}

if (!function_exists('workshop_detail_url')) {
    /**
     * Generate URL workshop detail dengan ID terenkripsi
     * 
     * @param int $workshop_id
     * @return string
     */
    function workshop_detail_url($workshop_id)
    {
        $CI =& get_instance();
        $CI->load->library('encryption_url');
        return $CI->encryption_url->workshop_detail_url($workshop_id);
    }
}

if (!function_exists('workshop_register_url')) {
    /**
     * Generate URL workshop register dengan ID terenkripsi
     * 
     * @param int $workshop_id
     * @return string
     */
    function workshop_register_url($workshop_id)
    {
        $CI =& get_instance();
        $CI->load->library('encryption_url');
        return $CI->encryption_url->workshop_register_url($workshop_id);
    }
}

if (!function_exists('workshop_register_guest_url')) {
    /**
     * Generate URL workshop guest register dengan ID terenkripsi
     * 
     * @param int $workshop_id
     * @return string
     */
    function workshop_register_guest_url($workshop_id)
    {
        $CI =& get_instance();
        $CI->load->library('encryption_url');
        return $CI->encryption_url->workshop_register_guest_url($workshop_id);
    }
}

if (!function_exists('workshop_guest_success_url')) {
    /**
     * Generate URL guest success dengan ID terenkripsi
     * 
     * @param int $guest_id
     * @return string
     */
    function workshop_guest_success_url($guest_id)
    {
        $CI =& get_instance();
        $CI->load->library('encryption_url');
        return $CI->encryption_url->workshop_guest_success_url($guest_id);
    }
}
