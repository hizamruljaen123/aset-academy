<?php
class Admin_enrollment extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Premium_enrollment_model');
        $this->load->model('Payment_model');
        $this->load->library('Permission');
        
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        
        if (!$this->permission->is_admin()) {
            show_error('Access denied. Admin role required.', 403);
        }
    }
    
    // Main enrollment management page
    public function index() {
        $data['enrollments'] = $this->Premium_enrollment_model->get_all_enrollments();
        $data['pending_enrollments'] = $this->Premium_enrollment_model->get_enrollments_by_status('Pending');
        $data['title'] = 'Kelola Akses Kelas Premium';
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/enrollment/index', $data);
        $this->load->view('templates/footer');
    }
    
    // Grant access to class
    public function grant_access($enrollment_id) {
        $enrollment = $this->db->where('id', $enrollment_id)->get('premium_class_enrollments')->row();
        if (!$enrollment) {
            show_404();
        }
        
        $previous_status = $enrollment->status;
        $admin_id = $this->session->userdata('user_id');
        
        // Update enrollment status to Active
        $this->Premium_enrollment_model->update_enrollment_status($enrollment_id, 'Active', $admin_id);
        
        // Log the action
        $this->Premium_enrollment_model->log_access_change(
            $enrollment_id, 
            $admin_id, 
            'Grant Access', 
            $previous_status, 
            'Active',
            'Access granted by admin'
        );
        
        // Update payment enrollment status
        $this->db->where('id', $enrollment->payment_id)->update('payments', [
            'enrollment_status' => 'Enrolled'
        ]);
        
        $this->session->set_flashdata('success', 'Akses kelas berhasil diberikan');
        redirect('admin/enrollment');
    }
    
    // Revoke access to class
    public function revoke_access($enrollment_id) {
        $enrollment = $this->db->where('id', $enrollment_id)->get('premium_class_enrollments')->row();
        if (!$enrollment) {
            show_404();
        }
        
        $previous_status = $enrollment->status;
        $admin_id = $this->session->userdata('user_id');
        
        // Update enrollment status to Suspended
        $this->Premium_enrollment_model->update_enrollment_status($enrollment_id, 'Suspended', $admin_id);
        
        // Log the action
        $this->Premium_enrollment_model->log_access_change(
            $enrollment_id, 
            $admin_id, 
            'Revoke Access', 
            $previous_status, 
            'Suspended',
            'Access revoked by admin'
        );
        
        // Update payment enrollment status
        $this->db->where('id', $enrollment->payment_id)->update('payments', [
            'enrollment_status' => 'Access Revoked'
        ]);
        
        $this->session->set_flashdata('success', 'Akses kelas berhasil dicabut');
        redirect('admin/enrollment');
    }
    
    // Update enrollment status with notes
    public function update_status() {
        $enrollment_id = $this->input->post('enrollment_id');
        $new_status = $this->input->post('status');
        $notes = $this->input->post('notes');
        
        $enrollment = $this->db->where('id', $enrollment_id)->get('premium_class_enrollments')->row();
        if (!$enrollment) {
            show_404();
        }
        
        $previous_status = $enrollment->status;
        $admin_id = $this->session->userdata('user_id');
        
        // Update enrollment
        $this->Premium_enrollment_model->update_enrollment_status($enrollment_id, $new_status, $admin_id, $notes);
        
        // Log the action
        $this->Premium_enrollment_model->log_access_change(
            $enrollment_id, 
            $admin_id, 
            'Update Status', 
            $previous_status, 
            $new_status,
            $notes
        );
        
        // Update payment enrollment status based on new status
        $enrollment_status = ($new_status == 'Active') ? 'Enrolled' : 'Access Revoked';
        $this->db->where('id', $enrollment->payment_id)->update('payments', [
            'enrollment_status' => $enrollment_status
        ]);
        
        $this->session->set_flashdata('success', 'Status enrollment berhasil diupdate');
        redirect('admin/enrollment');
    }
}
