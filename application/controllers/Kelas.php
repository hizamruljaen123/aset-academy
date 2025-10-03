<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kelas_model');
        $this->load->model('Materi_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        
        // Daftar method yang dapat diakses publik tanpa perlu login
        $public_methods = ['detail', 'by_level', 'by_bahasa'];
        $current_method = $this->router->fetch_method();

        // Jika method yang diakses tidak termasuk yang publik, lakukan pengecekan login & role admin
        if (!in_array($current_method, $public_methods)) {
            if (!$this->session->userdata('logged_in')) {
                redirect('auth/login');
            }
            // Allow admin and super_admin roles
            $allowed_roles = ['admin', 'super_admin'];
            if (!in_array($this->session->userdata('role'), $allowed_roles)) {
                redirect('dashboard');
            }
        }
    }

    // Menampilkan daftar kelas
    public function index()
    {
        $data['title'] = 'Daftar Kelas Programming';
        $data['kelas'] = $this->Kelas_model->get_all_kelas();
        
        $this->load->view('templates/header', $data);
        $this->load->view('kelas/index', $data);
        $this->load->view('templates/footer');
    }

    // Menampilkan form tambah kelas
    public function create()
    {
        $data['title'] = 'Tambah Kelas Programming';
        
        $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required|trim|is_unique[kelas_programming.nama_kelas]', [
            'required' => 'Nama kelas harus diisi',
            'is_unique' => 'Nama kelas sudah terdaftar'
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('level', 'Level', 'required|trim');
        $this->form_validation->set_rules('bahasa_program', 'Bahasa Program', 'required|trim');
        $this->form_validation->set_rules('durasi', 'Durasi', 'required|trim|numeric');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim|numeric');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        $this->form_validation->set_rules('online_meet_link', 'Link Belajar Online', 'trim|valid_url');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('kelas/create', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama_kelas' => $this->input->post('nama_kelas'),
                'deskripsi' => $this->input->post('deskripsi'),
                'level' => $this->input->post('level'),
                'bahasa_program' => $this->input->post('bahasa_program'),
                'durasi' => $this->input->post('durasi'),
                'harga' => $this->input->post('harga'),
                'status' => $this->input->post('status'),
                'online_meet_link' => $this->input->post('online_meet_link')
            ];

            $this->Kelas_model->insert_kelas($data);
            $this->session->set_flashdata('success', 'Data kelas berhasil ditambahkan');
            redirect('kelas');
        }
    }

    // Menampilkan form edit kelas
    public function edit($id)
    {
        $data['title'] = 'Edit Kelas Programming';
        $data['kelas'] = $this->Kelas_model->get_kelas_by_id($id);
        
        if (empty($data['kelas'])) {
            show_404();
        }

        $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required|trim', [
            'required' => 'Nama kelas harus diisi'
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('level', 'Level', 'required|trim');
        $this->form_validation->set_rules('bahasa_program', 'Bahasa Program', 'required|trim');
        $this->form_validation->set_rules('durasi', 'Durasi', 'required|trim|numeric');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim|numeric');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        $this->form_validation->set_rules('online_meet_link', 'Link Belajar Online', 'trim|valid_url');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('kelas/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama_kelas' => $this->input->post('nama_kelas'),
                'deskripsi' => $this->input->post('deskripsi'),
                'level' => $this->input->post('level'),
                'bahasa_program' => $this->input->post('bahasa_program'),
                'durasi' => $this->input->post('durasi'),
                'harga' => $this->input->post('harga'),
                'status' => $this->input->post('status'),
                'online_meet_link' => $this->input->post('online_meet_link')
            ];

            $this->Kelas_model->update_kelas($id, $data);
            $this->session->set_flashdata('success', 'Data kelas berhasil diupdate');
            redirect('kelas');
        }
    }

    // Menghapus data kelas
    public function delete($id)
    {
        $kelas = $this->Kelas_model->get_kelas_by_id($id);
        
        if (empty($kelas)) {
            show_404();
        }

        $this->Kelas_model->delete_kelas($id);
        $this->session->set_flashdata('success', 'Data kelas berhasil dihapus');
        redirect('kelas');
    }

    // Menampilkan detail kelas
    public function detail($id)
    {
        $data['title'] = 'Detail Kelas';
        $data['kelas'] = $this->Kelas_model->get_kelas_by_id($id);
    
        if (empty($data['kelas'])) {
            show_404();
        }
    
        $user_id = $this->session->userdata('user_id');
        $data['is_enrolled'] = false;
    
        if ($user_id) {
            $this->load->model('Enrollment_model');
            $data['is_enrolled'] = $this->Enrollment_model->is_enrolled($user_id, $id);
        }
    
        // Hanya tampilkan data sensitif jika pengguna adalah admin
        $is_admin = in_array($this->session->userdata('role'), ['admin', 'super_admin']);
    
        if ($is_admin) {
            $data['materi'] = $this->Materi_model->get_materi_with_parts_by_kelas($id);
            
            $this->load->model('Jadwal_model');
            $jadwal_objects = $this->Jadwal_model->get_jadwal_by_kelas($id);
            $data['jadwal'] = array_map(function($j) { return (array) $j; }, $jadwal_objects);

            $this->load->model('Absensi_model');
            $data['attendance_stats'] = $this->Absensi_model->get_attendance_stats_by_class($id);
            $data['student_progress'] = $this->Kelas_model->get_student_progress($id);
        } else if ($data['is_enrolled']) {
            $data['materi'] = $this->Materi_model->get_materi_with_parts_by_kelas($id);
            
            $this->load->model('Jadwal_model');
            $jadwal_objects = $this->Jadwal_model->get_jadwal_by_kelas($id);
            $data['jadwal'] = array_map(function($j) { return (array) $j; }, $jadwal_objects);

            // For enrolled students, attendance stats and progress are not shown
            $data['attendance_stats'] = ['Hadir' => 0, 'Sakit' => 0, 'Izin' => 0, 'Alpa' => 0];
            $data['student_progress'] = [];

            $data['teachers'] = $this->Kelas_model->get_teachers_by_kelas($id);
        }
        else {
            $data['materi'] = [];
            $data['jadwal'] = [];
            $data['attendance_stats'] = ['Hadir' => 0, 'Sakit' => 0, 'Izin' => 0, 'Alpa' => 0];
            $data['student_progress'] = [];
            $data['teachers'] = [];
        }
        $data['is_admin'] = $is_admin;
    
        $this->load->view('templates/header', $data);
        $this->load->view('kelas/detail', $data);
        $this->load->view('templates/footer');
    }

    // Menampilkan kelas berdasarkan level
    public function by_level($level)
    {
        $data['title'] = 'Kelas ' . $level;
        $data['kelas'] = $this->Kelas_model->get_kelas_by_level($level);
        $data['level'] = $level;
        
        $this->load->view('templates/header', $data);
        $this->load->view('kelas/by_level', $data);
        $this->load->view('templates/footer');
    }

    // Menampilkan kelas berdasarkan bahasa program
    public function by_bahasa($bahasa)
    {
        $data['title'] = 'Kelas ' . $bahasa;
        $data['kelas'] = $this->Kelas_model->get_kelas_by_bahasa($bahasa);
        $data['bahasa'] = $bahasa;
        
        $this->load->view('templates/header', $data);
        $this->load->view('kelas/by_bahasa', $data);
        $this->load->view('templates/footer');
    }
}
?>