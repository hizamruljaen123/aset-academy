<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission {
    
    protected $CI;
    
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('Auth_model');
    }
    
    // Check if current user has permission
    public function check($module, $action)
    {
        if (!$this->CI->session->userdata('logged_in')) {
            return false;
        }
        
        $role = $this->CI->session->userdata('role');
        $level = $this->CI->session->userdata('level');
        $permissions = $this->CI->session->userdata('permissions');
        
        // Check from session permissions first (faster)
        if (isset($permissions[$module][$action])) {
            return $permissions[$module][$action];
        }
        
        // Fallback to database check
        return $this->CI->Auth_model->has_permission($role, $level, $module, $action);
    }
    
    // Require permission or show error
    public function require_permission($module, $action, $redirect_url = null)
    {
        if (!$this->check($module, $action)) {
            if ($redirect_url) {
                redirect($redirect_url);
            } else {
                show_error('Access denied. You do not have permission to perform this action.', 403);
            }
        }
    }
    
    // Check if user has minimum level
    public function check_level($required_level)
    {
        if (!$this->CI->session->userdata('logged_in')) {
            return false;
        }
        
        $user_level = (int)$this->CI->session->userdata('level');
        return $user_level <= (int)$required_level;
    }
    
    // Get user role
    public function get_role()
    {
        return $this->CI->session->userdata('role');
    }
    
    // Get user level
    public function get_level()
    {
        return $this->CI->session->userdata('level');
    }
    
    // Check if user is super admin
    public function is_super_admin()
    {
        return $this->get_role() === 'super_admin' && $this->get_level() === '1';
    }
    
    // Check if user is admin (any level)
    public function is_admin()
    {
        $role = $this->get_role();
        return in_array($role, ['super_admin', 'admin']);
    }
    
    // Check if user is teacher
    public function is_teacher()
    {
        return $this->get_role() === 'guru';
    }
    
    // Check if user is student
    public function is_student()
    {
        return $this->get_role() === 'siswa';
    }
}
