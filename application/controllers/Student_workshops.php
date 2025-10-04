<?php
class Student_workshops extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Workshop_model');

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

        // Get all published workshops
        $data['workshops'] = $this->Workshop_model->get_all_workshops();

        // Get workshops user has registered for
        $data['my_workshops'] = $this->Workshop_model->get_user_workshops($student_id);

        $data['title'] = 'Workshop & Seminar';
        $this->load->view('templates/header', $data);
        $this->load->view('student/workshops', $data);
        $this->load->view('templates/footer');
    }

    public function detail($workshop_id) {
        // Validate workshop exists and is published
        $workshop = $this->Workshop_model->get_workshop($workshop_id);
        if (!$workshop) {
            show_404();
        }

        $student_id = $this->session->userdata('user_id');

        // Check if user is already registered
        $data['is_registered'] = $this->Workshop_model->is_user_registered($workshop_id, $student_id);

        $data['workshop'] = $workshop;
        $data['title'] = $workshop->title;

        $this->load->view('templates/header', $data);
        $this->load->view('student/workshop_detail', $data);
        $this->load->view('templates/footer');
    }

    public function register($workshop_id) {
        // Validate workshop exists and is published
        $workshop = $this->Workshop_model->get_workshop($workshop_id);
        if (!$workshop) {
            show_404();
        }

        $student_id = $this->session->userdata('user_id');

        // Check if user is already registered
        if ($this->Workshop_model->is_user_registered($workshop_id, $student_id)) {
            $this->session->set_flashdata('error', 'You are already registered for this workshop.');
            redirect('student/workshops/detail/' . $workshop_id);
        }

        // Check if workshop has reached max participants
        if ($workshop->max_participants > 0) {
            $current_participants = $this->Workshop_model->get_participants($workshop_id);
            if (count($current_participants) >= $workshop->max_participants) {
                $this->session->set_flashdata('error', 'This workshop has reached maximum capacity.');
                redirect('student/workshops/detail/' . $workshop_id);
            }
        }

        // Register the student
        $registration_id = $this->Workshop_model->register_participant($workshop_id, $student_id);

        if ($registration_id) {
            $this->session->set_flashdata('success', 'Successfully registered for the workshop!');
            redirect('student/workshops/success/' . $workshop_id);
        } else {
            $this->session->set_flashdata('error', 'Failed to register for the workshop. Please try again.');
            redirect('student/workshops/detail/' . $workshop_id);
        }
    }

    public function success($workshop_id) {
        // Validate workshop exists
        $workshop = $this->Workshop_model->get_workshop($workshop_id);
        if (!$workshop) {
            show_404();
        }

        $student_id = $this->session->userdata('user_id');

        // Verify user is actually registered
        $registration = $this->Workshop_model->is_user_registered($workshop_id, $student_id);
        if (!$registration) {
            $this->session->set_flashdata('error', 'You are not registered for this workshop.');
            redirect('student/workshops/detail/' . $workshop_id);
        }

        $data['workshop'] = $workshop;
        $data['title'] = 'Registration Successful';

        $this->load->view('templates/header', $data);
        $this->load->view('student/workshop_success', $data);
        $this->load->view('templates/footer');
    }
}
