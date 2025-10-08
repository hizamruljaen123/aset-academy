<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends CI_Model
{
    protected $table = 'contact_messages';

    public function create(array $data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_all($limit = 100, $offset = 0, $filters = [])
    {
        if (!empty($filters['status'])) {
            $this->db->where('status', $filters['status']);
        }

        if (!empty($filters['message_type'])) {
            $this->db->where('message_type', $filters['message_type']);
        }

        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get($this->table, $limit, $offset);
        return $query->result();
    }

    public function count_all($filters = [])
    {
        if (!empty($filters['status'])) {
            $this->db->where('status', $filters['status']);
        }

        if (!empty($filters['message_type'])) {
            $this->db->where('message_type', $filters['message_type']);
        }

        return $this->db->count_all_results($this->table);
    }

    public function get($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function update($id, array $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }
}
