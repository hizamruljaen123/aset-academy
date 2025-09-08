<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Get classes assigned to a teacher
    public function get_guru_kelas($guru_id)
    {
        $this->db->select('kp.*, gk.assigned_at');
        $this->db->from('guru_kelas gk');
        $this->db->join('kelas_programming kp', 'gk.kelas_id = kp.id');
        $this->db->where('gk.guru_id', $guru_id);
        $this->db->where('gk.status', 'Aktif');
        $this->db->order_by('kp.nama_kelas', 'ASC');
        return $this->db->get()->result();
    }

    // Get students in teacher's classes
    public function get_guru_siswa($guru_id)
    {
        $this->db->select('s.*, kp.nama_kelas');
        $this->db->from('siswa s');
        $this->db->join('kelas_programming kp', 's.kelas = kp.nama_kelas');
        $this->db->join('guru_kelas gk', 'kp.id = gk.kelas_id');
        $this->db->where('gk.guru_id', $guru_id);
        $this->db->where('gk.status', 'Aktif');
        $this->db->order_by('s.nama_lengkap', 'ASC');
        return $this->db->get()->result();
    }

    // Get materials for teacher's classes
    public function get_guru_materi($guru_id)
    {
        $this->db->select('m.*, kp.nama_kelas, (SELECT COUNT(mp.id) FROM materi_parts mp WHERE mp.materi_id = m.id) as jumlah_part');
        $this->db->from('materi m');
        $this->db->join('kelas_programming kp', 'm.kelas_id = kp.id');
        $this->db->join('guru_kelas gk', 'kp.id = gk.kelas_id');
        $this->db->where('gk.guru_id', $guru_id);
        $this->db->where('gk.status', 'Aktif');
        $this->db->order_by('m.created_at', 'DESC');
        return $this->db->get()->result();
    }

    // Check if teacher has access to specific class
    public function has_class_access($guru_id, $kelas_id)
    {
        $this->db->from('guru_kelas');
        $this->db->where('guru_id', $guru_id);
        $this->db->where('kelas_id', $kelas_id);
        $this->db->where('status', 'Aktif');
        return $this->db->count_all_results() > 0;
    }

    // Assign teacher to class
    public function assign_guru_kelas($guru_id, $kelas_id)
    {
        $data = [
            'guru_id' => $guru_id,
            'kelas_id' => $kelas_id,
            'status' => 'Aktif'
        ];
        return $this->db->insert('guru_kelas', $data);
    }

    // Remove teacher from class
    public function remove_guru_kelas($guru_id, $kelas_id)
    {
        $this->db->where('guru_id', $guru_id);
        $this->db->where('kelas_id', $kelas_id);
        return $this->db->delete('guru_kelas');
    }

    // Get dashboard stats for teacher
    public function get_guru_stats($guru_id)
    {
        $stats = [];
        
        // Count assigned classes
        $this->db->from('guru_kelas');
        $this->db->where('guru_id', $guru_id);
        $this->db->where('status', 'Aktif');
        $stats['total_kelas'] = $this->db->count_all_results();
        
        // Count students in assigned classes
        $this->db->select('COUNT(DISTINCT s.id) as total');
        $this->db->from('siswa s');
        $this->db->join('kelas_programming kp', 's.kelas = kp.nama_kelas');
        $this->db->join('guru_kelas gk', 'kp.id = gk.kelas_id');
        $this->db->where('gk.guru_id', $guru_id);
        $this->db->where('gk.status', 'Aktif');
        $result = $this->db->get()->row();
        $stats['total_siswa'] = $result->total;
        
        // Count materials in assigned classes
        $this->db->select('COUNT(m.id) as total');
        $this->db->from('materi m');
        $this->db->join('guru_kelas gk', 'm.kelas_id = gk.kelas_id');
        $this->db->where('gk.guru_id', $guru_id);
        $this->db->where('gk.status', 'Aktif');
        $result = $this->db->get()->row();
        $stats['total_materi'] = $result->total;
        
        return $stats;
    }
}
