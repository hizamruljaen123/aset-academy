<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function count_all()
    {
        return $this->db->count_all('users');
    }

    public function get_all_users()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->order_by('nama_lengkap', 'ASC');
        return $this->db->get()->result();
    }

    public function get_user_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('users')->row();
    }
    
    public function get_user_by_username($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('users')->row();
    }
    
    public function get_user_by_email($email)
    {
        $this->db->where('email', $email);
        return $this->db->get('users')->row();
    }
    
    public function update_user($user_id, $data)
    {
        $this->db->where('id', $user_id);
        return $this->db->update('users', $data);
    }
    
    public function update_password($user_id, $new_password)
    {
        $this->db->where('id', $user_id);
        return $this->db->update('users', ['password' => md5($new_password)]);
    }
    
    public function verify_password($user_id, $password)
    {
        $this->db->where('id', $user_id);
        $this->db->where('password', md5($password));
        $query = $this->db->get('users');
        return ($query->num_rows() > 0);
    }
    
    public function get_user_with_role_info($user_id)
    {
        $this->db->select('users.*, user_permissions.module, user_permissions.action, user_permissions.allowed');
        $this->db->from('users');
        $this->db->join('user_permissions', 'users.role = user_permissions.role AND users.level = user_permissions.level', 'left');
        $this->db->where('users.id', $user_id);
        return $this->db->get()->result();
    }
    
    public function get_user_permissions($role, $level)
    {
        $this->db->select('module, action, allowed');
        $this->db->from('user_permissions');
        $this->db->where('role', $role);
        $this->db->where('level', $level);
        $query = $this->db->get();
        
        $permissions = [];
        foreach ($query->result() as $row) {
            $permissions[$row->module][$row->action] = (bool)$row->allowed;
        }
        
        return $permissions;
    }
}
