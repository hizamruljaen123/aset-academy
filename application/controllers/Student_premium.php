<?php
class Student_premium extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Kelas_programming_model');
        $this->load->model('Payment_model');
        
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        
        if ($this->session->userdata('role') != 'siswa') {
            // If not a student, redirect to their respective dashboard or show an error
            if ($this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'super_admin') {
                redirect('dashboard');
            } else {
                show_error('Access denied. You must be a student to view this page.', 403);
            }
        }
    }

    public function index() {
        $student_id = $this->session->userdata('user_id');
        
        // Get paid classes with active enrollment
        $this->load->model('Premium_enrollment_model');
        $data['paid_classes'] = $this->Premium_enrollment_model->get_student_enrollments($student_id);
        
        // Get available premium classes
        $data['premium_classes'] = $this->Kelas_programming_model->get_premium_classes($student_id);

        // Pesanan kelas (semua pembayaran)
        $this->load->model('Payment_model');
        $data['orders'] = $this->Payment_model->get_user_payments($student_id);
        
        $data['title'] = 'Kelas Premium';
        $this->load->view('templates/header', $data);
        $this->load->view('student/premium', $data);
        $this->load->view('templates/footer');
    }
    
    public function detail($class_id) {
        $data['class'] = $this->Kelas_programming_model->get_kelas($class_id);
        if (!$data['class']) show_404();
        
        $data['title'] = 'Detail Kelas - ' . $data['class']->nama_kelas;
        $this->load->view('templates/header', $data);
        $this->load->view('student/premium_detail', $data);
        $this->load->view('templates/footer');
    }
    
}
