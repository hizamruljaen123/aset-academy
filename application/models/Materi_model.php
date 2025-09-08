<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Materi_model extends CI_Model {

    public function get_materi_by_kelas($kelas_id)
    {
        $this->db->where('kelas_id', $kelas_id);
        return $this->db->get('materi')->result();
    }

    public function get_materi_by_id($id)
    {
        return $this->db->get_where('materi', ['id' => $id])->row();
    }

    public function insert_materi($data)
    {
        $this->db->insert('materi', $data);
        return $this->db->insert_id();
    }

    public function update_materi($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('materi', $data);
    }

    public function delete_materi($id)
    {
        return $this->db->delete('materi', ['id' => $id]);
    }

    public function insert_materi_part($data)
    {
        return $this->db->insert('materi_parts', $data);
    }

    public function get_materi_with_parts_by_kelas($kelas_id)
    {
        $this->db->select('m.*, mp.id as part_id, mp.part_order, mp.part_type, mp.part_title, mp.part_content');
        $this->db->from('materi m');
        $this->db->join('materi_parts mp', 'm.id = mp.materi_id', 'left');
        $this->db->where('m.kelas_id', $kelas_id);
        $this->db->order_by('m.id, mp.part_order', 'ASC');
        $query = $this->db->get();

        $result = [];
        foreach ($query->result() as $row) {
            if (!isset($result[$row->id])) {
                $result[$row->id] = [
                    'id' => $row->id,
                    'kelas_id' => $row->kelas_id,
                    'judul' => $row->judul,
                    'deskripsi' => $row->deskripsi,
                    'created_at' => $row->created_at,
                    'updated_at' => $row->updated_at,
                    'parts' => []
                ];
            }

            if ($row->part_id) {
                $result[$row->id]['parts'][] = [
                    'id' => $row->part_id,
                    'part_order' => $row->part_order,
                    'part_type' => $row->part_type,
                    'part_title' => $row->part_title,
                    'part_content' => $row->part_content
                ];
            }
        }
        return array_values($result);
    }

}

/* End of file Materi_model.php */
