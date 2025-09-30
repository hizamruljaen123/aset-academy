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

    // Get attendance statistics by class
    public function get_attendance_stats_by_class($kelas_id)
    {
        $this->db->select('status, COUNT(*) as count');
        $this->db->from('absensi a');
        $this->db->join('jadwal_kelas jk', 'a.jadwal_id = jk.id');
        $this->db->where('jk.kelas_id', $kelas_id);
        $this->db->group_by('status');
        $result = $this->db->get()->result_array();
        
        $stats = [
            'Hadir' => 0,
            'Sakit' => 0,
            'Izin' => 0,
            'Alpa' => 0
        ];
        
        foreach ($result as $row) {
            $stats[$row['status']] = (int)$row['count'];
        }
        
        return $stats;
    }

    public function get_attendance_summary($user_id)
    {
        $this->db->select('status, COUNT(id) as total');
        $this->db->from('absensi');
        $this->db->where('siswa_id', $user_id);
        $this->db->group_by('status');
        $query = $this->db->get();
        $result = $query->result_array();

        $summary = [
            'Hadir' => 0,
            'Sakit' => 0,
            'Izin' => 0,
            'Alpa' => 0,
        ];

        foreach ($result as $row) {
            if (array_key_exists($row['status'], $summary)) {
                $summary[$row['status']] = (int)$row['total'];
            }
        }

        return $summary;
    }

    public function get_attendance_rate($user_id)
    {
        $this->db->where('siswa_id', $user_id);
        $total_records = $this->db->count_all_results('absensi');

        if ($total_records == 0) {
            return 0;
        }

        $this->db->where('siswa_id', $user_id);
        $this->db->where('status', 'Hadir');
        $hadir_records = $this->db->count_all_results('absensi');

        return ($hadir_records / $total_records) * 100;
    }

    public function get_student_attendance($user_id, $limit = 10)
    {
        $this->db->select('a.*, jk.judul_pertemuan, jk.tanggal_pertemuan, jk.waktu_mulai, k.nama_kelas');
        $this->db->from('absensi a');
        $this->db->join('jadwal_kelas jk', 'a.jadwal_id = jk.id');
        $this->db->join('kelas_programming k', 'jk.kelas_id = k.id');
        $this->db->where('a.siswa_id', $user_id);
        $this->db->order_by('jk.tanggal_pertemuan', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    public function get_attendance_dates($user_id)
    {
        $this->db->select('DATE(jk.tanggal_pertemuan) as date, a.status');
        $this->db->from('absensi a');
        $this->db->join('jadwal_kelas jk', 'a.jadwal_id = jk.id');
        $this->db->where('a.siswa_id', $user_id);
        $this->db->order_by('jk.tanggal_pertemuan', 'ASC');
        $query = $this->db->get();
        $results = $query->result_array();

        $dates = [];
        foreach ($results as $row) {
            $dates[] = [
                'date' => $row['date'],
                'status' => $row['status']
            ];
        }

        return $dates;
    }

    public function get_status_class($status)
    {
        switch ($status) {
            case 'Hadir':
                return 'bg-green-100 text-green-800';
            case 'Sakit':
                return 'bg-blue-100 text-blue-800';
            case 'Izin':
                return 'bg-yellow-100 text-yellow-800';
            case 'Alpa':
                return 'bg-red-100 text-red-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    }

    public function count_total_absensi()
    {
        return $this->db->count_all('absensi');
    }

    public function count_absensi_by_status($status)
    {
        $this->db->where('status', $status);
        return $this->db->count_all_results('absensi');
    }
}
