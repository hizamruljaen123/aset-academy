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
        if (!$this->session->userdata('user_id') || $this->session->userdata('role') !== 'siswa') {
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
        // For premium classes: check siswa.kelas matches kelas_programming.nama_kelas
        $premium_enrollments = $this->db->select('kp.*, "premium" as type')
                                       ->from('siswa s')
                                       ->join('kelas_programming kp', 's.kelas = kp.nama_kelas')
                                       ->where('s.id', $student_id)
                                       ->where('kp.status', 'Aktif')
                                       ->get()->result();

        // For free classes: check free_class_enrollments table
        $gratis_enrollments = $this->db->select('fc.*, "gratis" as type')
                                      ->from('free_class_enrollments fce')
                                      ->join('free_classes fc', 'fce.class_id = fc.id')
                                      ->where('fce.student_id', $student_id)
                                      ->where('fce.status', 'Enrolled')
                                      ->where('fc.status', 'Published')
                                      ->get()->result();

        return array_merge($premium_enrollments, $gratis_enrollments);
    }

    public function view_class($class_id, $class_type)
    {
        $student_id = $this->session->userdata('user_id');

        if ($class_type == 'premium') {
            $class = $this->db->get_where('kelas_programming', ['id' => $class_id])->row();
            if ($class) {
                $class->nama_kelas = $class->nama_kelas; // Already has nama_kelas
            }
        } else {
            $class = $this->db->get_where('free_classes', ['id' => $class_id])->row();
            if ($class) {
                $class->nama_kelas = $class->title; // Map title to nama_kelas
            }
        }

        if (!$class) {
            show_404();
        }

        $assignments = $this->assignment->get_assignments_by_class($class_id, $class_type);
        foreach ($assignments as $assignment) {
            $assignment->submission = $this->assignment->get_submission($student_id, $assignment->id);
        }

        $data['assignments'] = $assignments;
        $data['class'] = $class;
        $data['title'] = 'Tugas untuk ' . (isset($class->nama_kelas) ? $class->nama_kelas : 'Kelas');

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
