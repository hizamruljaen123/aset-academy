<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workshops extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Workshop_model', 'workshop_model');
        $this->load->helper('url');
    }

    public function index()
    {
        // Get all published workshops and seminars
        $workshops = $this->workshop_model->get_all_workshops();

        // Map participant counts from view to each workshop
        $participantCounts = $this->workshop_model->get_participant_counts_for_workshops(array_column($workshops, 'id'));

        foreach ($workshops as &$workshop) {
            $workshopId = $workshop->id;
            $workshop->participant_count = $participantCounts[$workshopId]['total'] ?? 0;
            $workshop->registered_count = $participantCounts[$workshopId]['registered'] ?? 0;
        }
        unset($workshop);

        $data['workshops'] = $workshops;
        $data['title'] = 'Workshop & Seminar - Aset Academy';
        $data['description'] = 'Jelajahi berbagai workshop dan seminar programming berkualitas untuk meningkatkan kemampuan Anda.';

        $this->load->view('home/workshop_list', $data);
    }

    public function detail($encrypted_id = null)
    {
        $id = $this->decrypt_id($encrypted_id, 'Workshop ID');

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

        // Get participant counts (combined members + guests)
        $participant_count = $this->workshop_model->count_all_participants($workshop->id);
        $participants = $this->workshop_model->get_all_participants($workshop->id);

        // Get provinces for dropdown
        $provinces = $this->workshop_model->get_provinces();

        // Check if user is logged in and registered
        $is_registered = false;
        $user_id = $this->session->userdata('user_id');
        if ($user_id) {
            $registration = $this->workshop_model->is_user_registered($workshop->id, $user_id);
            $is_registered = $registration ? true : false;
        }

        $data['workshop'] = $workshop;
        $data['materials'] = $materials;
        $data['participants'] = $participants;
        $data['participant_count'] = $participant_count;
        $data['is_registered'] = $is_registered;
        $data['max_participants'] = $workshop->max_participants;
        $data['provinces'] = $provinces;
        $data['title'] = $workshop->title . ' - Aset Academy';
        $data['description'] = 'Detail lengkap ' . strtolower($workshop->type) . ': ' . $workshop->title . '. ' . $workshop->description;

        $this->load->view('home/workshop_detail', $data);
    }

    public function register($encrypted_id = null)
    {
        $id = $this->decrypt_id($encrypted_id, 'Workshop ID');

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
        $participant_total = $this->workshop_model->count_all_participants($workshop->id);
        if ($workshop->max_participants > 0 && $participant_total >= $workshop->max_participants) {
            $this->session->set_flashdata('error', 'Maaf, workshop/seminar ini sudah penuh.');
            redirect('workshops/detail/' . $id);
        }

        // Register participant
        $registration_id = $this->workshop_model->register_participant($workshop->id, $user_id, [
            'province_id' => $this->input->post('province_id'),
            'regency_id' => $this->input->post('regency_id'),
            'district_id' => $this->input->post('district_id'),
            'village_id' => $this->input->post('village_id')
        ]);

        if ($registration_id) {
            $this->session->set_flashdata('success', 'Berhasil mendaftar untuk workshop/seminar ini!');
            redirect('workshops/workshop_success/' . $this->encrypt_id($id));
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.');
        }

        redirect('workshops/detail/' . $this->encrypt_id($id));
    }

    public function register_guest($encrypted_id = null)
    {
        $id = $this->decrypt_id($encrypted_id, 'Workshop ID');

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
        $this->form_validation->set_rules('village_id', 'Desa/Kelurahan', 'trim|max_length[10]');
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
            'village_id' => $this->input->post('village_id'),
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
            // Redirect to success page with encrypted guest ID
            $encrypted_guest_id = $this->encryption_url->encode($guest_id);
            redirect('workshops/guest_success/' . $encrypted_guest_id);
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.');
            redirect('workshops/detail/' . $this->encrypt_id($id) . '#guest-registration');
        }
    }

    public function guest_success($encrypted_guest_id = null)
    {
        $guest_id = $this->decrypt_id($encrypted_guest_id, 'Guest ID');

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

    public function workshop_success($encrypted_id = null)
    {
        $id = $this->decrypt_id($encrypted_id, 'Workshop ID');

        // Get workshop by ID
        $workshop = $this->workshop_model->get_workshop($id);

        if (!$workshop) {
            show_404();
        }

        // Get user registration details
        $user_id = $this->session->userdata('user_id');
        $participant = $this->workshop_model->get_participant_details($workshop->id, $user_id);

        if (!$participant) {
            show_404();
        }

        $data['workshop'] = $workshop;
        $data['participant'] = $participant;
        $data['title'] = 'Pendaftaran Berhasil - Aset Academy';
        $data['description'] = 'Selamat! Anda telah berhasil mendaftar workshop ' . $workshop->title;

        $this->load->view('templates/header', $data);
        $this->load->view('student/workshop_success', $data);
        $this->load->view('templates/footer');
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

    public function get_villages($district_id = null)
    {
        if (!$district_id) {
            echo json_encode([]);
            return;
        }

        $villages = $this->workshop_model->get_villages($district_id);
        echo json_encode($villages);
    }
}
