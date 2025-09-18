<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * URL Security Helper
 * Helper functions untuk URL encryption di seluruh aplikasi
 */

if (!function_exists('encrypt_url')) {
    /**
     * Encrypt ID untuk URL
     * 
     * @param int|string $id
     * @return string
     */
    function encrypt_url($id)
    {
        $CI =& get_instance();
        $CI->load->library('encryption_url');
        return $CI->encryption_url->encode($id);
    }
}

if (!function_exists('decrypt_url')) {
    /**
     * Decrypt ID dari URL
     * 
     * @param string $encrypted_id
     * @return int|false
     */
    function decrypt_url($encrypted_id)
    {
        $CI =& get_instance();
        $CI->load->library('encryption_url');
        return $CI->encryption_url->decode($encrypted_id);
    }
}

if (!function_exists('e_url')) {
    /**
     * Shortcut untuk encrypt_url
     * 
     * @param int|string $id
     * @return string
     */
    function e_url($id)
    {
        return encrypt_url($id);
    }
}

if (!function_exists('d_url')) {
    /**
     * Shortcut untuk decrypt_url
     * 
     * @param string $encrypted_id
     * @return int|false
     */
    function d_url($encrypted_id)
    {
        return decrypt_url($encrypted_id);
    }
}

if (!function_exists('secure_url')) {
    /**
     * Generate secure URL dengan ID terenkripsi
     * 
     * @param string $base_url
     * @param int|string $id
     * @return string
     */
    function secure_url($base_url, $id)
    {
        $CI =& get_instance();
        $CI->load->library('encryption_url');
        return $CI->encryption_url->generate_url($base_url, $id);
    }
}

if (!function_exists('premium_class_url')) {
    /**
     * Generate premium class URL dengan ID terenkripsi
     * 
     * @param int $class_id
     * @return string
     */
    function premium_class_url($class_id)
    {
        return site_url('home/premium_class_view/' . encrypt_url($class_id));
    }
}

if (!function_exists('free_class_url')) {
    /**
     * Generate free class URL dengan ID terenkripsi
     * 
     * @param int $class_id
     * @return string
     */
    function free_class_url($class_id)
    {
        return site_url('home/view_free_class/' . encrypt_url($class_id));
    }
}

if (!function_exists('admin_workshop_url')) {
    /**
     * Generate admin workshop URL dengan ID terenkripsi
     * 
     * @param int $workshop_id
     * @return string
     */
    function admin_workshop_url($workshop_id)
    {
        return site_url('admin/workshops/edit/' . encrypt_url($workshop_id));
    }
}

if (!function_exists('admin_workshop_materials_url')) {
    /**
     * Generate admin workshop materials URL dengan ID terenkripsi
     * 
     * @param int $workshop_id
     * @return string
     */
    function admin_workshop_materials_url($workshop_id)
    {
        return site_url('admin/workshops/manage_materials/' . encrypt_url($workshop_id));
    }
}

if (!function_exists('admin_workshop_participants_url')) {
    /**
     * Generate admin workshop participants URL dengan ID terenkripsi
     * 
     * @param int $workshop_id
     * @return string
     */
    function admin_workshop_participants_url($workshop_id)
    {
        return site_url('admin/workshops/participants/' . encrypt_url($workshop_id));
    }
}

if (!function_exists('secure_redirect')) {
    /**
     * Redirect dengan ID terenkripsi
     * 
     * @param string $url
     * @param int|string $id
     */
    function secure_redirect($url, $id)
    {
        redirect(secure_url($url, $id));
    }
}
