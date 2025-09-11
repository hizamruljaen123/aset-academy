<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assignments extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Assignment_model', 'assignment');
        $this->load->model('Kelas_model', 'kelas');
        $this->load->library('session');

        // Middleware to check if user is a student
        if (!$this->session->userdata('user_id') || $this->session->userdata('role') !== 'student') {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $student_id = $this->session->userdata('user_id');
        
        // This logic needs to be adapted based on how you track student enrollments
        // For now, we assume a method get_student_enrollments exists
        $data['enrollments'] = $this->get_student_enrollments($student_id);

        $data['title'] = 'Tugas Saya';
        $this->load->view('templates/header', $data);
        $this->load->view('student/assignments/index', $data);
        $this->load->view('templates/footer');
    }

    // Helper function to get all classes a student is enrolled in
    private function get_student_enrollments($student_id)
    {
        $premium_enrollments = $this->db->select('kp.*, "premium" as type')->from('premium_class_enrollments pce')->join('kelas_programming kp', 'pce.class_id = kp.id')->where('pce.student_id', $student_id)->where('pce.status', 'Active')->get()->result();
        $gratis_enrollments = $this->db->select('fc.*, "gratis" as type')->from('free_class_enrollments e')->join('free_classes fc', 'e.class_id = fc.id')->where('e.student_id', $student_id)->where('e.status', 'Enrolled')->get()->result();
        
        return array_merge($premium_enrollments, $gratis_enrollments);
    }

    public function view_class($class_id, $class_type)
    {
        $student_id = $this->session->userdata('user_id');

        if ($class_type == 'premium') {
            $data['class'] = $this->db->get_where('kelas_programming', ['id' => $class_id])->row();
        } else {
            $data['class'] = $this->db->get_where('free_classes', ['id' => $class_id])->row();
        }

        if (!$data['class']) {
            show_404();
        }

        $assignments = $this->assignment->get_assignments_by_class($class_id, $class_type);
        foreach ($assignments as $assignment) {
            $assignment->submission = $this->assignment->get_submission($student_id, $assignment->id);
        }

        $data['assignments'] = $assignments;
        $data['title'] = 'Tugas untuk ' . $data['class']->nama_kelas;

        $this->load->view('templates/header', $data);
        $this->load->view('student/assignments/view_class', $data);
        $this->load->view('templates/footer');
    }

    public function submit($assignment_id)
    {
        $this->load->library('form_validation');
        $student_id = $this->session->userdata('user_id');

        $data['assignment'] = $this->assignment->get_assignment($assignment_id);
        if (!$data['assignment']) {
            show_404();
        }

        $data['submission'] = $this->assignment->get_submission($student_id, $assignment_id);
        $data['title'] = 'Pengumpulan: ' . $data['assignment']->title;

        $this->form_validation->set_rules('submission_content', 'Jawaban Teks', 'trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('student/assignments/submit', $data);
            $this->load->view('templates/footer');
        } else {
            $upload_data = null;
            if (!empty($_FILES['submission_file']['name'])) {
                $config['upload_path'] = './uploads/submissions/';
                $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|zip|rar';
                $config['max_size'] = 2048; // 2MB
                $config['encrypt_name'] = TRUE;

                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, TRUE);
                }

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('submission_file')) {
                    $upload_data = $this->upload->data();
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('student/assignments/submit/' . $assignment_id);
                    return;
                }
            }

            $submission_data = [
                'assignment_id' => $assignment_id,
                'student_id' => $student_id,
                'submission_content' => $this->input->post('submission_content'),
                'submission_file' => $upload_data ? $upload_data['file_name'] : null,
                'submitted_at' => date('Y-m-d H:i:s'),
                'status' => 'submitted'
            ];

            $this->assignment->create_submission($submission_data);
            $this->session->set_flashdata('success', 'Tugas berhasil dikumpulkan.');
            redirect('student/assignments/view_class/' . $data['assignment']->class_id . '/' . $data['assignment']->class_type);
        }
    }
}
