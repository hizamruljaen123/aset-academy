<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Base Controller with Encryption Support
 * 
 * Base controller yang menyediakan method untuk handle ID terenkripsi
 * secara universal di semua controller
 */
class MY_Controller extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('encryption_url');
    }
    
    /**
     * Decrypt ID from URL parameter
     * 
     * @param string $encrypted_id
     * @param string $param_name
     * @return int|false
     */
    protected function decrypt_id($encrypted_id, $param_name = 'ID')
    {
        if (empty($encrypted_id)) {
            show_404();
        }
        
        $id = $this->encryption_url->decode($encrypted_id);
        if ($id === false) {
            log_message('error', "Invalid encrypted {$param_name}: {$encrypted_id}");
            show_404();
        }
        
        return $id;
    }
    
    /**
     * Encrypt ID for URL
     * 
     * @param int $id
     * @return string
     */
    protected function encrypt_id($id)
    {
        return $this->encryption_url->encode($id);
    }
    
    /**
     * Generate encrypted URL
     * 
     * @param string $base_url
     * @param int $id
     * @return string
     */
    protected function generate_encrypted_url($base_url, $id)
    {
        return $this->encryption_url->generate_url($base_url, $id);
    }
    
    /**
     * Redirect with encrypted ID
     * 
     * @param string $url
     * @param int $id
     */
    protected function redirect_encrypted($url, $id)
    {
        $encrypted_url = $this->generate_encrypted_url($url, $id);
        redirect($encrypted_url);
    }
    
    /**
     * Validate encrypted ID
     * 
     * @param string $encrypted_id
     * @return bool
     */
    protected function is_valid_encrypted_id($encrypted_id)
    {
        return $this->encryption_url->is_valid($encrypted_id);
    }
}
