<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_jadwal_by_kelas($kelas_id)
    {
        $this->db->where('kelas_id', $kelas_id);
        $this->db->order_by('tanggal_pertemuan', 'ASC');
        $this->db->order_by('waktu_mulai', 'ASC');
        return $this->db->get('jadwal_kelas')->result();
    }

    public function get_jadwal_by_id($id)
    {
        return $this->db->get_where('jadwal_kelas', ['id' => $id])->row();
    }

    public function insert_jadwal($data)
    {
        $this->db->insert('jadwal_kelas', $data);
        return $this->db->insert_id();
    }

    public function update_jadwal($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('jadwal_kelas', $data);
    }

    public function delete_jadwal($id)
    {
        return $this->db->delete('jadwal_kelas', ['id' => $id]);
    }

    public function get_jadwal_by_guru($guru_id)
    {
        $this->db->where('guru_id', $guru_id);
        $this->db->order_by('tanggal_pertemuan', 'DESC');
        return $this->db->get('jadwal_kelas')->result();
    }

    public function get_upcoming_jadwal($limit = 10)
    {
        $this->db->where('tanggal_pertemuan >=', date('Y-m-d'));
        $this->db->order_by('tanggal_pertemuan', 'ASC');
        $this->db->order_by('waktu_mulai', 'ASC');
        $this->db->limit($limit);
        return $this->db->get('jadwal_kelas')->result();
    }

    public function count_jadwal_by_kelas($kelas_id)
    {
        $this->db->where('kelas_id', $kelas_id);
        return $this->db->count_all_results('jadwal_kelas');
    }

    public function get_all_jadwal()
    {
        $this->db->select('jadwal_kelas.*, kelas_programming.nama_kelas, users.nama_lengkap as nama_guru');
        $this->db->from('jadwal_kelas');
        $this->db->join('kelas_programming', 'kelas_programming.id = jadwal_kelas.kelas_id', 'left');
        $this->db->join('users', 'users.id = jadwal_kelas.guru_id', 'left');
        $this->db->order_by('jadwal_kelas.tanggal_pertemuan', 'DESC');
        $this->db->order_by('jadwal_kelas.waktu_mulai', 'ASC');
        return $this->db->get()->result();
    }

}

/* End of file Jadwal_model.php */
