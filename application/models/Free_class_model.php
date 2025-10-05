<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Free_class_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Get all free classes
     * 
     * @param string $status Filter by status (optional)
     * @return array
     */
    public function get_all_free_classes($status = null)
    {
        $this->db->select('fc.*, u.nama_lengkap as mentor_name');
        $this->db->from('free_classes fc');
        $this->db->join('users u', 'fc.mentor_id = u.id', 'left');
        
        if ($status) {
            $this->db->where('fc.status', $status);
        }
        
        $this->db->order_by('fc.created_at', 'DESC');
        return $this->db->get()->result();
    }
    
    /**
     * Get free class by ID
     * 
     * @param int $id
     * @return object
     */
    public function get_free_class_by_id($id)
    {
        $this->db->select('fc.*, u.nama_lengkap as mentor_name');
        $this->db->from('free_classes fc');
        $this->db->join('users u', 'fc.mentor_id = u.id', 'left');
        $this->db->where('fc.id', $id);
        return $this->db->get()->row();
    }
    
    /**
     * Create new free class
     * 
     * @param array $data
     * @return int Inserted ID
     */
    public function create_free_class($data)
    {
        $this->db->insert('free_classes', $data);
        return $this->db->insert_id();
    }
    
    /**
     * Update free class
     * 
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update_free_class($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('free_classes', $data);
    }
    
    /**
     * Delete free class
     * 
     * @param int $id
     * @return bool
     */
    public function delete_free_class($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('free_classes');
    }
    
    /**
     * Get free classes by mentor ID
     * 
     * @param int $mentor_id
     * @param string $status Filter by status (optional)
     * @return array
     */
    public function get_free_classes_by_mentor($mentor_id, $status = null)
    {
        $this->db->select('fc.*, u.nama_lengkap as mentor_name');
        $this->db->from('free_classes fc');
        $this->db->join('users u', 'fc.mentor_id = u.id', 'left');
        $this->db->where('fc.mentor_id', $mentor_id);
        
        if ($status) {
            $this->db->where('fc.status', $status);
        }
        
        $this->db->order_by('fc.created_at', 'DESC');
        return $this->db->get()->result();
    }
    
    /**
     * Get free class materials
     * 
     * @param int $class_id
     * @return array
     */
    public function get_free_class_materials($class_id)
    {
        $this->db->where('class_id', $class_id);
        $this->db->order_by('order', 'ASC');
        return $this->db->get('free_class_materials')->result();
    }
    
    /**
     * Get free class material by ID
     * 
     * @param int $material_id
     * @return object
     */
    public function get_free_class_material_by_id($material_id)
    {
        $this->db->where('id', $material_id);
        return $this->db->get('free_class_materials')->row();
    }
    
    /**
     * Create free class material
     * 
     * @param array $data
     * @return int Inserted ID
     */
    public function create_free_class_material($data)
    {
        $this->db->insert('free_class_materials', $data);
        return $this->db->insert_id();
    }
    
    /**
     * Update free class material
     * 
     * @param int $material_id
     * @param array $data
     * @return bool
     */
    public function update_free_class_material($material_id, $data)
    {
        $this->db->where('id', $material_id);
        return $this->db->update('free_class_materials', $data);
    }
    
    /**
     * Delete free class material
     * 
     * @param int $material_id
     * @return bool
     */
    public function delete_free_class_material($material_id)
    {
        $this->db->where('id', $material_id);
        return $this->db->delete('free_class_materials');
    }
    
    /**
     * Count enrolled students in a free class
     * 
     * @param int $class_id
     * @return int
     */
    public function count_enrolled_students($class_id)
    {
        $this->db->where('class_id', $class_id);
        $this->db->where('status', 'Enrolled');
        return $this->db->count_all_results('free_class_enrollments');
    }
    
    /**
     * Get free class discussions
     * 
     * @param int $class_id
     * @param int $parent_id Parent discussion ID (null for top-level discussions)
     * @return array
     */
    public function get_free_class_discussions($class_id, $parent_id = null)
    {
        $this->db->select('d.*, u.nama_lengkap, u.role');
        $this->db->from('free_class_discussions d');
        $this->db->join('users u', 'd.user_id = u.id', 'left');
        $this->db->where('d.class_id', $class_id);
        
        if ($parent_id === null) {
            $this->db->where('d.parent_id IS NULL');
        } else {
            $this->db->where('d.parent_id', $parent_id);
        }
        
        $this->db->order_by('d.created_at', 'ASC');
        return $this->db->get()->result();
    }
    
    /**
     * Create free class discussion
     * 
     * @param array $data
     * @return int Inserted ID
     */
    public function create_free_class_discussion($data)
    {
        $this->db->insert('free_class_discussions', $data);
        return $this->db->insert_id();
    }
    
    /**
     * Get popular free classes
     * 
     * @param int $limit
     * @return array
     */
    
    public function get_popular_free_classes($limit = 5)
    {
        $this->db->select('fc.*, u.nama_lengkap as mentor_name, COUNT(fce.id) as enrollment_count');
        $this->db->from('free_classes fc');
        $this->db->join('users u', 'fc.mentor_id = u.id', 'left');
        $this->db->join('free_class_enrollments fce', 'fc.id = fce.class_id', 'left');
        $this->db->where_in('fc.status', ['Published', 'Coming Soon']);
        $this->db->group_by('fc.id');
        $this->db->order_by('enrollment_count', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
    
    /**
     * Get recent free classes
     * 
     * @param int $limit
     * @return array
     */
    public function get_recent_free_classes($limit = 5)
    {
        $this->db->select('fc.*, u.nama_lengkap as mentor_name');
        $this->db->from('free_classes fc');
        $this->db->join('users u', 'fc.mentor_id = u.id', 'left');
        $this->db->where_in('fc.status', ['Published', 'Coming Soon']);
        $this->db->order_by('fc.created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
    
    /**
     * Search free classes
     * 
     * @param string $keyword
     * @param string $category
     * @param string $level
     * @return array
     */
    public function search_free_classes($keyword = null, $category = null, $level = null)
    {
        $this->db->select('fc.*, u.nama_lengkap as mentor_name');
        $this->db->from('free_classes fc');
        $this->db->join('users u', 'fc.mentor_id = u.id', 'left');
        $this->db->where_in('fc.status', ['Published', 'Coming Soon']);
        
        if ($keyword) {
            $this->db->group_start();
            $this->db->like('fc.title', $keyword);
            $this->db->or_like('fc.description', $keyword);
            $this->db->group_end();
        }
        
        if ($category) {
            $this->db->where('fc.category', $category);
        }
        
        if ($level) {
            $this->db->where('fc.level', $level);
        }
        
        $this->db->order_by('fc.created_at', 'DESC');
        return $this->db->get()->result();
    }
    
    /**
     * Get available categories
     * 
     * @return array
     */
    public function get_categories()
    {
        $this->db->distinct();
        $this->db->select('category');
        $this->db->from('free_classes');
        $this->db->where_in('status', ['Published', 'Coming Soon']);
        $this->db->order_by('category', 'ASC');
        
        $result = $this->db->get()->result();
        $categories = [];
        
        foreach ($result as $row) {
            $categories[] = $row->category;
        }
        
        return $categories;
    }

    /**
     * Get enrolled classes for a student
     * 
     * @param int $student_id
     * @param int $limit (optional)
     * @return array
     */
    public function get_enrolled_classes($student_id, $limit = null)
    {
        $this->db->select('fc.*, fce.progress, fce.status as enrollment_status, u.nama_lengkap as mentor_name');
        $this->db->from('free_class_enrollments fce');
        $this->db->join('free_classes fc', 'fce.class_id = fc.id');
        $this->db->join('users u', 'fc.mentor_id = u.id', 'left');
        $this->db->where('fce.student_id', $student_id);
        $this->db->where('fce.status', 'Enrolled');
        $this->db->order_by('fce.enrollment_date', 'DESC');
        
        if ($limit) {
            $this->db->limit($limit);
        }
        
        return $this->db->get()->result();
    }

    /**
     * Get progress stats for a student
     * 
     * @param int $student_id
     * @return array
     */
    public function get_progress_stats($student_id)
    {
        $stats = [
            'total_enrollments' => 0,
            'completed_enrollments' => 0,
            'avg_progress' => 0
        ];

        $this->db->from('free_class_enrollments');
        $this->db->where('student_id', $student_id);
        $enrollments = $this->db->get()->result();

        if (empty($enrollments)) {
            return $stats;
        }

        $stats['total_enrollments'] = count($enrollments);
        $total_progress = 0;

        foreach ($enrollments as $enrollment) {
            if ($enrollment->status == 'Completed') {
                $stats['completed_enrollments']++;
            }
            $total_progress += $enrollment->progress;
        }

        if ($stats['total_enrollments'] > 0) {
            $stats['avg_progress'] = round($total_progress / $stats['total_enrollments']);
        }

        return $stats;
    }

    /**
     * Get all enrolled classes for a student
     * 
     * @param int $student_id
     * @return array
     */
    public function get_all_enrolled_classes($student_id)
    {
        $this->db->select('fc.*, fce.id as enrollment_id, fce.progress, fce.status, fce.enrollment_date, fce.completion_date, u.nama_lengkap as mentor_name');
        $this->db->from('free_class_enrollments fce');
        $this->db->join('free_classes fc', 'fce.class_id = fc.id');
        $this->db->join('users u', 'fc.mentor_id = u.id', 'left');
        $this->db->where('fce.student_id', $student_id);
        $this->db->order_by('fce.enrollment_date', 'DESC');
        
        return $this->db->get()->result();
    }

    /**
     * Check if a student is enrolled in a class
     * 
     * @param int $student_id
     * @param int $class_id
     * @return bool
     */
    public function is_enrolled($student_id, $class_id)
    {
        $this->db->where('student_id', $student_id);
        $this->db->where('class_id', $class_id);
        return $this->db->count_all_results('free_class_enrollments') > 0;
    }

    /**
     * Get enrollment details for a student in a class
     * 
     * @param int $student_id
     * @param int $class_id
     * @return object
     */
    public function get_enrollment($student_id, $class_id)
    {
        $this->db->where('student_id', $student_id);
        $this->db->where('class_id', $class_id);
        return $this->db->get('free_class_enrollments')->row();
    }

    /**
     * Enroll a student in a free class
     * 
     * @param int $student_id
     * @param int $class_id
     * @return bool
     */
    public function enroll_student($student_id, $class_id)
    {
        $data = [
            'student_id' => $student_id,
            'class_id' => $class_id,
            'enrollment_date' => date('Y-m-d H:i:s'),
            'status' => 'Enrolled'
        ];
        return $this->db->insert('free_class_enrollments', $data);
    }

    /**
     * Get enrolled students for a class
     * 
     * @param int $class_id
     * @return array
     */
    public function get_enrolled_students($class_id)
    {
        $this->db->select('u.id, u.nama_lengkap, u.email, u.username as nis, u.foto_profil, u.status as account_status, fce.status as status');
        $this->db->from('free_class_enrollments fce');
        $this->db->join('users u', 'fce.student_id = u.id');
        $this->db->where('fce.class_id', $class_id);
        $this->db->where('fce.status', 'Enrolled');
        $this->db->order_by('u.nama_lengkap', 'ASC');
        return $this->db->get()->result();
    }

    /**
     * Get class schedule for a free class
     * 
     * @param int $class_id
     * @return array
     */
    public function get_class_schedule($class_id)
    {
        $this->db->where('kelas_id', $class_id);
        $this->db->where('class_type', 'free');
        $this->db->order_by('pertemuan_ke', 'ASC');
        return $this->db->get('jadwal_kelas')->result_array();
    }

    public function get_student_attendance_by_class($student_id, $class_id)
    {
        $this->db->select('jk.pertemuan_ke, jk.judul_pertemuan, jk.tanggal_pertemuan, a.status');
        $this->db->from('jadwal_kelas jk');
        $this->db->join('absensi a', 'a.jadwal_id = jk.id AND a.siswa_id = ' . $this->db->escape($student_id), 'left');
        $this->db->where('jk.kelas_id', $class_id);
        $this->db->where('jk.class_type', 'free');
        $this->db->order_by('jk.pertemuan_ke', 'ASC');
        return $this->db->get()->result();
    }
}
