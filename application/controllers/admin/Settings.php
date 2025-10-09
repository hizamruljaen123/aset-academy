<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Settings_model', 'settings_model');
        $this->load->library(['form_validation', 'session']);
        $this->load->helper(['url', 'form']);

        // Check if user is admin or super admin
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }

        $role = $this->session->userdata('role');
        $level = $this->session->userdata('level');

        // Allow super admin (level 1) or admin (level 2) to access settings
        if (!in_array($role, ['super_admin', 'admin']) || !in_array($level, ['1', '2'])) {
            redirect('dashboard');
        }
    }

    public function index()
    {
        $data['title'] = 'Pengaturan Sistem - Admin';
        $data['settings'] = $this->settings_model->get_all_settings();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/settings/index', $data);
        $this->load->view('templates/footer');
    }

    public function maintenance_mode()
    {
        if (!$this->input->post()) {
            redirect('admin/settings');
        }

        $this->form_validation->set_rules('maintenance_mode', 'Maintenance Mode', 'required|in_list[true,false]');
        $this->form_validation->set_rules('maintenance_message', 'Maintenance Message', 'trim|max_length[1000]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('error', validation_errors('<div>', '</div>'));
            redirect('admin/settings');
        }

        $maintenance_mode = $this->input->post('maintenance_mode', true) === 'true';
        $maintenance_message = $this->input->post('maintenance_message', true);

        // Update maintenance mode
        if ($maintenance_mode) {
            $this->settings_model->enable_maintenance_mode();
        } else {
            $this->settings_model->disable_maintenance_mode();
        }

        // Update maintenance message if provided
        if (!empty($maintenance_message)) {
            $this->settings_model->set_maintenance_message($maintenance_message);
        }

        $status = $maintenance_mode ? 'diaktifkan' : 'dinonaktifkan';
        $this->session->set_flashdata('success', "Mode maintenance berhasil $status.");

        redirect('admin/settings');
    }

    public function toggle_maintenance()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $current_status = $this->settings_model->is_maintenance_mode();

        if ($current_status) {
            $this->settings_model->disable_maintenance_mode();
            $new_status = false;
            $message = 'Mode maintenance telah dinonaktifkan.';
        } else {
            $this->settings_model->enable_maintenance_mode();
            $new_status = true;
            $message = 'Mode maintenance telah diaktifkan.';
        }

        echo json_encode([
            'success' => true,
            'maintenance_mode' => $new_status,
            'message' => $message
        ]);
    }
}
