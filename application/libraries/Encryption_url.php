<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Encryption URL Library
 * 
 * Library untuk mengenkripsi dan dekripsi ID di URL untuk keamanan tambahan
 * 
 * @package		Aset Academy
 * @subpackage	Libraries
 * @category	Encryption
 * @author		Aset Academy Team
 * @link		https://asetacademy.com
 */
class Encryption_url {
    
    private $encryption_key;
    private $cipher = 'AES-256-CBC';
    
    public function __construct()
    {
        $this->encryption_key = $this->get_encryption_key();
    }
    
    /**
     * Generate encryption key dari config
     * 
     * @return string
     */
    private function get_encryption_key()
    {
        $CI =& get_instance();
        $CI->config->load('encryption', TRUE);
        
        // Gunakan encryption key dari config jika tersedia
        $key = $CI->config->item('encryption_key', 'encryption');
        
        if (!$key) {
            // Jika tidak ada, gunakan key default (harus diganti di production)
            $key = 'aset-academy-2024-secure-key-for-url-encryption';
        }
        
        return hash('sha256', $key);
    }
    
    /**
     * Enkripsi ID menjadi string terenkripsi
     * 
     * @param int|string $id
     * @return string
     */
    public function encode($id)
    {
        if (empty($id)) {
            return '';
        }
        
        // Tambahkan prefix dan suffix untuk keamanan
        $plaintext = 'AS' . $id . 'ET';
        
        // Generate IV (Initialization Vector)
        $iv_length = openssl_cipher_iv_length($this->cipher);
        $iv = openssl_random_pseudo_bytes($iv_length);
        
        // Enkripsi data
        $ciphertext = openssl_encrypt($plaintext, $this->cipher, $this->encryption_key, 0, $iv);
        
        // Gabungkan IV dengan ciphertext dan encode ke base64 URL-safe
        $encrypted = rtrim(strtr(base64_encode($iv . $ciphertext), '+/', '-_'), '=');
        
        return $encrypted;
    }
    
    /**
     * Dekripsi string terenkripsi menjadi ID asli
     * 
     * @param string $encrypted_id
     * @return int|false
     */
    public function decode($encrypted_id)
    {
        if (empty($encrypted_id)) {
            return false;
        }
        
        try {
            // Kembalikan dari URL-safe base64 ke standard base64
            $encrypted = str_pad(strtr($encrypted_id, '-_', '+/'), strlen($encrypted_id) % 4, '=', STR_PAD_RIGHT);
            
            // Decode dari base64
            $decoded = base64_decode($encrypted);
            
            if ($decoded === false) {
                return false;
            }
            
            // Pisahkan IV dan ciphertext
            $iv_length = openssl_cipher_iv_length($this->cipher);
            if (strlen($decoded) <= $iv_length) {
                return false;
            }
            
            $iv = substr($decoded, 0, $iv_length);
            $ciphertext = substr($decoded, $iv_length);
            
            // Dekripsi data
            $plaintext = openssl_decrypt($ciphertext, $this->cipher, $this->encryption_key, 0, $iv);
            
            if ($plaintext === false) {
                return false;
            }
            
            // Validasi format dan ambil ID
            if (preg_match('/^AS(\d+)ET$/', $plaintext, $matches)) {
                return (int)$matches[1];
            }
            
            return false;
            
        } catch (Exception $e) {
            log_message('error', 'Encryption URL decode error: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Validasi apakah string terenkripsi valid
     * 
     * @param string $encrypted_id
     * @return bool
     */
    public function is_valid($encrypted_id)
    {
        return $this->decode($encrypted_id) !== false;
    }
    
    /**
     * Generate URL dengan ID terenkripsi
     * 
     * @param string $base_url
     * @param int|string $id
     * @return string
     */
    public function generate_url($base_url, $id)
    {
        $encrypted_id = $this->encode($id);
        return rtrim($base_url, '/') . '/' . $encrypted_id;
    }
    
    /**
     * Helper untuk generate URL workshop detail
     * 
     * @param int $workshop_id
     * @return string
     */
    public function workshop_detail_url($workshop_id)
    {
        return $this->generate_url(site_url('workshops/detail'), $workshop_id);
    }
    
    /**
     * Helper untuk generate URL workshop register
     * 
     * @param int $workshop_id
     * @return string
     */
    public function workshop_register_url($workshop_id)
    {
        return $this->generate_url(site_url('workshops/register'), $workshop_id);
    }
    
    /**
     * Helper untuk generate URL workshop guest register
     * 
     * @param int $workshop_id
     * @return string
     */
    public function workshop_register_guest_url($workshop_id)
    {
        return $this->generate_url(site_url('workshops/register_guest'), $workshop_id);
    }
    
    /**
     * Helper untuk generate URL guest success
     * 
     * @param int $guest_id
     * @return string
     */
    public function workshop_guest_success_url($guest_id)
    {
        return $this->generate_url(site_url('workshops/guest_success'), $guest_id);
    }
}
