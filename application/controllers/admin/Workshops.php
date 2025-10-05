<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workshops extends MY_Controller {

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

    public function detail($encrypted_id = null)
    {
        $id = $this->decrypt_id($encrypted_id, 'Workshop ID');

        $data['title'] = 'Detail Workshop/Seminar';
        $data['workshop'] = $this->Workshop_model->get_workshop($id);
        $data['materials'] = $this->Workshop_model->get_materials($id);
        $data['participants'] = $this->Workshop_model->get_participants($id);

        if (!$data['workshop']) {
            show_404();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('admin/workshops/detail', $data);
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
        $this->form_validation->set_rules('online_meet', 'Link Online Meeting', 'trim|valid_url');

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
                'online_meet' => $this->input->post('online_meet'),
                'status' => $this->input->post('status')
            ];

            // Handle thumbnail upload
            if (!empty($_FILES['thumbnail']['name'])) {
                $config['upload_path'] = sys_get_temp_dir();
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2048; // 2MB
                $config['encrypt_name'] = TRUE;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('thumbnail')) {
                    $upload_data = $this->upload->data();
                    $localPath = $upload_data['full_path'];
                    // Upload to object storage
                    $this->load->library('ObjectStorage');
                    $remoteKey = 'workshops/thumbnails/' . date('Y/m') . '/' . $upload_data['file_name'];
                    $url = $this->objectstorage->putFile($localPath, $remoteKey);
                    if ($url) {
                        $workshop_data['thumbnail'] = $url;
                        @unlink($localPath);
                    } else {
                        $this->session->set_flashdata('error', 'Gagal mengunggah thumbnail ke object storage');
                        redirect('admin/workshops/create');
                        return;
                    }
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/workshops/create');
                }
            }

            $workshop_id = $this->Workshop_model->create_workshop($workshop_data);
            $this->session->set_flashdata('success', 'Workshop berhasil dibuat!');
            redirect('admin/workshops/edit/' . $this->encrypt_id($workshop_id));
        }
    }

    public function edit($encrypted_id = null)
    {
        $id = $this->decrypt_id($encrypted_id, 'Workshop ID');

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
        $this->form_validation->set_rules('online_meet', 'Link Online Meeting', 'trim|valid_url');

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
                'online_meet' => $this->input->post('online_meet'),
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
                $config['upload_path'] = sys_get_temp_dir();
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2048; // 2MB
                $config['encrypt_name'] = TRUE;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('thumbnail')) {
                    // Delete old thumbnail in object storage if previous value looks like remote key
                    if ($data['workshop']->thumbnail) {
                        // Attempt to delete by deriving remote key (best-effort)
                        // If stored as URL, we keep it - deleting remote object is optional.
                    }

                    $upload_data = $this->upload->data();
                    $localPath = $upload_data['full_path'];
                    $this->load->library('ObjectStorage');
                    $remoteKey = 'workshops/thumbnails/' . date('Y/m') . '/' . $upload_data['file_name'];
                    $url = $this->objectstorage->putFile($localPath, $remoteKey);
                    if ($url) {
                        $workshop_data['thumbnail'] = $url;
                        @unlink($localPath);
                    } else {
                        $this->session->set_flashdata('error', 'Gagal mengunggah thumbnail ke object storage');
                        redirect('admin/workshops/edit/' . $encrypted_id);
                        return;
                    }
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/workshops/edit/' . $encrypted_id);
                }
            }

            $this->Workshop_model->update_workshop($id, $workshop_data);
            $this->session->set_flashdata('success', 'Workshop berhasil diperbarui!');
            redirect('admin/workshops/edit/' . $encrypted_id);
        }
    }

    public function delete($encrypted_id = null)
    {
        $id = $this->decrypt_id($encrypted_id, 'Workshop ID');

        if ($this->Workshop_model->delete_workshop($id)) {
            $this->session->set_flashdata('success', 'Workshop berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus workshop.');
        }

        redirect('admin/workshops');
    }

    public function add_material($encrypted_workshop_id)
    {
        $workshop_id = $this->decrypt_id($encrypted_workshop_id, 'Workshop ID');
        
        $this->form_validation->set_rules('title', 'Judul Materi', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/workshops/edit/' . $encrypted_workshop_id);
        }

    $config['upload_path'] = sys_get_temp_dir();
        $config['allowed_types'] = 'pdf|doc|docx|ppt|pptx|zip|jpg|jpeg|png';
        $config['max_size'] = 5120; // 5MB
        $config['encrypt_name'] = TRUE;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('material_file')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('admin/workshops/edit/' . $encrypted_workshop_id);
        }

        $upload_data = $this->upload->data();
        $localPath = $upload_data['full_path'];
        $this->load->library('ObjectStorage');
        $remoteKey = 'workshops/materials/' . date('Y/m') . '/' . $upload_data['file_name'];
        $url = $this->objectstorage->putFile($localPath, $remoteKey);
        if (!$url) {
            $this->session->set_flashdata('error', 'Gagal mengunggah materi ke object storage');
            redirect('admin/workshops/edit/' . $encrypted_workshop_id);
            return;
        }

        $material_data = [
            'title' => $this->input->post('title'),
            'file_path' => $url,
            'file_type' => $upload_data['file_type']
        ];
        @unlink($localPath);

        $this->Workshop_model->add_material($workshop_id, $material_data);
        $this->session->set_flashdata('success', 'Materi berhasil ditambahkan!');
        redirect('admin/workshops/edit/' . $encrypted_workshop_id);
    }

    public function delete_material($encrypted_material_id)
    {
        $material_id = $this->decrypt_id($encrypted_material_id, 'Material ID');

        $material = $this->Workshop_model->get_material($material_id);
        if (!$material) {
            show_404();
        }

        $workshop_id = $material->workshop_id;

        if ($this->Workshop_model->delete_material($material_id)) {
            $this->session->set_flashdata('success', 'Materi berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus materi.');
        }

        redirect('admin/workshops/manage_materials/' . $this->encrypt_id($workshop_id));
    }

    public function participants($encrypted_workshop_id)
    {
        $workshop_id = $this->decrypt_id($encrypted_workshop_id, 'Workshop ID');
        
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

    public function manage_materials($encrypted_workshop_id)
    {
        $workshop_id = $this->decrypt_id($encrypted_workshop_id, 'Workshop ID');

        $workshop = $this->Workshop_model->get_workshop($workshop_id);
        if (!$workshop) {
            show_404();
        }

        $data['title'] = 'Kelola Materi Workshop';
        $data['workshop'] = $workshop;
        $data['materials'] = $this->Workshop_model->get_materials($workshop_id);

        $this->load->view('templates/header', $data);
        $this->load->view('admin/workshops/manage_materials', $data);
        $this->load->view('templates/footer');
    }

    public function export_participants($encrypted_workshop_id)
    {
        $workshop_id = $this->decrypt_id($encrypted_workshop_id, 'Workshop ID');
        
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
