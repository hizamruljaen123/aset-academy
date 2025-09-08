<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_model extends CI_Model {

    public function get_all_jadwal()
    {
        $this->db->select('j.*, k.nama_kelas, u.nama_lengkap as nama_guru');
        $this->db->from('jadwal_kelas j');
        $this->db->join('kelas_programming k', 'j.kelas_id = k.id AND j.class_type = \'programming\'', 'left');
        $this->db->join('users u', 'j.guru_id = u.id', 'left');
        $this->db->order_by('j.tanggal_pertemuan', 'DESC');
        return $this->db->get()->result_array();
    }

    public function insert_jadwal($data)
    {
        return $this->db->insert('jadwal_kelas', $data);
    }

    public function get_jadwal_by_kelas($kelas_id, $class_type = 'programming')
    {
        $this->db->where('kelas_id', $kelas_id);
        $this->db->where('class_type', $class_type);
        $this->db->order_by('pertemuan_ke', 'ASC');
        return $this->db->get('jadwal_kelas')->result_array();
    }

    public function get_jadwal_by_id($id)
    {
        return $this->db->get_where('jadwal_kelas', ['id' => $id])->row_array();
    }
}
