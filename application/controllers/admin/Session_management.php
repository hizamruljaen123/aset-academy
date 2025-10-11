<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Session_management extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Session_model');
        $this->load->library('session');
        $this->load->helper('forum'); // Load the forum helper for timespan function

        // Check if user is logged in and has admin/super admin access
        if (!$this->session->userdata('logged_in') ||
            !in_array($this->session->userdata('role'), ['admin', 'super_admin'])) {
            redirect('auth/login');
        }
    }

    /**
     * Main session management page - shows active sessions
     */
    public function index() {
        $data['title'] = 'Session Management - Aset Academy';
        $data['page_title'] = 'Active Sessions Management';
        
        try {
            // Get active sessions with user info
            $data['active_sessions'] = $this->Session_model->get_active_sessions();
            $data['sessions_by_user'] = $this->Session_model->get_sessions_by_user();
            $data['unique_ips'] = $this->Session_model->get_unique_ips();
            
            // Get statistics
            $data['statistics'] = $this->Session_model->get_session_statistics();
            $data['total_unique_ips'] = $this->Session_model->get_unique_ip_count();
            $data['total_sessions'] = $this->Session_model->get_total_sessions();
            $data['logged_in_users'] = $this->Session_model->get_logged_in_users_count();
            $data['guest_sessions'] = $this->Session_model->get_guest_sessions_count();
            
            // Get or generate location cache
            $data['location_cache'] = $this->get_location_cache();
        } catch (Exception $e) {
            // Log error
            log_message('error', 'Session Management Error: ' . $e->getMessage());
            
            // Set default values if error occurs
            $data['active_sessions'] = [];
            $data['sessions_by_user'] = [];
            $data['unique_ips'] = [];
            $data['statistics'] = (object)[
                'today_logins' => 0,
                'avg_session_duration' => 0,
                'most_active_users' => []
            ];
            $data['total_unique_ips'] = 0;
            $data['total_sessions'] = 0;
            $data['logged_in_users'] = 0;
            $data['guest_sessions'] = 0;
            $data['location_cache'] = [];
            
            // Show error message
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat memuat data session. Silakan refresh halaman.');
        }

        $this->load->view('templates/header', $data);
        $this->load->view('admin/sessions/session_management', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Get location cache from file or generate new one
     */
    private function get_location_cache() {
        $cache_file = FCPATH . 'assets/tmp/session_locations.json';
        $cache_duration = 3600; // 1 hour
        
        // Create tmp directory if not exists
        $tmp_dir = FCPATH . 'assets/tmp';
        if (!is_dir($tmp_dir)) {
            mkdir($tmp_dir, 0755, true);
        }
        
        // Check if cache exists and is valid
        if (file_exists($cache_file)) {
            $cache_age = time() - filemtime($cache_file);
            if ($cache_age < $cache_duration) {
                // Cache is still valid
                $cache_content = file_get_contents($cache_file);
                return json_decode($cache_content, true);
            }
        }
        
        // Generate new cache
        return ['status' => 'empty', 'data' => [], 'timestamp' => time()];
    }
    
    /**
     * AJAX endpoint to fetch and cache IP locations
     */
    public function fetch_locations() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        
        $ip_address = $this->input->post('ip_address');
        
        if (!$ip_address) {
            echo json_encode(['success' => false, 'message' => 'IP address required']);
            return;
        }
        
        // Fetch from IP API
        $api_url = "http://ip-api.com/json/{$ip_address}";
        $response = @file_get_contents($api_url);
        
        if ($response) {
            $data = json_decode($response, true);
            
            if ($data && $data['status'] === 'success') {
                // Save to cache
                $this->update_location_cache($ip_address, $data);
                
                echo json_encode([
                    'success' => true,
                    'data' => $data
                ]);
                return;
            }
        }
        
        echo json_encode(['success' => false, 'message' => 'Failed to fetch location']);
    }
    
    /**
     * Update location cache file
     */
    private function update_location_cache($ip_address, $location_data) {
        $cache_file = FCPATH . 'assets/tmp/session_locations.json';
        
        // Load existing cache
        $cache = [];
        if (file_exists($cache_file)) {
            $cache_content = file_get_contents($cache_file);
            $cache = json_decode($cache_content, true);
            if (!is_array($cache)) {
                $cache = [];
            }
        }
        
        // Update cache
        $cache[$ip_address] = [
            'data' => $location_data,
            'timestamp' => time()
        ];
        
        // Save cache
        file_put_contents($cache_file, json_encode($cache, JSON_PRETTY_PRINT));
    }
    
    /**
     * Get cached location for an IP
     */
    public function get_cached_location() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        
        $ip_address = $this->input->post('ip_address');
        
        if (!$ip_address) {
            echo json_encode(['success' => false, 'message' => 'IP address required']);
            return;
        }
        
        $cache_file = FCPATH . 'assets/tmp/session_locations.json';
        
        if (file_exists($cache_file)) {
            $cache_content = file_get_contents($cache_file);
            $cache = json_decode($cache_content, true);
            
            if (isset($cache[$ip_address])) {
                $cache_age = time() - $cache[$ip_address]['timestamp'];
                
                // Cache valid for 1 hour
                if ($cache_age < 3600) {
                    echo json_encode([
                        'success' => true,
                        'cached' => true,
                        'data' => $cache[$ip_address]['data']
                    ]);
                    return;
                }
            }
        }
        
        echo json_encode(['success' => false, 'cached' => false]);
    }

    /**
     * Session history/logs page
     */
    public function history() {
        $data['title'] = 'Session History - Aset Academy';
        $data['page_title'] = 'Session History & Logs';
        
        // Get filters from query string
        $filters = [
            'user_id' => $this->input->get('user_id'),
            'ip_address' => $this->input->get('ip_address'),
            'logout_type' => $this->input->get('logout_type'),
            'date_from' => $this->input->get('date_from'),
            'date_to' => $this->input->get('date_to')
        ];
        
        // Pagination
        $limit = 50;
        $offset = ($this->input->get('page') ? ($this->input->get('page') - 1) * $limit : 0);
        
        $data['session_logs'] = $this->Session_model->get_session_logs($filters, $limit, $offset);
        $data['filters'] = $filters;
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/sessions/session_history', $data);
        $this->load->view('templates/footer');
    }

    /**
     * View session details for a specific user
     */
    public function user_sessions($user_id) {
        if (!$user_id || !is_numeric($user_id)) {
            show_404();
        }
        
        $data['title'] = 'User Sessions - Aset Academy';
        $data['user_id'] = $user_id;
        $data['user_sessions'] = $this->Session_model->get_sessions_by_user_id($user_id);
        
        // Get user info
        $this->load->model('Users_model');
        $data['user'] = $this->Users_model->get_user_by_id($user_id);
        
        if (!$data['user']) {
            show_404();
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/sessions/user_sessions', $data);
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
     * AJAX endpoint to delete sessions by user
     */
    public function delete_sessions_by_user() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $user_id = $this->input->post('user_id');
        if (empty($user_id) || !is_numeric($user_id)) {
            echo json_encode(['success' => false, 'message' => 'User ID tidak valid']);
            return;
        }

        $deleted_count = $this->Session_model->delete_sessions_by_user($user_id);

        echo json_encode([
            'success' => true,
            'message' => "Berhasil menghapus {$deleted_count} session untuk user ID {$user_id}"
        ]);
    }

    /**
     * AJAX endpoint to delete specific session
     */
    public function delete_session() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $session_id = $this->input->post('session_id');
        if (empty($session_id)) {
            echo json_encode(['success' => false, 'message' => 'Session ID tidak valid']);
            return;
        }

        $deleted_count = $this->Session_model->delete_session_by_id($session_id);

        echo json_encode([
            'success' => true,
            'message' => "Berhasil menghapus session"
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
     * AJAX endpoint to get session details for history view
     */
    public function get_session_details($session_id) {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $this->db->select('sl.*, u.username, u.nama_lengkap, u.email, u.role');
        $this->db->from('session_logs sl');
        $this->db->join('users u', 'sl.user_id = u.id', 'left');
        $this->db->where('sl.session_id', $session_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $session = $query->row();
            echo json_encode([
                'success' => true,
                'session' => $session
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Session not found'
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

        $hours = $this->input->post('hours');
        if (empty($hours) || !is_numeric($hours)) {
            echo json_encode(['success' => false, 'message' => 'Jumlah jam tidak valid']);
            return;
        }

        // Calculate timestamp
        $expiry_time = time() - ($hours * 3600);

        // Delete sessions older than specified hours
        $this->db->where('timestamp <', $expiry_time);
        $this->db->delete('ci_sessions');
        
        $deleted_count = $this->db->affected_rows();

        echo json_encode([
            'success' => true,
            'message' => "Berhasil membersihkan {$deleted_count} session yang kadaluarsa (lebih dari {$hours} jam)"
        ]);
    }
}
