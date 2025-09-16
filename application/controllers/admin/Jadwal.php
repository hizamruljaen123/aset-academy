<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jadwal_model');
        $this->load->model('Kelas_model');
        $this->load->library('session');

        // Cek apakah user sudah login dan memiliki role admin
        if (!$this->session->userdata('logged_in') || !in_array($this->session->userdata('role'), ['admin', 'super_admin'])) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['title'] = 'Kelola Jadwal Kelas';
        $data['jadwal'] = $this->Jadwal_model->get_all_jadwal();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/jadwal/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Tambah Jadwal Kelas';
        $data['kelas'] = $this->Kelas_model->get_all_kelas();
        $this->load->model('Guru_model');
        $data['guru'] = $this->Guru_model->get_all_gurus();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/jadwal/create', $data);
        $this->load->view('templates/footer');
    }

    public function store()
    {
        $data = [
            'kelas_id' => $this->input->post('kelas_id'),
            'guru_id' => $this->input->post('guru_id'),
            'pertemuan_ke' => $this->input->post('pertemuan_ke'),
            'judul_pertemuan' => $this->input->post('judul_pertemuan'),
            'tanggal_pertemuan' => $this->input->post('tanggal_pertemuan'),
            'waktu_mulai' => $this->input->post('waktu_mulai'),
            'waktu_selesai' => $this->input->post('waktu_selesai'),
        ];

        $this->Jadwal_model->insert_jadwal($data);
        $this->session->set_flashdata('success', 'Jadwal berhasil ditambahkan.');
        redirect('admin/jadwal');
    }

    public function get_events()
    {
        $events = $this->Jadwal_model->get_all_jadwal();
        $data = [];
        foreach ($events as $event) {
            $data[] = [
                'title' => $event->judul_pertemuan,
                'start' => $event->tanggal_pertemuan . 'T' . $event->waktu_mulai,
                'end' => $event->tanggal_pertemuan . 'T' . $event->waktu_selesai,
                'allDay' => false
            ];
        }
        echo json_encode($data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Jadwal Kelas';
        $data['jadwal'] = $this->Jadwal_model->get_jadwal_by_id($id);
        $data['kelas'] = $this->Kelas_model->get_all_kelas();
        $this->load->model('Guru_model');
        $data['guru'] = $this->Guru_model->get_all_gurus();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/jadwal/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update($id)
    {
        $data = [
            'kelas_id' => $this->input->post('kelas_id'),
            'guru_id' => $this->input->post('guru_id'),
            'pertemuan_ke' => $this->input->post('pertemuan_ke'),
            'judul_pertemuan' => $this->input->post('judul_pertemuan'),
            'tanggal_pertemuan' => $this->input->post('tanggal_pertemuan'),
            'waktu_mulai' => $this->input->post('waktu_mulai'),
            'waktu_selesai' => $this->input->post('waktu_selesai'),
        ];

        $this->Jadwal_model->update_jadwal($id, $data);
        $this->session->set_flashdata('success', 'Jadwal berhasil diupdate.');
        redirect('admin/jadwal');
    }

    public function delete($id)
    {
        $this->Jadwal_model->delete_jadwal($id);
        $this->session->set_flashdata('success', 'Jadwal berhasil dihapus.');
        redirect('admin/jadwal');
    }
}
