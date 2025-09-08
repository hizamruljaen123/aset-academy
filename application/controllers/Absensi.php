<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Absensi_model');
        $this->load->library('session');

        // Cek apakah user sudah login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['title'] = 'Data Absensi Siswa';
        $role = $this->session->userdata('role');
        $user_id = $this->session->userdata('id');

        if ($role == 'super_admin' || $role == 'admin') {
            $data['absensi'] = $this->Absensi_model->get_all_absensi();
        } elseif ($role == 'guru') {
            $data['absensi'] = $this->Absensi_model->get_absensi_for_user($user_id, $role);
        } elseif ($role == 'siswa') {
            $this->load->model('Siswa_model');
            $email = $this->session->userdata('email');
            $siswa = $this->Siswa_model->get_siswa_by_email($email);
            if ($siswa) {
                $data['absensi'] = $this->Absensi_model->get_absensi_for_user($siswa->id, $role);
            } else {
                $data['absensi'] = []; // No student data found for this user
            }
        } else {
            $data['absensi'] = []; // No role matched
        }

        $this->load->view('templates/header', $data);
        if ($role == 'siswa') {
            $this->load->view('siswa/absensi_calendar', $data);
        } else {
            $this->load->view('admin/absensi/index', $data);
        }
        $this->load->view('templates/footer');
    }
}
