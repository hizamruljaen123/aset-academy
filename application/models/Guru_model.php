<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Get classes assigned to a teacher (both premium and free) - FIXED STRUCTURE
    public function get_guru_kelas($guru_id)
    {
        // Get premium classes
        $this->db->select('kp.id, kp.nama_kelas, kp.bahasa_program, kp.level, kp.deskripsi, kp.durasi, kp.harga, kp.status, gk.assigned_at, "premium" as class_type');
        $this->db->from('guru_kelas gk');
        $this->db->join('kelas_programming kp', 'gk.kelas_id = kp.id');
        $this->db->where('gk.guru_id', $guru_id);
        $this->db->where('gk.status', 'Aktif');
        $this->db->where('kp.status', 'Aktif');
        $premium_classes = $this->db->get()->result();

        // Get free classes
        $this->db->select('fc.id, fc.title as nama_kelas, fc.category as bahasa_program, fc.level, fc.description, fc.duration as durasi, 0 as harga, fc.status, NULL as assigned_at, "gratis" as class_type, fc.online_meet_link', false);
        $this->db->from('free_classes fc');
        $this->db->where('fc.mentor_id', $guru_id);
        $this->db->where('fc.status', 'Published');
        $free_classes = $this->db->get()->result();

        // Combine results
        return array_merge($premium_classes, $free_classes);
    }

    // Get students in teacher's classes (both premium and free) - FIXED STRUCTURE
    public function get_guru_siswa($guru_id)
    {
        // Get students in premium classes (from siswa table)
        $this->db->select('s.id, s.nama_lengkap, s.nis, s.email, s.foto_profil, s.kelas, s.jurusan, s.status, kp.nama_kelas, "premium" as class_type');
        $this->db->from('siswa s');
        $this->db->join('kelas_programming kp', 's.kelas = kp.nama_kelas');
        $this->db->join('guru_kelas gk', 'kp.id = gk.kelas_id');
        $this->db->where('gk.guru_id', $guru_id);
        $this->db->where('gk.status', 'Aktif');
        $this->db->where('kp.status', 'Aktif');
        $premium_students = $this->db->get()->result();

        // Get students in free classes (from users table via enrollments)
        $this->db->select('u.id, u.nama_lengkap, "" as nis, u.email, "" as foto_profil, fc.title as kelas, "" as jurusan, u.status, fc.title as nama_kelas, "gratis" as class_type');
        $this->db->from('free_class_enrollments fce');
        $this->db->join('free_classes fc', 'fce.class_id = fc.id');
        $this->db->join('users u', 'fce.student_id = u.id');
        $this->db->where('fc.mentor_id', $guru_id);
        $this->db->where('fc.status', 'Published');
        $this->db->where_in('fce.status', ['Enrolled', 'Completed']);
        $free_students = $this->db->get()->result();

        // Combine results
        return array_merge($premium_students, $free_students);
    }

    // Get materials for teacher's classes (both premium and free)
    public function get_guru_materi($guru_id)
    {
        // Get materials from premium classes
        $this->db->select('m.*, kp.nama_kelas, (SELECT COUNT(mp.id) FROM materi_parts mp WHERE mp.materi_id = m.id) as jumlah_part, "premium" as class_type');
        $this->db->from('materi m');
        $this->db->join('kelas_programming kp', 'm.kelas_id = kp.id');
        $this->db->join('guru_kelas gk', 'kp.id = gk.kelas_id');
        $this->db->where('gk.guru_id', $guru_id);
        $this->db->where('gk.status', 'Aktif');
        $premium_materials = $this->db->get()->result();

        // Get materials from free classes
        $this->db->select('fcm.*, fc.title as nama_kelas, "gratis" as class_type');
        $this->db->from('free_class_materials fcm');
        $this->db->join('free_classes fc', 'fcm.class_id = fc.id');
        $this->db->where('fc.mentor_id', $guru_id);
        $this->db->where('fc.status', 'Published');
        $free_materials = $this->db->get()->result();

        // Add jumlah_part field to free materials for consistency
        foreach ($free_materials as $material) {
            $material->jumlah_part = 0;
        }

        // Combine results
        return array_merge($premium_materials, $free_materials);
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

    // Check if teacher has access to specific free class
    public function has_free_class_access($guru_id, $kelas_id)
    {
        $this->db->from('free_classes');
        $this->db->where('id', $kelas_id);
        $this->db->where('mentor_id', $guru_id);
        $this->db->where('status', 'Published');
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
    public function get_all_gurus()
    {
        $this->db->where('role', 'guru');
        $this->db->where('status', 'Aktif');
        return $this->db->get('users')->result();
    }

    public function get_all_absensi_guru()
    {
        $this->db->select('ag.*, 
            u.nama_lengkap as nama_guru, 
            u.foto_profil,
            jk.id as jadwal_id,
            jk.pertemuan_ke,
            jk.judul_pertemuan, 
            jk.tanggal_pertemuan, 
            jk.waktu_mulai, 
            jk.waktu_selesai, 
            jk.class_type,
            COALESCE(kp.nama_kelas, fc.title) as mata_pelajaran,
            kp.bahasa_program,
            kp.level as level_kelas,
            kp.deskripsi as deskripsi_kelas'
        );
        $this->db->from('absensi_guru ag');
        $this->db->join('users u', 'ag.guru_id = u.id');
        $this->db->join('jadwal_kelas jk', 'ag.jadwal_id = jk.id', 'left');
        $this->db->join('kelas_programming kp', 'jk.kelas_id = kp.id AND jk.class_type = "premium"', 'left');
        $this->db->join('free_classes fc', 'jk.kelas_id = fc.id AND jk.class_type = "gratis"', 'left');
        $this->db->order_by('jk.tanggal_pertemuan', 'DESC');
        $this->db->order_by('jk.waktu_mulai', 'DESC');
        
        $result = $this->db->get()->result_array();
        
        // Add waktu_absensi if not present (using current time as fallback)
        foreach ($result as &$row) {
            if (!isset($row['waktu_absensi']) || empty($row['waktu_absensi'])) {
                $row['waktu_absensi'] = date('Y-m-d H:i:s');
            }
            
            // Set default photo if not exists
            if (empty($row['foto_profil'])) {
                $row['foto_profil'] = 'default.jpg';
            }
            
            // Set default class type
            if (empty($row['class_type'])) {
                $row['class_type'] = 'premium';
            }
        }
        
        // Debug: Log query result
        log_message('debug', 'Guru_model get_all_absensi_guru result: ' . print_r($result, true));
        
        return $result;
    }

    public function get_absensi_guru_by_jadwal_ids(array $jadwal_ids)
    {
        if (empty($jadwal_ids)) {
            return [];
        }

        $this->db->select('ag.*, u.nama_lengkap as nama_guru, jk.judul_pertemuan, jk.tanggal_pertemuan, jk.waktu_mulai, jk.waktu_selesai, jk.class_type');
        $this->db->from('absensi_guru ag');
        $this->db->join('users u', 'ag.guru_id = u.id');
        $this->db->join('jadwal_kelas jk', 'ag.jadwal_id = jk.id', 'left');
        $this->db->where_in('ag.jadwal_id', $jadwal_ids);
        $results = $this->db->get()->result();

        $mapped = [];
        foreach ($results as $row) {
            $mapped[$row->jadwal_id] = $row;
        }

        return $mapped;
    }

    // Get dashboard stats for teacher
    public function get_guru_stats($guru_id)
    {
        $stats = [];
        
        // Count assigned premium classes
        $this->db->from('guru_kelas');
        $this->db->where('guru_id', $guru_id);
        $this->db->where('status', 'Aktif');
        $stats['total_premium_kelas'] = $this->db->count_all_results();
        
        // Count assigned free classes
        $this->db->from('free_classes');
        $this->db->where('mentor_id', $guru_id);
        $this->db->where('status', 'Published');
        $stats['total_free_kelas'] = $this->db->count_all_results();
        
        // Total classes (premium + free)
        $stats['total_kelas'] = $stats['total_premium_kelas'] + $stats['total_free_kelas'];
        
        // Count students in assigned premium classes
        $this->db->select('COUNT(DISTINCT s.id) as total');
        $this->db->from('siswa s');
        $this->db->join('kelas_programming kp', 's.kelas = kp.nama_kelas');
        $this->db->join('guru_kelas gk', 'kp.id = gk.kelas_id');
        $this->db->where('gk.guru_id', $guru_id);
        $this->db->where('gk.status', 'Aktif');
        $result = $this->db->get()->row();
        $stats['total_siswa'] = $result->total;
        
        // Count students in assigned free classes
        $this->db->select('COUNT(DISTINCT fce.student_id) as total');
        $this->db->from('free_class_enrollments fce');
        $this->db->join('free_classes fc', 'fce.class_id = fc.id');
        $this->db->where('fc.mentor_id', $guru_id);
        $this->db->where('fc.status', 'Published');
        $this->db->where_in('fce.status', ['Enrolled', 'Completed']);
        $result = $this->db->get()->row();
        $stats['total_free_students'] = $result->total;
        
        // Total students (premium + free)
        $stats['total_all_students'] = $stats['total_siswa'] + $stats['total_free_students'];
        
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

    // Get free classes assigned to a teacher (mentor_id based)
    public function get_guru_free_classes($guru_id)
    {
        $this->db->select('fc.*');
        $this->db->from('free_classes fc');
        $this->db->where('fc.mentor_id', $guru_id);
        $this->db->where('fc.status', 'Published');
        $this->db->order_by('fc.title', 'ASC');
        return $this->db->get()->result();
    }

    // Assign teacher to free class (update mentor_id)
    public function assign_guru_free_class($guru_id, $class_id)
    {
        $this->db->where('id', $class_id);
        return $this->db->update('free_classes', ['mentor_id' => $guru_id]);
    }

    // Remove teacher from free class (set mentor_id to NULL)
    public function remove_guru_free_class($guru_id, $class_id)
    {
        $this->db->where('id', $class_id);
        $this->db->where('mentor_id', $guru_id);
        return $this->db->update('free_classes', ['mentor_id' => NULL]);
    }

    // Check if teacher has access to specific free class
    public function count_total_absensi_guru($status = null)
    {
        if ($status !== null) {
            $this->db->where('status', $status);
        }

        return $this->db->count_all_results('absensi_guru');
    }
}
