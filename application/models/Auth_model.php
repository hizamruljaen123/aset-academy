<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Enhanced login with level-based authentication
    public function authenticate($username, $password)
    {
        $this->db->select('u.*, up.module, up.action, up.allowed');
        $this->db->from('users u');
        $this->db->join('user_permissions up', 'u.role = up.role AND u.level = up.level', 'left');
        $this->db->where('u.username', $username);
        $this->db->where('u.status', 'Aktif');
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $users = $query->result();
            $user = $users[0]; // Get first row for user data
            
            // Check password - support both BCRYPT and MD5 for migration
            $password_valid = false;
            if (password_verify($password, $user->password)) {
                $password_valid = true;
            } elseif (md5($password) == $user->password) {
                // If MD5 matches, update to BCRYPT hash
                $this->update_password_to_bcrypt($user->id, $password);
                $password_valid = true;
            }
            
            if ($password_valid) {
                // Build permissions array
                $permissions = [];
                foreach ($users as $perm) {
                    if ($perm->module && $perm->action) {
                        $permissions[$perm->module][$perm->action] = (bool)$perm->allowed;
                    }
                }
                
                // Update last login
                $this->update_last_login($user->id);
                
                // Return user data with permissions
                $user_data = (object)[
                    'id' => $user->id,
                    'username' => $user->username,
                    'nama_lengkap' => $user->nama_lengkap,
                    'email' => $user->email,
                    'role' => $user->role,
                    'level' => $user->level,
                    'department' => $user->department,
                    'status' => $user->status,
                    'permissions' => $permissions
                ];
                
                return $user_data;
            }
        }
        return false;
    }

    // Check if user has permission for specific action
    public function has_permission($role, $level, $module, $action)
    {
        $this->db->select('allowed');
        $this->db->from('user_permissions');
        $this->db->where('role', $role);
        $this->db->where('level', $level);
        $this->db->where('module', $module);
        $this->db->where('action', $action);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return (bool)$query->row()->allowed;
        }
        return false;
    }

    // Get user permissions
    public function get_user_permissions($role, $level)
    {
        $this->db->select('module, action, allowed');
        $this->db->from('user_permissions');
        $this->db->where('role', $role);
        $this->db->where('level', $level);
        $this->db->where('allowed', 1);
        $query = $this->db->get();
        
        $permissions = [];
        foreach ($query->result() as $perm) {
            $permissions[$perm->module][$perm->action] = true;
        }
        
        return $permissions;
    }

    // Update last login timestamp
    public function update_last_login($user_id)
    {
        $this->db->set('last_login', 'CURRENT_TIMESTAMP', FALSE);
        $this->db->where('id', $user_id);
        $this->db->update('users');
    }

    // Get redirect URL based on role and level
    public function get_redirect_url($role, $level, $is_logout = false)
    {
        // Special case for logout
        if ($is_logout) {
            return 'auth';
        }
        
        switch ($role) {
            case 'super_admin':
                return 'dashboard';
            case 'admin':
                return 'dashboard';
            case 'guru':
                return 'teacher';
            case 'siswa':
                return 'student';
            default:
                return 'dashboard';
        }
    }

    // Validate user level access
    public function validate_level_access($required_level, $user_level)
    {
        // Lower number = higher access level
        return (int)$user_level <= (int)$required_level;
    }

    // Login mobile
    public function login_mobile($username, $password)
    {
        // Cari user berdasarkan username atau NIS (dengan asumsi siswa.id = users.id)
        $query = $this->db->query("SELECT u.* FROM users u LEFT JOIN siswa s ON u.id = s.id WHERE u.username = ? OR s.nis = ?", array($username, $username));
        $user = $query->row();
        
        // Check password - support both BCRYPT and MD5 for migration
        $password_valid = false;
        if ($user && password_verify($password, $user->password)) {
            $password_valid = true;
        } elseif ($user && md5($password) == $user->password) {
            // If MD5 matches, update to BCRYPT hash
            $this->update_password_to_bcrypt($user->id, $password);
            $password_valid = true;
        }
        
        if ($password_valid) {
            return $user;
        }
        
        return false;
    }

    // Update MD5 password to BCRYPT hash
    private function update_password_to_bcrypt($user_id, $plain_password)
    {
        $hashed_password = password_hash($plain_password, PASSWORD_BCRYPT);
        $this->db->set('password', $hashed_password);
        $this->db->where('id', $user_id);
        $this->db->update('users');
    }
}
