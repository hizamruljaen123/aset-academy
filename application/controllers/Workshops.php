<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workshops extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Workshop_model', 'workshop_model');
        $this->load->helper('url');
    }

    public function index()
    {
        // Get all published workshops and seminars
        $data['workshops'] = $this->workshop_model->get_all_workshops();
        $data['title'] = 'Workshop & Seminar - Aset Academy';
        $data['description'] = 'Jelajahi berbagai workshop dan seminar programming berkualitas untuk meningkatkan kemampuan Anda.';

        $this->load->view('home/workshop_list', $data);
    }

    public function detail($id = null)
    {
        if (!$id || !is_numeric($id)) {
            show_404();
        }

        // Get workshop by ID
        $workshop = $this->workshop_model->get_workshop($id);

        if (!$workshop) {
            show_404();
        }

        if ($workshop->status != 'published') {
            show_error('Workshop/Seminar ini belum dipublikasikan', 403);
        }

        // Get workshop materials
        $materials = $this->workshop_model->get_materials($workshop->id);

        // Get workshop participants count
        $participants = $this->workshop_model->get_participants($workshop->id);
        $participant_count = count($participants);

        // Check if user is logged in and registered
        $is_registered = false;
        $user_id = $this->session->userdata('user_id');
        if ($user_id) {
            $registration = $this->workshop_model->is_user_registered($workshop->id, $user_id);
            $is_registered = $registration ? true : false;
        }

        $data['workshop'] = $workshop;
        $data['materials'] = $materials;
        $data['participant_count'] = $participant_count;
        $data['is_registered'] = $is_registered;
        $data['max_participants'] = $workshop->max_participants;
        $data['title'] = $workshop->title . ' - Aset Academy';
        $data['description'] = 'Detail lengkap ' . strtolower($workshop->type) . ': ' . $workshop->title . '. ' . $workshop->description;

        $this->load->view('home/workshop_detail', $data);
    }

    public function register($id = null)
    {
        if (!$id || !is_numeric($id)) {
            show_404();
        }

        // Get workshop by ID
        $workshop = $this->workshop_model->get_workshop($id);

        if (!$workshop) {
            show_404();
        }

        if ($workshop->status != 'published') {
            show_error('Workshop/Seminar ini belum dipublikasikan', 403);
        }

        // Check if user is logged in
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu untuk mendaftar workshop/seminar.');
            redirect('auth/login?redirect=workshops/detail/' . $id);
        }

        // Check if already registered
        $existing_registration = $this->workshop_model->is_user_registered($workshop->id, $user_id);
        if ($existing_registration) {
            $this->session->set_flashdata('error', 'Anda sudah terdaftar untuk workshop/seminar ini.');
            redirect('workshops/detail/' . $id);
        }

        // Check participant limit
        $participants = $this->workshop_model->get_participants($workshop->id);
        if ($workshop->max_participants > 0 && count($participants) >= $workshop->max_participants) {
            $this->session->set_flashdata('error', 'Maaf, workshop/seminar ini sudah penuh.');
            redirect('workshops/detail/' . $id);
        }

        // Register participant
        $registration_id = $this->workshop_model->register_participant($workshop->id, $user_id);

        if ($registration_id) {
            $this->session->set_flashdata('success', 'Berhasil mendaftar untuk workshop/seminar ini!');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.');
        }

        redirect('workshops/detail/' . $id);
    }

    public function register_guest($id = null)
    {
        if (!$id || !is_numeric($id)) {
            show_404();
        }

        // Get workshop by ID
        $workshop = $this->workshop_model->get_workshop($id);

        if (!$workshop) {
            show_404();
        }

        if ($workshop->status != 'published') {
            show_error('Workshop/Seminar ini belum dipublikasikan', 403);
        }

        // Validate form data
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim|max_length[255]');
        $this->form_validation->set_rules('asal_kampus_sekolah', 'Asal Kampus/Sekolah', 'required|trim|max_length[255]');
        $this->form_validation->set_rules('usia', 'Usia', 'required|numeric|greater_than[10]|less_than[100]');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');
        $this->form_validation->set_rules('province_id', 'Provinsi', 'trim|max_length[2]');
        $this->form_validation->set_rules('regency_id', 'Kabupaten/Kota', 'trim|max_length[4]');
        $this->form_validation->set_rules('district_id', 'Kecamatan', 'trim|max_length[6]');
        $this->form_validation->set_rules('no_wa_telegram', 'No. WhatsApp/Telegram', 'required|trim|max_length[20]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('workshops/detail/' . $id . '#guest-registration');
        }

        $guest_data = [
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'asal_kampus_sekolah' => $this->input->post('asal_kampus_sekolah'),
            'usia' => $this->input->post('usia'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'province_id' => $this->input->post('province_id'),
            'regency_id' => $this->input->post('regency_id'),
            'district_id' => $this->input->post('district_id'),
            'no_wa_telegram' => $this->input->post('no_wa_telegram')
        ];

        // Check if guest is already registered
        $existing_guest = $this->workshop_model->is_guest_registered($id, $guest_data['no_wa_telegram']);
        if ($existing_guest) {
            $this->session->set_flashdata('error', 'Nomor WhatsApp/Telegram ini sudah terdaftar untuk workshop ini.');
            redirect('workshops/detail/' . $id . '#guest-registration');
        }

        // Register guest
        $guest_id = $this->workshop_model->register_guest($id, $guest_data);

        if ($guest_id) {
            // Redirect to success page with guest ID
            redirect('workshops/guest_success/' . $guest_id);
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.');
            redirect('workshops/detail/' . $id . '#guest-registration');
        }
    }

    public function guest_success($guest_id = null)
    {
        if (!$guest_id || !is_numeric($guest_id)) {
            show_404();
        }

        $guest = $this->workshop_model->get_guest_registration($guest_id);

        if (!$guest) {
            show_404();
        }

        $workshop = $this->workshop_model->get_workshop($guest->workshop_id);

        $data['guest'] = $guest;
        $data['workshop'] = $workshop;
        $data['title'] = 'Pendaftaran Berhasil - Aset Academy';
        $data['description'] = 'Selamat! Anda telah berhasil mendaftar workshop ' . $workshop->title;

        $this->load->view('home/workshop_guest_success', $data);
    }

    // AJAX methods for regional data
    public function get_provinces()
    {
        $provinces = $this->workshop_model->get_provinces();
        echo json_encode($provinces);
    }

    public function get_regencies($province_id = null)
    {
        if (!$province_id) {
            echo json_encode([]);
            return;
        }

        $regencies = $this->workshop_model->get_regencies($province_id);
        echo json_encode($regencies);
    }

    public function get_districts($regency_id = null)
    {
        if (!$regency_id) {
            echo json_encode([]);
            return;
        }

        $districts = $this->workshop_model->get_districts($regency_id);
        echo json_encode($districts);
    }
}
