<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workshop_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    // Create a new workshop
    public function create_workshop($data)
    {
        $this->db->insert('workshops', $data);
        return $this->db->insert_id();
    }

    // Update a workshop
    public function update_workshop($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('workshops', $data);
    }

    // Delete a workshop
    public function delete_workshop($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('workshops');
    }

    // Get all workshops
    public function get_all_workshops($limit = null, $offset = null)
    {
        if ($limit !== null) {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('start_datetime', 'ASC');
        return $this->db->get('workshops')->result();
    }

    // Get workshop by ID
    public function get_workshop($id)
    {
        return $this->db->get_where('workshops', ['id' => $id])->row();
    }

    // Get workshop by slug
    public function get_workshop_by_slug($slug)
    {
        return $this->db->get_where('workshops', ['slug' => $slug])->row();
    }

    // Get upcoming workshops
    public function get_upcoming_workshops($limit = 3)
    {
        $this->db->where('start_datetime >', date('Y-m-d H:i:s'));
        $this->db->where('status', 'published');
        $this->db->order_by('start_datetime', 'ASC');
        $this->db->limit($limit);
        return $this->db->get('workshops')->result();
    }

    // Add material to workshop
    public function add_material($workshop_id, $data)
    {
        $data['workshop_id'] = $workshop_id;
        $this->db->insert('workshop_materials', $data);
        return $this->db->insert_id();
    }

    // Get workshop materials
    public function get_materials($workshop_id)
    {
        return $this->db->get_where('workshop_materials', ['workshop_id' => $workshop_id])->result();
    }

    // Register participant
    public function register_participant($workshop_id, $user_id = null, $external_data = null)
    {
        $data = [
            'workshop_id' => $workshop_id,
            'registered_at' => date('Y-m-d H:i:s')
        ];

        if ($user_id) {
            $user = $this->db->get_where('users', ['id' => $user_id])->row();
            $data['user_id'] = $user_id;
            $data['role'] = in_array($user->role, ['student', 'teacher']) ? $user->role : 'external';
        } else {
            $data['external_name'] = $external_data['name'];
            $data['external_email'] = $external_data['email'];
            $data['role'] = 'external';
        }

        $this->db->insert('workshop_participants', $data);
        return $this->db->insert_id();
    }

    // Get workshop participants
    public function get_participants($workshop_id)
    {
        $this->db->select('wp.*, u.nama_lengkap, u.email, u.role as user_role');
        $this->db->from('workshop_participants wp');
        $this->db->join('users u', 'u.id = wp.user_id', 'left');
        $this->db->where('wp.workshop_id', $workshop_id);
        return $this->db->get()->result();
    }

    // Get workshops by user
    public function get_user_workshops($user_id)
    {
        $this->db->select('w.*, wp.registered_at, wp.status as participation_status');
        $this->db->from('workshop_participants wp');
        $this->db->join('workshops w', 'w.id = wp.workshop_id');
        $this->db->where('wp.user_id', $user_id);
        return $this->db->get()->result();
    }

    // Check if user is registered for workshop
    public function is_user_registered($workshop_id, $user_id)
    {
        return $this->db->get_where('workshop_participants', [
            'workshop_id' => $workshop_id,
            'user_id' => $user_id
        ])->row();
    }
}
