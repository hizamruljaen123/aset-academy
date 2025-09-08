<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Get attendance records for a specific class and date
    public function get_absensi($jadwal_id)
    {
        $this->db->select('a.*, s.nama_lengkap, s.nis');
        $this->db->from('absensi a');
        $this->db->join('siswa s', 'a.siswa_id = s.id');
        $this->db->where('a.jadwal_id', $jadwal_id);
        return $this->db->get()->result_array();
    }

    // Save or update attendance records
    public function save_absensi($data)
    {
        // Check if record exists
        $this->db->where('jadwal_id', $data['jadwal_id']);
        $this->db->where('siswa_id', $data['siswa_id']);
        $q = $this->db->get('absensi');

        if ( $q->num_rows() > 0 ) 
        {
            $this->db->where('id', $q->row('id'));
            $this->db->update('absensi', $data);
        } else {
            $this->db->insert('absensi', $data);
        }
    }

    // Get attendance summary for a student
    public function get_rekap_siswa($siswa_id)
    {
        $this->db->select('a.status, COUNT(a.id) as total');
        $this->db->from('absensi a');
        $this->db->where('a.siswa_id', $siswa_id);
        $this->db->group_by('a.status');
        return $this->db->get()->result_array();
    }

    // Get all attendance records for admin
    public function get_all_absensi()
    {
        $this->db->select('a.*, s.nama_lengkap as nama_siswa, jk.judul_pertemuan, jk.tanggal_pertemuan, u.nama_lengkap as nama_guru');
        $this->db->from('absensi a');
        $this->db->join('siswa s', 'a.siswa_id = s.id');
        $this->db->join('jadwal_kelas jk', 'a.jadwal_id = jk.id');
        $this->db->join('users u', 'jk.guru_id = u.id');
        $this->db->order_by('jk.tanggal_pertemuan', 'DESC');
        return $this->db->get()->result_array();
    }

    // Get attendance data based on user roles
    public function get_absensi_for_user($user_id, $role)
    {
        $this->db->select('a.*, s.nama_lengkap as nama_siswa, jk.judul_pertemuan, jk.tanggal_pertemuan, u.nama_lengkap as nama_guru');
        $this->db->from('absensi a');
        $this->db->join('siswa s', 'a.siswa_id = s.id');
        $this->db->join('jadwal_kelas jk', 'a.jadwal_id = jk.id');
        $this->db->join('users u', 'jk.guru_id = u.id');

        if ($role == 'guru') {
            $this->db->where('jk.guru_id', $user_id);
        } elseif ($role == 'siswa') {
            $this->db->where('a.siswa_id', $user_id);
        }

        $this->db->order_by('jk.tanggal_pertemuan', 'DESC');
        return $this->db->get()->result_array();
    }

    // Get attendance summary for a class
    public function get_rekap_kelas($kelas_id)
    {
        $this->db->select('jk.tanggal_pertemuan, a.status, COUNT(a.id) as total');
        $this->db->from('absensi a');
        $this->db->join('jadwal_kelas jk', 'a.jadwal_id = jk.id');
        $this->db->where('jk.kelas_id', $kelas_id);
        $this->db->group_by(['jk.tanggal_pertemuan', 'a.status']);
        $this->db->order_by('jk.tanggal_pertemuan', 'DESC');
        return $this->db->get()->result_array();
    }
}
