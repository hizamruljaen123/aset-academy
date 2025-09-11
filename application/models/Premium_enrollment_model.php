<?php
class Premium_enrollment_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    // Create enrollment after payment verification
    public function create_enrollment($data) {
        return $this->db->insert('premium_class_enrollments', $data);
    }
    
    // Get enrollment by student and class
    public function get_enrollment($student_id, $class_id) {
        return $this->db->where([
            'student_id' => $student_id,
            'class_id' => $class_id
        ])->get('premium_class_enrollments')->row();
    }
    
    // Get all enrollments for admin management
    public function get_all_enrollments() {
        $this->db->select('pe.*, u.nama_lengkap as student_name, kp.nama_kelas as class_name, p.amount, p.payment_method');
        $this->db->from('premium_class_enrollments pe');
        $this->db->join('users u', 'pe.student_id = u.id');
        $this->db->join('kelas_programming kp', 'pe.class_id = kp.id');
        $this->db->join('payments p', 'pe.payment_id = p.id');
        $this->db->order_by('pe.created_at', 'DESC');
        return $this->db->get()->result();
    }
    
    // Get enrollments by status
    public function get_enrollments_by_status($status) {
        $this->db->select('pe.*, u.nama_lengkap as student_name, kp.nama_kelas as class_name, p.amount');
        $this->db->from('premium_class_enrollments pe');
        $this->db->join('users u', 'pe.student_id = u.id');
        $this->db->join('kelas_programming kp', 'pe.class_id = kp.id');
        $this->db->join('payments p', 'pe.payment_id = p.id');
        $this->db->where('pe.status', $status);
        $this->db->order_by('pe.created_at', 'DESC');
        return $this->db->get()->result();
    }
    
    // Update enrollment status
    public function update_enrollment_status($enrollment_id, $status, $admin_id, $notes = null) {
        $data = [
            'status' => $status,
            'access_granted_by' => $admin_id,
            'access_granted_at' => date('Y-m-d H:i:s')
        ];
        
        if ($notes) {
            $data['notes'] = $notes;
        }
        
        return $this->db->where('id', $enrollment_id)->update('premium_class_enrollments', $data);
    }
    
    // Log access changes
    public function log_access_change($enrollment_id, $admin_id, $action, $previous_status, $new_status, $reason = null) {
        $data = [
            'enrollment_id' => $enrollment_id,
            'admin_id' => $admin_id,
            'action' => $action,
            'previous_status' => $previous_status,
            'new_status' => $new_status,
            'reason' => $reason
        ];
        
        return $this->db->insert('class_access_logs', $data);
    }
    
    // Get student's active enrollments
    public function get_student_enrollments($student_id) {
        $this->db->select('pe.*, kp.nama_kelas, kp.deskripsi, kp.gambar, kp.harga');
        $this->db->from('premium_class_enrollments pe');
        $this->db->join('kelas_programming kp', 'pe.class_id = kp.id');
        $this->db->where('pe.student_id', $student_id);
        $this->db->where('pe.status', 'Active');
        return $this->db->get()->result();
    }
}
