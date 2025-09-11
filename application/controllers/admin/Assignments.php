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

    public function create()
    {
        $this->load->model('Kelas_model');
        $this->load->model('Guru_model');

        $data['title'] = 'Buat Tugas Baru';
        $data['premium_classes'] = $this->Kelas_model->get_all_kelas();
        $data['free_classes'] = $this->Kelas_model->get_all_free_classes(); // Assuming this method exists
        $data['teachers'] = $this->Guru_model->get_all_gurus();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/assignments/create', $data);
        $this->load->view('templates/footer');
    }

    public function store()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', 'Judul', 'required');
        $this->form_validation->set_rules('class_id_type', 'Kelas', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->create(); // Reload create form with validation errors
        } else {
            list($class_id, $class_type) = explode('|', $this->input->post('class_id_type'));

            $data = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'class_id' => $class_id,
                'class_type' => $class_type,
                'teacher_id' => $this->session->userdata('user_id'), // Or select from a dropdown
                'due_date' => $this->input->post('due_date') ? $this->input->post('due_date') : NULL
            ];

            $this->assignment->create_assignment($data);
            $this->session->set_flashdata('success', 'Tugas baru berhasil dibuat.');
            redirect('admin/assignments');
        }
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
