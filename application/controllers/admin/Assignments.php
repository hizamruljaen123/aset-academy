<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assignments extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Assignment_model', 'assignment');
        $this->load->library('session');

        // Middleware to check if user is an admin
        if (!$this->session->userdata('user_id') || !in_array($this->session->userdata('role'), ['admin', 'super_admin'])) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['assignments'] = $this->assignment->get_all_assignments();
        $data['title'] = 'Manajemen Semua Tugas';
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/assignments/index', $data);
        $this->load->view('templates/footer');
    }

    public function submissions($assignment_id)
    {
        $this->load->model('Assignment_model');
        
        $data['assignment'] = $this->assignment->get_assignment($assignment_id);
        $data['submissions'] = $this->assignment->get_submissions($assignment_id);
        $data['title'] = 'Pengumpulan Tugas - ' . $data['assignment']->title;
        
        if (!$data['assignment']) {
            show_404();
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/assignments/submissions', $data);
        $this->load->view('templates/footer');
    }

    public function grade_submission()
    {
        $this->load->model('Assignment_model');
        $this->output->set_content_type('application/json');

        $submission_id = $this->input->post('submission_id');
        $grade = $this->input->post('grade');
        $feedback = $this->input->post('feedback');

        if (empty($submission_id) || !is_numeric($grade)) {
            echo json_encode(['success' => false, 'message' => 'Data tidak valid.']);
            return;
        }

        $data = [
            'grade' => $grade,
            'feedback' => $feedback,
            'status' => 'graded',
            'graded_at' => date('Y-m-d H:i:s')
        ];

        $result = $this->Assignment_model->grade_submission($submission_id, $data);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menyimpan penilaian ke database.']);
        }
    }
}
