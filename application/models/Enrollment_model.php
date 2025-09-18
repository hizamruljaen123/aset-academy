<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Enrollment_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Enroll student in a free class
     * 
     * @param int $class_id
     * @param int $student_id
     * @return int|bool Enrollment ID on success, false on failure
     */
    public function enroll_student($class_id, $student_id)
    {
        // Check if student is already enrolled
        $this->db->where('class_id', $class_id);
        $this->db->where('student_id', $student_id);
        $existing = $this->db->get('free_class_enrollments')->row();
        
        if ($existing) {
            // If enrollment exists but was dropped, reactivate it
            if ($existing->status == 'Dropped') {
                $this->db->where('id', $existing->id);
                $this->db->update('free_class_enrollments', [
                    'status' => 'Enrolled',
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                return $existing->id;
            }
            return false; // Already enrolled
        }
        
        // Create new enrollment
        $data = [
            'class_id' => $class_id,
            'student_id' => $student_id,
            'status' => 'Enrolled',
            'progress' => 0
        ];
        
        $this->db->insert('free_class_enrollments', $data);
        $enrollment_id = $this->db->insert_id();
        
        // Initialize progress records for all materials
        $this->initialize_progress_records($enrollment_id, $class_id);
        
        return $enrollment_id;
    }
    
    /**
     * Initialize progress records for all materials in a class
     * 
     * @param int $enrollment_id
     * @param int $class_id
     */
    private function initialize_progress_records($enrollment_id, $class_id)
    {
        // Get all materials for the class
        $this->db->where('class_id', $class_id);
        $materials = $this->db->get('free_class_materials')->result();
        
        // Create progress record for each material
        foreach ($materials as $material) {
            $data = [
                'enrollment_id' => $enrollment_id,
                'material_id' => $material->id,
                'status' => 'Not Started'
            ];
            $this->db->insert('free_class_progress', $data);
        }
    }
    
    /**
     * Get student enrollments
     * 
     * @param int $student_id
     * @param string $status Filter by status (optional)
     * @return array
     */
    public function get_student_enrollments($student_id, $status = null)
    {
        $this->db->select('e.*, fc.title, fc.thumbnail, fc.level, fc.category, fc.online_meet_link, u.nama_lengkap as mentor_name');
        $this->db->from('free_class_enrollments e');
        $this->db->join('free_classes fc', 'e.class_id = fc.id', 'left');
        $this->db->join('users u', 'fc.mentor_id = u.id', 'left');
        $this->db->where('e.student_id', $student_id);
        
        if ($status) {
            $this->db->where('e.status', $status);
        }
        
        $this->db->order_by('e.enrollment_date', 'DESC');
        return $this->db->get()->result();
    }
    
    /**
     * Get enrollment details
     * 
     * @param int $enrollment_id
     * @return object
     */
    public function get_enrollment_details($enrollment_id)
    {
        $this->db->select('e.*, fc.title, fc.description, fc.thumbnail, fc.level, fc.category, fc.duration, fc.online_meet_link, fc.start_date, fc.end_date, u.nama_lengkap as mentor_name');
        $this->db->from('free_class_enrollments e');
        $this->db->join('free_classes fc', 'e.class_id = fc.id', 'left');
        $this->db->join('users u', 'fc.mentor_id = u.id', 'left');
        $this->db->where('e.id', $enrollment_id);
        return $this->db->get()->row();
    }
    
    /**
     * Get enrollment by class and student
     * 
     * @param int $class_id
     * @param int $student_id
     * @return object
     */
    public function get_enrollment($class_id, $student_id)
    {
        $this->db->where('class_id', $class_id);
        $this->db->where('student_id', $student_id);
        return $this->db->get('free_class_enrollments')->row();
    }
    
    /**
     * Update enrollment status
     * 
     * @param int $enrollment_id
     * @param string $status
     * @return bool
     */
    public function update_enrollment_status($enrollment_id, $status)
    {
        $data = ['status' => $status];
        
        if ($status == 'Completed') {
            $data['completion_date'] = date('Y-m-d H:i:s');
            $data['progress'] = 100;
        }
        
        $this->db->where('id', $enrollment_id);
        return $this->db->update('free_class_enrollments', $data);
    }
    
    /**
     * Update material progress
     * 
     * @param int $enrollment_id
     * @param int $material_id
     * @param string $status
     * @return bool
     */
    public function update_material_progress($enrollment_id, $material_id, $status)
    {
        $data = [
            'status' => $status,
            'last_accessed' => date('Y-m-d H:i:s')
        ];
        
        if ($status == 'Completed') {
            $data['completion_date'] = date('Y-m-d H:i:s');
        }
        
        $this->db->where('enrollment_id', $enrollment_id);
        $this->db->where('material_id', $material_id);
        $result = $this->db->update('free_class_progress', $data);
        
        if ($result) {
            $this->update_overall_progress($enrollment_id);
        }
        
        return $result;
    }
    
    /**
     * Update overall progress percentage
     * 
     * @param int $enrollment_id
     */
    private function update_overall_progress($enrollment_id)
    {
        // Count total materials
        $this->db->where('enrollment_id', $enrollment_id);
        $total_materials = $this->db->count_all_results('free_class_progress');
        
        if ($total_materials == 0) {
            return;
        }
        
        // Count completed materials
        $this->db->where('enrollment_id', $enrollment_id);
        $this->db->where('status', 'Completed');
        $completed_materials = $this->db->count_all_results('free_class_progress');
        
        // Calculate progress percentage
        $progress = round(($completed_materials / $total_materials) * 100);
        
        // Update enrollment progress
        $this->db->where('id', $enrollment_id);
        $this->db->update('free_class_enrollments', ['progress' => $progress]);
        
        // If all materials are completed, mark enrollment as completed
        if ($progress == 100) {
            $this->update_enrollment_status($enrollment_id, 'Completed');
        }
    }
    
    /**
     * Get material progress
     * 
     * @param int $enrollment_id
     * @param int $material_id
     * @return object
     */
    public function get_material_progress($enrollment_id, $material_id)
    {
        $this->db->where('enrollment_id', $enrollment_id);
        $this->db->where('material_id', $material_id);
        return $this->db->get('free_class_progress')->row();
    }
    
    /**
     * Get all material progress for an enrollment
     * 
     * @param int $enrollment_id
     * @return array
     */
    public function get_all_material_progress($enrollment_id)
    {
        $this->db->select('p.*, m.title, m.content_type, m.order');
        $this->db->from('free_class_progress p');
        $this->db->join('free_class_materials m', 'p.material_id = m.id', 'left');
        $this->db->where('p.enrollment_id', $enrollment_id);
        $this->db->order_by('m.order', 'ASC');
        return $this->db->get()->result();
    }
    
    /**
     * Get enrolled students for a class
     * 
     * @param int $class_id
     * @param string $status Filter by status (optional)
     * @return array
     */
    public function get_enrolled_students($class_id, $status = null)
    {
        $this->db->select('e.*, u.nama_lengkap, u.email, s.nis, s.jurusan');
        $this->db->from('free_class_enrollments e');
        $this->db->join('users u', 'e.student_id = u.id', 'left');
        $this->db->join('siswa s', 'u.email = s.email', 'left');
        $this->db->where('e.class_id', $class_id);
        
        if ($status) {
            $this->db->where('e.status', $status);
        }
        
        $this->db->order_by('e.enrollment_date', 'DESC');
        return $this->db->get()->result();
    }
    
    /**
     * Get active enrollment for a student
     * 
     * @param int $student_id
     * @return object|null
     */
    public function get_active_enrollment($student_id)
    {
        $this->db->select('*, class_id as kelas_id');
        $this->db->from('free_class_enrollments');
        $this->db->where('student_id', $student_id);
        $this->db->where('status', 'Enrolled');
        $this->db->order_by('enrollment_date', 'DESC');
        $this->db->limit(1);
        return $this->db->get()->row();
    }
    
    /**
     * Get student progress statistics
     * 
     * @param int $student_id
     * @return array
     */
    public function get_student_progress_stats($student_id)
    {
        // Get total enrollments
        $this->db->where('student_id', $student_id);
        $total_enrollments = $this->db->count_all_results('free_class_enrollments');
        
        // Get completed enrollments
        $this->db->where('student_id', $student_id);
        $this->db->where('status', 'Completed');
        $completed_enrollments = $this->db->count_all_results('free_class_enrollments');
        
        // Get in-progress enrollments
        $this->db->where('student_id', $student_id);
        $this->db->where('status', 'Enrolled');
        $in_progress_enrollments = $this->db->count_all_results('free_class_enrollments');
        
        // Calculate average progress
        $this->db->select_avg('progress', 'avg_progress');
        $this->db->where('student_id', $student_id);
        $avg_row = $this->db->get('free_class_enrollments')->row();
        $avg_progress = ($avg_row && $avg_row->avg_progress !== null) ? (float) $avg_row->avg_progress : 0.0;
        
        return [
            'total_enrollments' => $total_enrollments,
            'completed_enrollments' => $completed_enrollments,
            'in_progress_enrollments' => $in_progress_enrollments,
            'avg_progress' => (int) round($avg_progress)
        ];
    }
    
    /**
     * Get all paid/premium class enrollments for a student
     * 
     * @param int $student_id
     * @return array
     */
    public function get_paid_classes($student_id)
    {
        $this->db->select('pce.*, kp.nama_kelas, kp.deskripsi, kp.level, kp.harga, kp.gambar, u.nama_lengkap as mentor_name');
        $this->db->from('premium_class_enrollments pce');
        $this->db->join('kelas_programming kp', 'kp.id = pce.class_id', 'left');
        // Note: There's no mentor_id in kelas_programming, so this join won't work as expected
        // Consider removing this join or finding another way to get mentor information
        $this->db->join('users u', 'u.id = 0', 'left'); // Dummy join since we don't have mentor_id
        $this->db->where('pce.student_id', $student_id);
        $this->db->where_in('pce.status', ['Active', 'Completed']); // Match the exact case from the ENUM
        $this->db->order_by('pce.enrollment_date', 'DESC');
        
        $query = $this->db->get();
        return $query->result();
    }
}
