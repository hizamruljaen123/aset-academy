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
    // Fungsi untuk mendapatkan kelas yang paling populer
    public function get_popular_kelas($limit = 5)
    {
        $this->db->select('k.*, COUNT(s.id) as jumlah_siswa');
        $this->db->from('kelas_programming k');
        $this->db->join('siswa s', 'k.nama_kelas = s.kelas', 'left');
        $this->db->where('k.status', 'Aktif');
        $this->db->group_by('k.id');
        $this->db->order_by('jumlah_siswa', 'DESC');
        $this->db->limit($limit);
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

    // Fungsi untuk mendapatkan progress siswa berdasarkan kelas
    public function get_student_progress($kelas_id)
    {
        // First check if materi_progress table exists
        $table_exists = $this->db->query("SHOW TABLES LIKE 'materi_progress'")->num_rows() > 0;
        
        $this->db->select('s.id, s.nama_lengkap, s.nis, COUNT(m.id) as total_materi');
        $this->db->from('siswa s');
        $this->db->join('materi m', 'm.kelas_id = '.$kelas_id);
        $this->db->where('s.kelas', (string)$kelas_id);
        $this->db->group_by('s.id');
        
        if ($table_exists) {
            $this->db->select('COUNT(mp.id) as completed_materi');
            $this->db->join('materi_progress mp', 'mp.materi_id = m.id AND mp.siswa_id = s.id AND mp.status = "Completed"', 'left');
        } else {
            // If table doesn't exist, set completed to 0
            $this->db->select('0 as completed_materi');
        }
        
        return $this->db->get()->result_array();
    }

    public function get_premium_classes_by_teacher($teacher_id)
    {
        $this->db->select('kp.*');
        $this->db->from('kelas_programming kp');
        $this->db->join('guru_kelas gk', 'gk.kelas_id = kp.id');
        $this->db->where('gk.guru_id', $teacher_id);
        $this->db->where('gk.status', 'Aktif');
        $this->db->where('kp.status', 'Aktif');
        return $this->db->get()->result();
    }

    public function get_gratis_classes_by_teacher($teacher_id)
    {
        $this->db->select('*');
        $this->db->from('free_classes');
        $this->db->where('mentor_id', $teacher_id);
        $this->db->where('status', 'Published');
        return $this->db->get()->result();
    }

    public function get_all_free_classes()
    {
        $this->db->select('id, title as nama_kelas');
        $this->db->from('free_classes');
        $this->db->where('status', 'Published');
        $this->db->order_by('title', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Fungsi untuk menghitung jumlah siswa yang terdaftar di kelas
    public function count_enrolled_students($kelas_id)
    {
        $this->db->select('COUNT(*) as total');
        $this->db->from('siswa');
        $this->db->where('kelas', (string)$kelas_id);
        $this->db->where('status', 'Aktif');
        $query = $this->db->get();
        $result = $query->row();
        return $result ? $result->total : 0;
    }
}
?>