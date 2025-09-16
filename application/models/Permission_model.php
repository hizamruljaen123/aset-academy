<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Permission_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_permissions()
    {
        $this->db->select('*');
        $this->db->from('user_permissions');
        $this->db->order_by('role, level, module, action', 'ASC');
        return $this->db->get()->result();
    }

    public function get_permission_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('user_permissions')->row();
    }

    public function create_permission($data)
    {
        return $this->db->insert('user_permissions', $data);
    }

    public function delete_permission($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('user_permissions');
    }

    public function toggle_permission($id)
    {
        $permission = $this->get_permission_by_id($id);
        if ($permission) {
            $new_status = $permission->allowed ? 0 : 1;
            return $this->update_permission($id, ['allowed' => $new_status]);
        }
        return false;
    }

    public function update_permission($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('user_permissions', $data);
    }

    public function reset_to_defaults()
    {
        // Default permissions logic here
    }
}
