<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Guru_model');
        $this->load->model('Siswa_model');
        $this->load->model('Materi_model');
        $this->load->library('Permission');
        
        // Check if user is logged in and has teacher role
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        
        if (!$this->permission->is_teacher()) {
            show_error('Access denied. Teacher role required.', 403);
        }
    }

    public function index()
    {
        $guru_id = $this->session->userdata('user_id');
        
        $data['stats'] = $this->Guru_model->get_guru_stats($guru_id);
        $data['kelas'] = $this->Guru_model->get_guru_kelas($guru_id);
        $data['recent_siswa'] = array_slice($this->Guru_model->get_guru_siswa($guru_id), 0, 5);
        $data['recent_materi'] = array_slice($this->Guru_model->get_guru_materi($guru_id), 0, 5);
        
        $data['title'] = 'Dashboard Guru';
        $this->load->view('templates/header', $data);
        $this->load->view('teacher/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function kelas()
    {
        $guru_id = $this->session->userdata('user_id');
        $data['kelas'] = $this->Guru_model->get_guru_kelas($guru_id);
        
        $data['title'] = 'Kelas Saya';
        $this->load->view('templates/header', $data);
        $this->load->view('teacher/kelas', $data);
        $this->load->view('templates/footer');
    }

    public function siswa()
    {
        $guru_id = $this->session->userdata('user_id');
        $data['siswa'] = $this->Guru_model->get_guru_siswa($guru_id);
        
        $data['title'] = 'Siswa Saya';
        $this->load->view('templates/header', $data);
        $this->load->view('teacher/siswa', $data);
        $this->load->view('templates/footer');
    }

    public function materi()
    {
        $guru_id = $this->session->userdata('user_id');
        $data['materi'] = $this->Guru_model->get_guru_materi($guru_id);
        $data['kelas'] = $this->Guru_model->get_guru_kelas($guru_id);
        
        $data['title'] = 'Materi Saya';
        $this->load->view('templates/header', $data);
        $this->load->view('teacher/materi', $data);
        $this->load->view('templates/footer');
    }

    public function materi_detail($id)
    {
        $guru_id = $this->session->userdata('user_id');
        
        // Check if teacher has access to this material
        $this->db->select('m.*, kp.nama_kelas');
        $this->db->from('materi m');
        $this->db->join('kelas_programming kp', 'm.kelas_id = kp.id');
        $this->db->join('guru_kelas gk', 'kp.id = gk.kelas_id');
        $this->db->where('m.id', $id);
        $this->db->where('gk.guru_id', $guru_id);
        $this->db->where('gk.status', 'Aktif');
        $materi = $this->db->get()->row();
        
        if (!$materi) {
            show_error('Materi tidak ditemukan atau Anda tidak memiliki akses.', 404);
        }
        
        // Get materi parts
        $this->db->where('materi_id', $id);
        $this->db->order_by('part_order', 'ASC');
        $data['parts'] = $this->db->get('materi_parts')->result();
        
        $data['materi'] = $materi;
        $data['title'] = 'Detail Materi - ' . $materi->judul;
        $this->load->view('templates/header', $data);
        $this->load->view('teacher/materi_detail', $data);
        $this->load->view('templates/footer');
    }
}
