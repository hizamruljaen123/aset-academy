<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Session_management extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Session_model');
        $this->load->library('session');

        // Check if user is logged in and has admin/super admin access
        if (!$this->session->userdata('logged_in') ||
            !in_array($this->session->userdata('role'), ['admin', 'super_admin'])) {
            redirect('auth/login');
        }
    }

    /**
     * Main session management page
     */
    public function index() {
        $data['title'] = 'Session Management - Aset Academy';
        $data['unique_ips'] = $this->Session_model->get_unique_ips();
        $data['total_unique_ips'] = $this->Session_model->get_unique_ip_count();
        $data['total_sessions'] = $this->Session_model->get_total_sessions();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/sessions/session_management', $data);
        $this->load->view('templates/footer');
    }

    /**
     * AJAX endpoint to delete all sessions
     */
    public function delete_all_sessions() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $deleted_count = $this->Session_model->delete_all_sessions();

        // Also destroy current session to logout user
        $this->session->sess_destroy();

        echo json_encode([
            'success' => true,
            'message' => "Berhasil menghapus {$deleted_count} session",
            'redirect' => base_url('auth/login')
        ]);
    }

    /**
     * AJAX endpoint to delete sessions by IP
     */
    public function delete_sessions_by_ip() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $ip_address = $this->input->post('ip_address');
        if (empty($ip_address)) {
            echo json_encode(['success' => false, 'message' => 'IP address tidak valid']);
            return;
        }

        $deleted_count = $this->Session_model->delete_sessions_by_ip($ip_address);

        echo json_encode([
            'success' => true,
            'message' => "Berhasil menghapus {$deleted_count} session untuk IP {$ip_address}"
        ]);
    }

    /**
     * AJAX endpoint to get IP information from ip-api.com
     */
    public function get_ip_info() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $ip_address = $this->input->post('ip_address');
        if (empty($ip_address)) {
            echo json_encode(['success' => false, 'message' => 'IP address tidak valid']);
            return;
        }

        // Use curl to fetch IP information
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json/{$ip_address}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code == 200) {
            $ip_data = json_decode($response, true);
            if ($ip_data && $ip_data['status'] == 'success') {
                echo json_encode([
                    'success' => true,
                    'data' => $ip_data
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Tidak dapat mendapatkan informasi IP'
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal mengambil data dari API'
            ]);
        }
    }

    /**
     * AJAX endpoint to cleanup expired sessions
     */
    public function cleanup_expired() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $hours = $this->input->post('hours') ?: 24;
        $deleted_count = $this->Session_model->cleanup_expired_sessions($hours);

        echo json_encode([
            'success' => true,
            'message' => "Berhasil membersihkan {$deleted_count} session yang expired (>{$hours} jam)"
        ]);
    }
}
