<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher_workshop_guests extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Workshop_model', 'workshop_model');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('permission');

        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        // Check if user has teacher role
        $role = $this->session->userdata('role');
        if (!in_array($role, ['guru', 'admin', 'super_admin'])) {
            show_error('Access denied. Teacher role required.', 403);
        }
    }

    public function index()
    {
        // Get all published workshops
        $data['workshops'] = $this->workshop_model->get_all_workshops();

        // Get total guest count
        $this->db->select('COUNT(*) as total_guests');
        $data['total_guests'] = $this->db->get('workshop_guests')->row()->total_guests;

        $data['title'] = 'Workshop Guest Management - Teacher';
        $data['is_teacher'] = true; // Flag untuk view
        
        $this->load->view('admin/workshop_guests/index', $data);
    }

    public function workshop_guests($workshop_id)
    {
        // Get workshop details
        $data['workshop'] = $this->workshop_model->get_workshop($workshop_id);

        if (!$data['workshop']) {
            show_404();
        }

        // Get guests for this workshop
        $data['guests'] = $this->workshop_model->get_workshop_guests($workshop_id);

        // Get statistics
        $data['statistics'] = $this->workshop_model->get_guest_statistics($workshop_id);

        $data['title'] = 'Workshop Guests - ' . $data['workshop']->title;
        $data['is_teacher'] = true; // Flag untuk view
        $data['user_role'] = $this->session->userdata('role'); // Pass role ke view
        
        $this->load->view('admin/workshop_guests/workshop_guests', $data);
    }

    // Teacher cannot export - redirect to workshop guests page
    public function export_guests($workshop_id)
    {
        $this->session->set_flashdata('error', 'Akses ditolak. Hanya admin yang dapat mengekspor data.');
        redirect('teacher/workshop-guests/workshop/' . $workshop_id);
    }

    // Teacher cannot delete - return error
    public function delete_guest($guest_id)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        echo json_encode([
            'success' => false, 
            'message' => 'Akses ditolak. Hanya admin yang dapat menghapus peserta.'
        ]);
    }
}

