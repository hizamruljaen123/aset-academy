<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Session Tracker Hook
 * Automatically tracks user sessions and updates activity
 */
class Session_tracker {
    
    protected $CI;
    
    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('session');
        $this->CI->load->model('Session_model');
    }
    
    /**
     * Track user session after controller loaded
     * This runs on every page load for logged in users
     */
    public function track_session() {
        // Check if user is logged in
        if ($this->CI->session->userdata('logged_in') && $this->CI->session->userdata('user_id')) {
            $session_id = $this->CI->session->userdata('session_id');
            $user_id = $this->CI->session->userdata('user_id');
            
            // If session_id is not in userdata, get it from session library
            if (empty($session_id)) {
                $session_id = session_id();
                $this->CI->session->set_userdata('session_id', $session_id);
            }
            
            // Check if this session is already tracked
            $is_tracked = $this->CI->session->userdata('session_tracked');
            
            if (!$is_tracked) {
                // First time tracking this session - create tracking record
                $ip_address = $this->CI->input->ip_address();
                $user_agent = $this->CI->input->user_agent();
                
                $this->CI->Session_model->track_user_session(
                    $session_id,
                    $user_id,
                    $ip_address,
                    $user_agent
                );
                
                // Mark as tracked
                $this->CI->session->set_userdata('session_tracked', true);
                
                // Log activity
                log_message('info', "Session tracked for user ID: {$user_id}, Session ID: {$session_id}");
            } else {
                // Update last activity time
                $this->CI->Session_model->update_session_activity($session_id);
            }
        }
    }
    
    /**
     * Log session when user logs out
     * Call this from Auth controller logout method
     */
    public function log_logout() {
        if ($this->CI->session->userdata('logged_in') && $this->CI->session->userdata('user_id')) {
            $session_id = $this->CI->session->userdata('session_id');
            
            if (!empty($session_id)) {
                $this->CI->Session_model->log_session_logout($session_id, 'manual');
                log_message('info', "User logged out, Session ID: {$session_id}");
            }
        }
    }
}

