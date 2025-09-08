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
        
        // Cek apakah user sudah login, jika belum redirect ke login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        
        // Cek role user
        if ($this->session->userdata('role') != 'admin') {
            redirect('auth/login');
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
        $data['materi'] = $this->Materi_model->get_materi_with_parts_by_kelas($id);

        if (empty($data['kelas'])) {
            show_404();
        }

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