<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Materi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Materi_model');
        $this->load->model('Kelas_model');
        $this->load->model('Materi_part_model');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->helper('url');
        $this->load->helper('form');
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
    }

    public function index($kelas_id = null)
    {
        if ($kelas_id) {
            $data['title'] = 'Materi Kelas';
            $data['kelas'] = $this->Kelas_model->get_kelas_by_id($kelas_id);
            $data['materi'] = $this->Materi_model->get_materi_by_kelas($kelas_id);
            $this->load->view('templates/header', $data);
            $this->load->view('materi/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data['title'] = 'Pilih Kelas';
            $data['kelas_list'] = $this->Kelas_model->get_all_kelas();
            $this->load->view('templates/header', $data);
            $this->load->view('materi/pilih_kelas', $data);
            $this->load->view('templates/footer');
        }
    }

    public function create($kelas_id)
    {
        $data['title'] = 'Tambah Materi';
        $data['kelas_id'] = $kelas_id;

        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('materi/create', $data);
            $this->load->view('templates/footer');
        } else {
            $materi_data = [
                'kelas_id' => $kelas_id,
                'judul' => $this->input->post('judul'),
                'deskripsi' => $this->input->post('deskripsi'),
            ];
            $materi_id = $this->Materi_model->insert_materi($materi_data);

            // Handle optional initial part
            $part_type = $this->input->post('part_type');
            if ($materi_id && $part_type) {
                $part_content = '';
                if ($part_type == 'link' || $part_type == 'video') {
                    $part_content = $this->input->post('part_content_link');
                } elseif ($part_type == 'image' || $part_type == 'pdf') {
                    $config['upload_path'] = './uploads/';
                    $config['allowed_types'] = ($part_type == 'image') ? 'gif|jpg|png|jpeg' : 'pdf';
                    $config['max_size'] = 2048;
                    $config['encrypt_name'] = TRUE;
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('part_content_file')) {
                        $upload_data = $this->upload->data();
                        $part_content = $upload_data['file_name'];
                    } else {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('materi/create/' . $kelas_id);
                        return;
                    }
                }

                if ($part_content) {
                    $part_data = [
                        'materi_id' => $materi_id,
                        'part_title' => $this->input->post('part_title'),
                        'part_type' => $part_type,
                        'part_content' => $part_content,
                        'part_order' => 1
                    ];
                    $this->Materi_part_model->insert_part($part_data);
                }
            }

            $this->session->set_flashdata('success', 'Materi berhasil ditambahkan.');
            redirect('materi/index/' . $kelas_id);
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Materi';
        $data['materi'] = $this->Materi_model->get_materi_by_id($id);
        $kelas_id = $data['materi']->kelas_id;

        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('materi/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $materi_data = [
                'judul' => $this->input->post('judul'),
                'deskripsi' => $this->input->post('deskripsi'),
            ];
            $this->Materi_model->update_materi($id, $materi_data);
            $this->session->set_flashdata('success', 'Materi berhasil diupdate.');
            redirect('materi/index/' . $kelas_id);
        }
    }

    public function delete($id)
    {
        $materi = $this->Materi_model->get_materi_by_id($id);
        $kelas_id = $materi->kelas_id;
        $this->Materi_model->delete_materi($id);
        $this->session->set_flashdata('success', 'Materi berhasil dihapus.');
        redirect('materi/index/' . $kelas_id);
    }

    public function detail($materi_id)
    {
        $data['title'] = 'Detail Materi';
        $data['materi'] = $this->Materi_model->get_materi_by_id($materi_id);
        
        // Load kelas data
        $this->load->model('Kelas_model');
        $data['kelas'] = $this->Kelas_model->get_kelas_by_id($data['materi']->kelas_id);
        
        $data['parts'] = $this->Materi_part_model->get_parts_by_materi_id($materi_id);

        if (empty($data['materi'])) {
            show_404();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('materi/detail', $data);
        $this->load->view('templates/footer');
    }

    public function add_part($materi_id)
    {
        $this->form_validation->set_rules('part_title', 'Judul Part', 'required');
        $this->form_validation->set_rules('part_type', 'Tipe Part', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('materi/detail/' . $materi_id);
        } else {
            $part_type = $this->input->post('part_type');
            $part_content = '';

            if ($part_type == 'link' || $part_type == 'video') {
                $this->form_validation->set_rules('part_content_link', 'Link', 'required|trim');
                if ($this->form_validation->run() == FALSE) {
                    $this->session->set_flashdata('error', validation_errors());
                    redirect('materi/detail/' . $materi_id);
                    return;
                }
                $part_content = $this->input->post('part_content_link');
            } elseif ($part_type == 'image' || $part_type == 'pdf') {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = ($part_type == 'image') ? 'gif|jpg|png|jpeg' : 'pdf';
                $config['max_size'] = 2048; // 2MB
                $config['encrypt_name'] = TRUE;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('part_content_file')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('materi/detail/' . $materi_id);
                    return;
                } else {
                    $upload_data = $this->upload->data();
                    $part_content = $upload_data['file_name'];
                }
            }

            $last_order = $this->Materi_part_model->get_last_part_order($materi_id);

            $data = [
                'materi_id' => $materi_id,
                'part_title' => $this->input->post('part_title'),
                'part_type' => $part_type,
                'part_content' => $part_content,
                'part_order' => $last_order + 1
            ];

            $this->Materi_part_model->insert_part($data);
            $this->session->set_flashdata('success', 'Part materi berhasil ditambahkan.');
            redirect('materi/detail/' . $materi_id);
        }
    }

    public function delete_part($part_id)
    {
        $part = $this->Materi_part_model->get_part_by_id($part_id);
        if ($part) {
            if ($part->part_type == 'image' || $part->part_type == 'pdf') {
                $file_path = './uploads/' . $part->part_content;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            $this->Materi_part_model->delete_part($part_id);
            $this->session->set_flashdata('success', 'Part materi berhasil dihapus.');
            redirect('materi/detail/' . $part->materi_id);
        } else {
            show_404();
        }
    }

}

/* End of file Materi.php */
