<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workshops extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Workshop_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('upload');

        // Admin authentication check
        if (!$this->session->userdata('logged_in') || !in_array($this->session->userdata('role'), ['admin', 'super_admin'])) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['title'] = 'Kelola Workshop & Seminar';
        $data['workshops'] = $this->Workshop_model->get_all_workshops();
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/workshops/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Buat Workshop/Seminar Baru';
        
        $this->form_validation->set_rules('title', 'Judul', 'required|trim');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('start_datetime', 'Waktu Mulai', 'required');
        $this->form_validation->set_rules('end_datetime', 'Waktu Selesai', 'required');
        $this->form_validation->set_rules('location', 'Lokasi', 'required|trim');
        $this->form_validation->set_rules('max_participants', 'Maksimal Peserta', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('admin/workshops/create', $data);
            $this->load->view('templates/footer');
        } else {
            $workshop_data = [
                'title' => $this->input->post('title'),
                'slug' => url_title($this->input->post('title'), '-', TRUE),
                'description' => $this->input->post('description'),
                'type' => $this->input->post('type'),
                'price' => $this->input->post('price'),
                'start_datetime' => $this->input->post('start_datetime'),
                'end_datetime' => $this->input->post('end_datetime'),
                'location' => $this->input->post('location'),
                'max_participants' => $this->input->post('max_participants'),
                'status' => $this->input->post('status')
            ];

            // Handle thumbnail upload
            if (!empty($_FILES['thumbnail']['name'])) {
                $config['upload_path'] = './uploads/workshops/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2048; // 2MB
                $config['encrypt_name'] = TRUE;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('thumbnail')) {
                    $upload_data = $this->upload->data();
                    $workshop_data['thumbnail'] = 'uploads/workshops/' . $upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/workshops/create');
                }
            }

            $workshop_id = $this->Workshop_model->create_workshop($workshop_data);
            $this->session->set_flashdata('success', 'Workshop berhasil dibuat!');
            redirect('admin/workshops/edit/' . $workshop_id);
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Workshop/Seminar';
        $data['workshop'] = $this->Workshop_model->get_workshop($id);
        $data['materials'] = $this->Workshop_model->get_materials($id);
        $data['participants'] = $this->Workshop_model->get_participants($id);

        if (!$data['workshop']) {
            show_404();
        }

        $this->form_validation->set_rules('title', 'Judul', 'required|trim');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('start_datetime', 'Waktu Mulai', 'required');
        $this->form_validation->set_rules('end_datetime', 'Waktu Selesai', 'required');
        $this->form_validation->set_rules('location', 'Lokasi', 'required|trim');
        $this->form_validation->set_rules('max_participants', 'Maksimal Peserta', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('admin/workshops/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $workshop_data = [
                'title' => $this->input->post('title'),
                'slug' => url_title($this->input->post('title'), '-', TRUE),
                'description' => $this->input->post('description'),
                'type' => $this->input->post('type'),
                'price' => $this->input->post('price'),
                'start_datetime' => $this->input->post('start_datetime'),
                'end_datetime' => $this->input->post('end_datetime'),
                'location' => $this->input->post('location'),
                'max_participants' => $this->input->post('max_participants'),
                'status' => $this->input->post('status'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            // Handle thumbnail upload/removal
            if ($this->input->post('remove_poster')) {
                // Remove existing poster
                if ($data['workshop']->thumbnail && file_exists($data['workshop']->thumbnail)) {
                    unlink($data['workshop']->thumbnail);
                }
                $workshop_data['thumbnail'] = null;
            } elseif (!empty($_FILES['thumbnail']['name'])) {
                $config['upload_path'] = './uploads/workshops/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2048; // 2MB
                $config['encrypt_name'] = TRUE;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('thumbnail')) {
                    // Delete old thumbnail if exists
                    if ($data['workshop']->thumbnail && file_exists($data['workshop']->thumbnail)) {
                        unlink($data['workshop']->thumbnail);
                    }

                    $upload_data = $this->upload->data();
                    $workshop_data['thumbnail'] = 'uploads/workshops/' . $upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/workshops/edit/' . $id);
                }
            }

            $this->Workshop_model->update_workshop($id, $workshop_data);
            $this->session->set_flashdata('success', 'Workshop berhasil diperbarui!');
            redirect('admin/workshops/edit/' . $id);
        }
    }

    public function delete($id)
    {
        $workshop = $this->Workshop_model->get_workshop($id);
        
        if ($workshop) {
            // Delete thumbnail if exists
            if ($workshop->thumbnail && file_exists($workshop->thumbnail)) {
                unlink($workshop->thumbnail);
            }
            
            $this->Workshop_model->delete_workshop($id);
            $this->session->set_flashdata('success', 'Workshop berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Workshop tidak ditemukan!');
        }
        
        redirect('admin/workshops');
    }

    public function add_material($workshop_id)
    {
        $this->form_validation->set_rules('title', 'Judul Materi', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/workshops/edit/' . $workshop_id);
        }

        $config['upload_path'] = './uploads/workshop_materials/';
        $config['allowed_types'] = 'pdf|doc|docx|ppt|pptx|zip|jpg|jpeg|png';
        $config['max_size'] = 5120; // 5MB
        $config['encrypt_name'] = TRUE;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('material_file')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('admin/workshops/edit/' . $workshop_id);
        }

        $upload_data = $this->upload->data();
        $material_data = [
            'title' => $this->input->post('title'),
            'file_path' => 'uploads/workshop_materials/' . $upload_data['file_name'],
            'file_type' => $upload_data['file_type']
        ];

        $this->Workshop_model->add_material($workshop_id, $material_data);
        $this->session->set_flashdata('success', 'Materi berhasil ditambahkan!');
        redirect('admin/workshops/edit/' . $workshop_id);
    }

    public function delete_material($id)
    {
        $material = $this->db->get_where('workshop_materials', ['id' => $id])->row();
        
        if ($material) {
            // Delete file
            if (file_exists($material->file_path)) {
                unlink($material->file_path);
            }
            
            $this->db->where('id', $id)->delete('workshop_materials');
            $this->session->set_flashdata('success', 'Materi berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Materi tidak ditemukan!');
        }
        
        redirect('admin/workshops/edit/' . $material->workshop_id);
    }

    public function participants($workshop_id)
    {
        $data['title'] = 'Kelola Peserta Workshop';
        $data['workshop'] = $this->Workshop_model->get_workshop($workshop_id);
        $data['participants'] = $this->Workshop_model->get_participants($workshop_id);
        
        if (!$data['workshop']) {
            show_404();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('admin/workshops/participants', $data);
        $this->load->view('templates/footer');
    }

    public function export_participants($workshop_id)
    {
        $workshop = $this->Workshop_model->get_workshop($workshop_id);
        $participants = $this->Workshop_model->get_participants($workshop_id);
        
        if (!$workshop) {
            show_404();
        }

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=peserta_' . url_title($workshop->title) . '.csv');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['Nama', 'Email', 'Peran', 'Status', 'Tanggal Registrasi']);

        foreach ($participants as $participant) {
            $name = $participant->user_id ? $participant->nama_lengkap : $participant->external_name;
            $email = $participant->user_id ? $participant->email : $participant->external_email;
            
            fputcsv($output, [
                $name,
                $email,
                $participant->role,
                $participant->status,
                $participant->registered_at
            ]);
        }

        fclose($output);
        exit;
    }
}
