<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Free_class extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Free_class_model', 'free_class');
        $this->load->library('session');
        // Ensure user is logged in and is a student
        if (!$this->session->userdata('user_id') || $this->session->userdata('role') != 'siswa') {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $student_id = $this->session->userdata('user_id');
        
        $data['title'] = 'Kelas Gratis';
        
        $data['enrolled_classes'] = $this->free_class->get_enrolled_classes($student_id, 3);
        $data['progress_stats'] = $this->free_class->get_progress_stats($student_id);
        $data['popular_classes'] = $this->free_class->get_popular_free_classes(3);
        $data['recent_classes'] = $this->free_class->get_recent_free_classes(3);

        $this->load->view('templates/header', $data);
        $this->load->view('student/free_classes/index', $data);
        $this->load->view('templates/footer');
    }

    public function browse()
    {
        $data['title'] = 'Jelajahi Kelas Gratis';

        $keyword = $this->input->get('keyword');
        $category = $this->input->get('category');
        $level = $this->input->get('level');

        $data['free_classes'] = $this->free_class->search_free_classes($keyword, $category, $level);
        $data['categories'] = $this->free_class->get_categories();
        $data['search_params'] = [
            'keyword' => $keyword,
            'category' => $category,
            'level' => $level
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('student/free_classes/browse', $data);
        $this->load->view('templates/footer');
    }

    public function my_classes()
    {
        $student_id = $this->session->userdata('user_id');
        $data['title'] = 'Kelas Saya';

        $enrollments = $this->free_class->get_all_enrolled_classes($student_id);

        foreach ($enrollments as $enrollment) {
            $enrollment->attendance = $this->free_class->get_student_attendance_by_class($student_id, $enrollment->id) ?? [];
            $enrollment->classmates = $this->free_class->get_enrolled_students($enrollment->id) ?? [];
        }

        $data['enrollments'] = $enrollments;
        $data['progress_stats'] = $this->free_class->get_progress_stats($student_id);

        $this->load->view('templates/header', $data);
        $this->load->view('student/free_classes/my_classes', $data);
        $this->load->view('templates/footer');
    }

    public function view($class_id)
    {
        $student_id = $this->session->userdata('user_id');
        $data['title'] = 'Detail Kelas';

        $data['free_class'] = $this->free_class->get_free_class_by_id($class_id);
        if (!$data['free_class'] || $data['free_class']->status != 'Published') {
            show_404();
        }

        $data['materials'] = $this->free_class->get_free_class_materials($class_id);
        $data['enrolled_count'] = $this->free_class->count_enrolled_students($class_id);
        $data['is_enrolled'] = $this->free_class->is_enrolled($student_id, $class_id);
        $data['is_full'] = ($data['free_class']->max_students && $data['enrolled_count'] >= $data['free_class']->max_students);
        $data['discussions'] = $this->free_class->get_free_class_discussions($class_id);
        $data['enrolled_students'] = $this->free_class->get_enrolled_students($class_id);
        $data['jadwal'] = $this->free_class->get_class_schedule($class_id);
        
        if ($data['is_enrolled']) {
            $data['enrollment'] = $this->free_class->get_enrollment($student_id, $class_id);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('student/free_classes/view', $data);
        $this->load->view('templates/footer');
    }

    public function enroll($class_id)
    {
        $student_id = $this->session->userdata('user_id');
        $class = $this->free_class->get_free_class_by_id($class_id);

        if (!$class || $class->status != 'Published') {
            $this->session->set_flashdata('error', 'Kelas tidak ditemukan.');
            redirect('student/free_classes/browse');
        }

        if ($this->free_class->is_enrolled($student_id, $class_id)) {
            $this->session->set_flashdata('error', 'Anda sudah terdaftar di kelas ini.');
            redirect('student/free_classes/view/' . $class_id);
        }

        $enrolled_count = $this->free_class->count_enrolled_students($class_id);
        if ($class->max_students && $enrolled_count >= $class->max_students) {
            $this->session->set_flashdata('error', 'Kelas ini sudah penuh.');
            redirect('student/free_classes/view/' . $class_id);
        }

        if ($this->free_class->enroll_student($student_id, $class_id)) {
            $this->session->set_flashdata('success', 'Anda berhasil mendaftar di kelas ini!');
            redirect('student/free_classes/view/' . $class_id);
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat mendaftar.');
            redirect('student/free_classes/view/' . $class_id);
        }
    }
}
