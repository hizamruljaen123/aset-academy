<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Siswa_model');
        $this->load->model('User_model');
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
        $data['stats'] = [
            'total_kelas'   => $this->db->count_all('kelas_programming'),
            'total_materi'  => $this->db->count_all('materi'),
            'total_siswa'   => $this->db->count_all('siswa'),
            'total_users'   => $this->User_model->count_all(),
            'kelas_aktif'   => $this->db->where('status', 'Aktif')->count_all_results('kelas_programming'),
            'siswa_aktif'   => $this->db->where('status', 'Aktif')->count_all_results('siswa'),
        ];

        $data['recent_kelas'] = $this->db->order_by('created_at', 'DESC')->limit(5)->get('kelas_programming')->result();
        $data['recent_siswa'] = $this->db->order_by('created_at', 'DESC')->limit(5)->get('siswa')->result();
        $data['jurusan_dist'] = $this->Siswa_model->get_jurusan_distribution();
        
        // Get teacher stats for admin dashboard
        $this->db->where('role', 'guru');
        $data['total_teachers'] = $this->db->count_all_results('users');
        
        $this->db->where('role', 'guru');
        $this->db->where('status', 'Aktif');
        $data['active_teachers'] = $this->db->count_all_results('users');

        $data['title'] = 'Dashboard';
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }
}
