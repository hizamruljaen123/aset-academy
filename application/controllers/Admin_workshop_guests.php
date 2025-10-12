<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_workshop_guests extends CI_Controller {

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

        // Check if user has permission to access workshop guests
        // Allow super_admin, admin, and guru to access without specific permission check
        $role = $this->session->userdata('role');
        $level = $this->session->userdata('level');

        if (!in_array($role, ['super_admin', 'admin', 'guru']) &&
            !in_array($level, ['1', '2', '3'])) {
            show_error('Access denied. You do not have permission to access this page.', 403);
        }
    }

    public function index()
    {
        // Get all published workshops
        $data['workshops'] = $this->workshop_model->get_all_workshops();

        // Get total guest count
        $this->db->select('COUNT(*) as total_guests');
        $data['total_guests'] = $this->db->get('workshop_guests')->row()->total_guests;

        $data['title'] = 'Workshop Guest Management - Admin';
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
        $data['is_teacher'] = false; // Admin has full access
        $data['user_role'] = $this->session->userdata('role'); // Pass role ke view
        
        $this->load->view('admin/workshop_guests/workshop_guests', $data);
    }

    public function export_guests($workshop_id)
    {
        // Get workshop details
        $workshop = $this->workshop_model->get_workshop($workshop_id);

        if (!$workshop) {
            show_404();
        }

        // Get guests for this workshop
        $guests = $this->workshop_model->get_workshop_guests($workshop_id);

        // Set headers for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="workshop_guests_' . $workshop->slug . '.csv"');

        // Create CSV content
        $output = fopen('php://output', 'w');

        // CSV headers
        fputcsv($output, [
            'No',
            'Nama Lengkap',
            'Asal Kampus/Sekolah',
            'Usia',
            'Pekerjaan',
            'No. WhatsApp/Telegram',
            'Tanggal Daftar'
        ]);

        // CSV data
        $no = 1;
        foreach ($guests as $guest) {
            fputcsv($output, [
                $no++,
                $guest->nama_lengkap,
                $guest->asal_kampus_sekolah,
                $guest->usia,
                $guest->pekerjaan,
                $guest->no_wa_telegram,
                date('d/m/Y H:i', strtotime($guest->registered_at))
            ]);
        }

        fclose($output);
    }

    public function delete_guest($guest_id)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $this->db->where('id', $guest_id);
        $deleted = $this->db->delete('workshop_guests');

        if ($deleted) {
            echo json_encode(['success' => true, 'message' => 'Guest berhasil dihapus']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menghapus guest']);
        }
    }
}
