<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_model extends CI_Model {

    // Konstruktor untuk memuat library database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Fungsi untuk mendapatkan semua data kelas
    public function get_all_kelas()
    {
        $this->db->select('*');
        $this->db->from('kelas_programming');
        $this->db->where('status', 'Aktif');
        $this->db->order_by('level', 'ASC');
        $this->db->order_by('nama_kelas', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Fungsi untuk mendapatkan data kelas berdasarkan ID
    public function get_kelas_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('kelas_programming');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    // Fungsi untuk mendapatkan data kelas berdasarkan nama kelas
    public function get_kelas_by_nama($nama_kelas)
    {
        $this->db->select('*');
        $this->db->from('kelas_programming');
        $this->db->where('nama_kelas', $nama_kelas);
        $query = $this->db->get();
        return $query->row();
    }

    // Fungsi untuk mendapatkan data kelas berdasarkan level
    public function get_kelas_by_level($level)
    {
        $this->db->select('*');
        $this->db->from('kelas_programming');
        $this->db->where('level', $level);
        $this->db->where('status', 'Aktif');
        $this->db->order_by('nama_kelas', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Fungsi untuk mendapatkan data kelas berdasarkan bahasa program
    public function get_kelas_by_bahasa($bahasa)
    {
        $this->db->select('*');
        $this->db->from('kelas_programming');
        $this->db->where('bahasa_program', $bahasa);
        $this->db->where('status', 'Aktif');
        $this->db->order_by('nama_kelas', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Fungsi untuk menambah data kelas
    public function insert_kelas($data)
    {
        $this->db->insert('kelas_programming', $data);
        return $this->db->insert_id();
    }

    // Fungsi untuk mengupdate data kelas
    public function update_kelas($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('kelas_programming', $data);
        return $this->db->affected_rows();
    }

    // Fungsi untuk menghapus data kelas
    public function delete_kelas($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('kelas_programming');
        return $this->db->affected_rows();
    }

    // Fungsi untuk mendapatkan jumlah total kelas
    public function count_kelas()
    {
        return $this->db->count_all('kelas_programming');
    }

    // Fungsi untuk mendapatkan jumlah kelas berdasarkan status
    public function count_kelas_by_status($status)
    {
        $this->db->from('kelas_programming');
        $this->db->where('status', $status);
        return $this->db->count_all_results();
    }

    // Fungsi untuk mendapatkan jumlah kelas berdasarkan level
    public function count_kelas_by_level($level)
    {
        $this->db->from('kelas_programming');
        $this->db->where('level', $level);
        return $this->db->count_all_results();
    }

    // Fungsi untuk cek nama kelas sudah ada atau belum
    public function is_kelas_exists($nama_kelas, $id = null)
    {
        $this->db->from('kelas_programming');
        $this->db->where('nama_kelas', $nama_kelas);
        if ($id) {
            $this->db->where('id !=', $id);
        }
        return $this->db->count_all_results() > 0;
    }

    // Fungsi untuk mendapatkan kelas yang paling populer
    public function get_popular_kelas()
    {
        $this->db->select('k.nama_kelas, COUNT(s.id) as jumlah_siswa');
        $this->db->from('kelas_programming k');
        $this->db->join('siswa s', 'k.nama_kelas = s.kelas', 'left');
        $this->db->where('k.status', 'Aktif');
        $this->db->group_by('k.id');
        $this->db->order_by('jumlah_siswa', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result();
    }

    // Fungsi untuk mendapatkan statistik kelas
    public function get_kelas_statistics()
    {
        $this->db->select('level, COUNT(*) as jumlah');
        $this->db->from('kelas_programming');
        $this->db->where('status', 'Aktif');
        $this->db->group_by('level');
        $query = $this->db->get();
        return $query->result();
    }
}
?>