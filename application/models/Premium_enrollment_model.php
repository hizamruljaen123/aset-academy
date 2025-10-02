<?php
class Premium_enrollment_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    // Create enrollment after payment verification
    public function create_enrollment($data) {
        $result = $this->db->insert('premium_class_enrollments', $data);
        if ($result) {
            $enrollment_id = $this->db->insert_id();
            // Initialize progress records for all materials
            $this->initialize_progress_records($enrollment_id, $data['class_id']);
        }
        return $result;
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
        $this->db->select('pe.*, u.nama_lengkap as student_name, kp.nama_kelas as class_name, p.amount, p.payment_method');
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
        $this->db->select('pe.*, kp.nama_kelas as class_name, kp.deskripsi, kp.gambar, kp.harga, p.amount');
        $this->db->from('premium_class_enrollments pe');
        $this->db->join('kelas_programming kp', 'pe.class_id = kp.id');
        $this->db->join('payments p', 'pe.payment_id = p.id', 'left');
        $this->db->where('pe.student_id', $student_id);
        $this->db->where('pe.status', 'Active');
        return $this->db->get()->result();
    }

    public function get_enrollment_details_by_id($enrollment_id) {
        $this->db->select('pe.*, kp.nama_kelas, kp.deskripsi, kp.level, kp.bahasa_program, kp.durasi, kp.harga, kp.gambar, kp.online_meet_link, p.amount, p.payment_method, p.invoice_number, p.status as payment_status, p.notes as payment_notes');
        $this->db->from('premium_class_enrollments pe');
        $this->db->join('kelas_programming kp', 'pe.class_id = kp.id', 'left');
        $this->db->join('payments p', 'pe.payment_id = p.id', 'left');
        $this->db->where('pe.id', $enrollment_id);
        return $this->db->get()->row();
    }

    // Progress tracking methods for premium classes
    public function initialize_progress_records($enrollment_id, $class_id) {
        // Get all materials for the class
        $this->db->where('kelas_id', $class_id);
        $materials = $this->db->get('materi')->result();

        // Create progress record for each material
        foreach ($materials as $material) {
            $data = [
                'enrollment_id' => $enrollment_id,
                'material_id' => $material->id,
                'status' => 'Not Started'
            ];
            $this->db->insert('premium_class_progress', $data);
        }
    }

    public function update_material_progress($enrollment_id, $material_id, $status) {
        $data = [
            'status' => $status,
            'last_accessed' => date('Y-m-d H:i:s')
        ];

        if ($status == 'Completed') {
            $data['completion_date'] = date('Y-m-d H:i:s');
        }

        $this->db->where('enrollment_id', $enrollment_id);
        $this->db->where('material_id', $material_id);
        $result = $this->db->update('premium_class_progress', $data);

        if ($result) {
            $this->update_overall_progress($enrollment_id);
        }

        return $result;
    }

    private function update_overall_progress($enrollment_id) {
        // Count total materials
        $this->db->where('enrollment_id', $enrollment_id);
        $total_materials = $this->db->count_all_results('premium_class_progress');

        if ($total_materials == 0) {
            return;
        }

        // Count completed materials
        $this->db->where('enrollment_id', $enrollment_id);
        $this->db->where('status', 'Completed');
        $completed_materials = $this->db->count_all_results('premium_class_progress');

        // Calculate progress percentage
        $progress = round(($completed_materials / $total_materials) * 100);

        // Update enrollment progress
        $this->db->where('id', $enrollment_id);
        $this->db->update('premium_class_enrollments', ['progress' => $progress]);

        // If all materials are completed, mark enrollment as completed
        if ($progress == 100) {
            $this->db->where('id', $enrollment_id);
            $this->db->update('premium_class_enrollments', [
                'status' => 'Completed',
                'completion_date' => date('Y-m-d H:i:s')
            ]);
        }
    }

    public function get_material_progress($enrollment_id, $material_id) {
        $this->db->where('enrollment_id', $enrollment_id);
        $this->db->where('material_id', $material_id);
        return $this->db->get('premium_class_progress')->row();
    }

    public function get_all_material_progress($enrollment_id) {
        $this->db->select('p.*, m.judul as title, m.deskripsi as description');
        $this->db->from('premium_class_progress p');
        $this->db->join('materi m', 'p.material_id = m.id', 'left');
        $this->db->where('p.enrollment_id', $enrollment_id);
        $this->db->order_by('m.created_at', 'ASC');
        return $this->db->get()->result();
    }

    // Discussion methods for premium classes
    public function create_discussion($data) {
        return $this->db->insert('premium_class_discussions', $data);
    }

    public function get_class_discussions($class_id) {
        $this->db->select('d.*, u.nama_lengkap, u.username');
        $this->db->from('premium_class_discussions d');
        $this->db->join('users u', 'd.user_id = u.id', 'left');
        $this->db->where('d.class_id', $class_id);
        $this->db->order_by('d.created_at', 'ASC');
        return $this->db->get()->result();
    }

}
