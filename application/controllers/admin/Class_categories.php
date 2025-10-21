<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Class_categories extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Class_category_model', 'category_model');
        $this->load->library(['form_validation', 'session', 'permission', 'encryption_url']);
        $this->load->helper(['url', 'form']);

        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        if (!$this->permission->is_admin()) {
            show_error('Access denied. Admin role required.', 403);
        }
    }

    public function index()
    {
        $class_type = $this->input->get('class_type');
        $data['title'] = 'Kelola Kategori Kelas';
        $data['class_type'] = $class_type;
        $data['categories'] = $this->category_model->get_all($class_type);

        $this->load->view('templates/header', $data);
        $this->load->view('admin/class_categories/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Tambah Kategori Kelas';

        $this->form_validation->set_rules('name', 'Nama Kategori', 'required|trim', [
            'required' => 'Nama kategori wajib diisi.'
        ]);
        $this->form_validation->set_rules('class_type', 'Tipe Kelas', 'required|in_list[premium,free]', [
            'required' => 'Tipe kelas wajib dipilih.',
            'in_list' => 'Tipe kelas harus premium atau free.'
        ]);

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('admin/class_categories/create', $data);
            $this->load->view('templates/footer');
            return;
        }

        $name = $this->input->post('name');
        $class_type = $this->input->post('class_type');
        $slug = url_title($name, '-', TRUE);

        if ($this->category_model->is_name_exists($name)) {
            $this->session->set_flashdata('error', 'Nama kategori sudah digunakan.');
            redirect('admin/class_categories/create');
        }

        if ($this->category_model->is_slug_exists($slug)) {
            $slug .= '-' . time();
        }

        $data_insert = [
            'name' => $name,
            'slug' => $slug,
            'class_type' => $class_type,
            'description' => $this->input->post('description'),
            'is_active' => $this->input->post('is_active') ? 1 : 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->category_model->create($data_insert);
        $this->session->set_flashdata('success', 'Kategori kelas berhasil dibuat.');
        redirect('admin/class_categories');
    }

    public function edit($id)
    {
        // Decrypt category ID
        $id = $this->encryption_url->decode($id);
        
        if ($id === false) {
            show_error('Invalid category ID', 404);
        }
        
        $category = $this->category_model->get_by_id($id);
        if (!$category) {
            show_error('Kategori tidak ditemukan.', 404);
        }

        $data['title'] = 'Edit Kategori Kelas';
        $data['category'] = $category;

        $this->form_validation->set_rules('name', 'Nama Kategori', 'required|trim', [
            'required' => 'Nama kategori wajib diisi.'
        ]);
        $this->form_validation->set_rules('class_type', 'Tipe Kelas', 'required|in_list[premium,free]', [
            'required' => 'Tipe kelas wajib dipilih.',
            'in_list' => 'Tipe kelas harus premium atau free.'
        ]);

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('admin/class_categories/edit', $data);
            $this->load->view('templates/footer');
            return;
        }

        $name = $this->input->post('name');
        $class_type = $this->input->post('class_type');
        $slug = url_title($name, '-', TRUE);

        if ($this->category_model->is_name_exists($name, $id)) {
            $this->session->set_flashdata('error', 'Nama kategori sudah digunakan.');
            redirect('admin/class_categories/edit/' . $this->encryption_url->encode($id));
        }

        if ($this->category_model->is_slug_exists($slug, $id)) {
            $slug .= '-' . time();
        }

        $data_update = [
            'name' => $name,
            'slug' => $slug,
            'class_type' => $class_type,
            'description' => $this->input->post('description'),
            'is_active' => $this->input->post('is_active') ? 1 : 0,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->category_model->update($id, $data_update);
        $this->session->set_flashdata('success', 'Kategori kelas berhasil diperbarui.');
        redirect('admin/class_categories');
    }

    public function delete($id)
    {
        // Decrypt category ID
        $id = $this->encryption_url->decode($id);
        
        if ($id === false) {
            show_error('Invalid category ID', 404);
        }
        
        $category = $this->category_model->get_by_id($id);
        if (!$category) {
            show_error('Kategori tidak ditemukan.', 404);
        }

        $this->category_model->delete($id);
        $this->session->set_flashdata('success', 'Kategori kelas berhasil dihapus.');
        redirect('admin/class_categories');
    }
}
