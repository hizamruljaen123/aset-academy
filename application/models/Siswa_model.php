<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_model extends CI_Model {

    // Konstruktor untuk memuat library database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Fungsi untuk mendapatkan semua data siswa
    public function get_all_siswa()
    {
        $this->db->select('*');
        $this->db->from('siswa');
        $this->db->order_by('nama_lengkap', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Fungsi untuk mendapatkan data siswa berdasarkan ID
    public function get_siswa_by_email($email)
    {
        $this->db->where('email', $email);
        return $this->db->get('siswa')->row();
    }

    // Fungsi untuk mendapatkan data siswa berdasarkan ID
    public function get_siswa_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('siswa');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    // Fungsi untuk menambah data siswa
    public function insert_siswa($data)
    {
        $this->db->insert('siswa', $data);
        return $this->db->insert_id();
    }

    // Fungsi untuk mengupdate data siswa
    public function update_siswa($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('siswa', $data);
        return $this->db->affected_rows();
    }

    // Fungsi untuk menghapus data siswa
    public function delete_siswa($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('siswa');
        return $this->db->affected_rows();
    }

    // Fungsi untuk mencari siswa berdasarkan keyword
    public function search_siswa($keyword)
    {
        $this->db->select('*');
        $this->db->from('siswa');
        $this->db->like('nama_lengkap', $keyword);
        $this->db->or_like('nis', $keyword);
        $this->db->or_like('kelas', $keyword);
        $this->db->or_like('jurusan', $keyword);
        $this->db->order_by('nama_lengkap', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Fungsi untuk mendapatkan jumlah total siswa
    public function count_siswa()
    {
        return $this->db->count_all('siswa');
    }

    // Fungsi untuk mendapatkan jumlah siswa berdasarkan status
    public function count_siswa_by_status($status)
    {
        $this->db->where('status', $status);
        return $this->db->count_all_results('siswa');
    }

    public function count_by_status($status)
    {
        $this->db->where('status', $status);
        return $this->db->count_all_results('siswa');
    }

    public function get_jurusan_distribution()
    {
        $this->db->select('jurusan, COUNT(id) as total');
        $this->db->group_by('jurusan');
        $this->db->order_by('total', 'DESC');
        return $this->db->get('siswa')->result_array();
    }

    // Fungsi untuk mendapatkan data siswa berdasarkan kelas
    public function get_siswa_by_kelas($kelas_id)
    {
        $this->db->select('s.*, s.foto_profil');
        $this->db->from('siswa s');
        $this->db->join('kelas_programming kp', 's.kelas = kp.nama_kelas');
        $this->db->where('kp.id', $kelas_id);
        $this->db->order_by('s.nama_lengkap', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Fungsi untuk mendapatkan data siswa berdasarkan jurusan
    public function get_siswa_by_jurusan($jurusan)
    {
        $this->db->select('*');
        $this->db->from('siswa');
        $this->db->where('jurusan', $jurusan);
        $this->db->order_by('nama_lengkap', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_enrolled_programming_classes($siswa_id)
    {
        // For premium students: check siswa.kelas matches kelas_programming.nama_kelas
        $this->db->select('kp.*, NOW() as enrollment_date, "Enrolled" as enrollment_status');
        $this->db->from('kelas_programming kp');
        $this->db->join('siswa s', 'kp.nama_kelas = s.kelas');
        $this->db->where('s.id', $siswa_id);
        $this->db->where('kp.status', 'Aktif');
        return $this->db->get()->result_array();
    }

    public function get_enrolled_free_classes($siswa_id)
    {
        // For free class students: check free_class_enrollments table
        $this->db->select('fc.*, fce.enrollment_date, fce.status as enrollment_status');
        $this->db->from('free_classes fc');
        $this->db->join('free_class_enrollments fce', 'fc.id = fce.class_id');
        $this->db->where('fce.student_id', $siswa_id);
        $this->db->where_in('fce.status', ['Enrolled', 'Completed']);
        return $this->db->get()->result_array();
    }
}
?>