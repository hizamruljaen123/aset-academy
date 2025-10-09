<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Siswa_model');
        $this->load->model('User_model');
        $this->load->model('Settings_model', 'settings_model');
        $this->load->library('Permission');
        
        // Check if user is logged in and has admin access
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        
        if (!$this->permission->is_admin()) {
            show_error('Access denied. Admin role required.', 403);
        }
    }

    public function index()
    {
        // Load necessary models
        $this->load->model('Statistics_model');
        
        // Basic Stats
        $totalRevenue = $this->Statistics_model->get_total_revenue();
        $data['stats'] = [
            // User Stats
            'total_users' => $this->Statistics_model->get_total_users(),
            'active_users' => $this->db->where('status', 'Aktif')->count_all_results('users'),
            'new_users_today' => $this->db->where('DATE(created_at)', date('Y-m-d'))->count_all_results('users'),
            'total_teachers' => $this->db->where('role', 'guru')->count_all_results('users'),

            // Course Stats
            'total_kelas' => $this->db->count_all('kelas_programming'),
            'kelas_aktif' => $this->db->where('status', 'Aktif')->count_all_results('kelas_programming'),
            'total_free_classes' => $this->db->count_all('free_classes'),
            'active_free_classes' => $this->db->where('status', 'Published')->count_all_results('free_classes'),

            // Student Stats
            'total_siswa' => $this->db->count_all('siswa'),
            'siswa_aktif' => $this->db->where('status', 'Aktif')->count_all_results('siswa'),
            'total_premium_enrollments' => $this->Statistics_model->get_total_premium_enrollments(),
            'total_free_enrollments' => $this->Statistics_model->get_total_free_enrollments(),

            // Financial Stats
            'total_payments' => $this->db->count_all('payments'),
            'pending_payments' => $this->db->where('status', 'Pending')->count_all_results('payments'),
            'verified_payments' => $this->db->where('status', 'Verified')->count_all_results('payments'),
            'revenue' => $totalRevenue,
            'total_revenue' => $totalRevenue,
            'monthly_revenue' => $this->db->select_sum('amount')
                                        ->where('status', 'Verified')
                                        ->where('MONTH(created_at)', date('m'))
                                        ->where('YEAR(created_at)', date('Y'))
                                        ->get('payments')
                                        ->row()->amount ?? 0,

            // Content Stats
            'total_materi' => $this->db->count_all('materi'),
            'total_workshops' => $this->db->count_all('workshops'),
            'upcoming_workshops' => $this->db->where('start_datetime >', date('Y-m-d H:i:s'))
                                           ->count_all_results('workshops')
        ];
        
        // Charts Data
        $user_growth = $this->Statistics_model->get_user_growth_data(30);
        $data['chart_labels'] = json_encode(array_column($user_growth, 'date'));
        $data['chart_data'] = json_encode(array_column($user_growth, 'count'));
        
        // Revenue trend
        $rev_rows = $this->Statistics_model->get_revenue_trend(30);
        $data['rev_labels'] = json_encode(array_column($rev_rows, 'date'));
        $data['rev_values'] = json_encode(array_map('floatval', array_column($rev_rows, 'total')));
        
        // Enrollments trend
        $prem_rows = $this->Statistics_model->get_premium_enrollments_trend(30);
        $free_rows = $this->Statistics_model->get_free_enrollments_trend(30);
        
        // Build unified date set for enrollments
        $dates = [];
        foreach ($prem_rows as $r) { $dates[$r['date']] = true; }
        foreach ($free_rows as $r) { $dates[$r['date']] = true; }
        $dates = array_keys($dates);
        sort($dates);
        
        $prem_map = [];
        foreach ($prem_rows as $r) { $prem_map[$r['date']] = (int)$r['count']; }
        $free_map = [];
        foreach ($free_rows as $r) { $free_map[$r['date']] = (int)$r['count']; }
        
        $prem_data = [];
        $free_data = [];
        foreach ($dates as $date) {
            $prem_data[] = $prem_map[$date] ?? 0;
            $free_data[] = $free_map[$date] ?? 0;
        }
        
        $data['enroll_dates'] = json_encode($dates);
        $data['prem_enroll_data'] = json_encode($prem_data);
        $data['free_enroll_data'] = json_encode($free_data);
        
        // Recent Activities
        $data['recent_kelas'] = $this->db->order_by('created_at', 'DESC')
                                        ->limit(5)
                                        ->get('kelas_programming')
                                        ->result();
        
        $data['recent_siswa'] = $this->db->order_by('created_at', 'DESC')
                                       ->limit(5)
                                       ->get('siswa')
                                       ->result();
        
        $data['recent_payments'] = $this->db->select('p.*, u.nama_lengkap as student_name, kp.nama_kelas as class_name')
                                          ->from('payments p')
                                          ->join('users u', 'p.user_id = u.id')
                                          ->join('kelas_programming kp', 'p.class_id = kp.id')
                                          ->order_by('p.created_at', 'DESC')
                                          ->limit(5)
                                          ->get()
                                          ->result();
        
        // Distribution Data
        $data['jurusan_dist'] = $this->Siswa_model->get_jurusan_distribution();
        $data['class_dist'] = $this->Statistics_model->get_class_distribution();
        
        // Teacher stats
        $this->db->where('role', 'guru');
        $data['total_teachers'] = $this->db->count_all_results('users');
        
        $this->db->where('role', 'guru');
        $this->db->where('status', 'Aktif');
        $data['active_teachers'] = $this->db->count_all_results('users');

        $data['title'] = 'Dashboard';
        $data['maintenance_mode'] = $this->settings_model->is_maintenance_mode();
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }
}
