<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materi_part_model extends CI_Model {

    public function get_parts_by_materi_id($materi_id)
    {
        $this->db->where('materi_id', $materi_id);
        $this->db->order_by('part_order', 'ASC');
        $query = $this->db->get('materi_parts');
        return $query->result();
    }

    public function insert_part($data)
    {
        return $this->db->insert('materi_parts', $data);
    }

    public function get_part_by_id($id)
    {
        $query = $this->db->get_where('materi_parts', ['id' => $id]);
        return $query->row();
    }

    public function update_part($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('materi_parts', $data);
    }

    public function delete_part($id)
    {
        return $this->db->delete('materi_parts', ['id' => $id]);
    }

    public function get_last_part_order($materi_id)
    {
        $this->db->select_max('part_order');
        $this->db->where('materi_id', $materi_id);
        $query = $this->db->get('materi_parts');
        $row = $query->row();
        return ($row->part_order) ? $row->part_order : 0;
    }
}
