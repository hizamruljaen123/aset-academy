<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Class_category_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all($class_type = null, $only_active = false)
    {
        if ($class_type) {
            $this->db->where('class_type', $class_type);
        }

        if ($only_active) {
            $this->db->where('is_active', 1);
        }

        $this->db->order_by('name', 'ASC');
        return $this->db->get('class_categories')->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('class_categories', ['id' => $id])->row();
    }

    public function create($data)
    {
        $this->db->insert('class_categories', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('class_categories', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('class_categories');
    }

    public function is_name_exists($name, $exclude_id = null)
    {
        $this->db->where('LOWER(name)', strtolower($name));
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        return $this->db->count_all_results('class_categories') > 0;
    }

    public function is_slug_exists($slug, $exclude_id = null)
    {
        $this->db->where('slug', $slug);
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        return $this->db->count_all_results('class_categories') > 0;
    }
}
