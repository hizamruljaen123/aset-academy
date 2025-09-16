<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Permission_model');
        // Check admin permission (only super admin can manage permissions)
        if($this->session->userdata('level') != '1') {
            redirect('dashboard');
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola Permissions',
            'permissions' => $this->Permission_model->get_all_permissions()
        ];
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/permissions/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Permission Baru',
            'roles' => ['super_admin', 'admin', 'guru', 'siswa', 'user'],
            'levels' => ['1', '2', '3', '4', '5'],
            'modules' => ['dashboard', 'siswa', 'kelas', 'guru', 'jadwal', 'absensi', 'materi', 'assignments', 'forum', 'payment', 'users', 'permissions'],
            'actions' => ['create', 'read', 'update', 'delete', 'view']
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('admin/permissions/create', $data);
        $this->load->view('templates/footer');
    }

    public function store()
    {
        $this->form_validation->set_rules('role', 'Role', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');
        $this->form_validation->set_rules('module', 'Module', 'required');
        $this->form_validation->set_rules('action', 'Action', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/permissions/create');
        } else {
            $data = [
                'role' => $this->input->post('role'),
                'level' => $this->input->post('level'),
                'module' => $this->input->post('module'),
                'action' => $this->input->post('action'),
                'allowed' => $this->input->post('allowed') ? 1 : 0
            ];

            if ($this->Permission_model->create_permission($data)) {
                $this->session->set_flashdata('success', 'Permission berhasil ditambahkan');
                redirect('admin/permissions');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan permission');
                redirect('admin/permissions/create');
            }
        }
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Permission',
            'permission' => $this->Permission_model->get_permission_by_id($id)
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('admin/permissions/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update($id)
    {
        // Handle permission update
    }

    public function delete($id)
    {
        if ($this->Permission_model->delete_permission($id)) {
            $this->session->set_flashdata('success', 'Permission berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus permission');
        }
        redirect('admin/permissions');
    }

    public function toggle($id)
    {
        if ($this->Permission_model->toggle_permission($id)) {
            $this->session->set_flashdata('success', 'Status permission berhasil diubah');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengubah status permission');
        }
        redirect('admin/permissions');
    }

    public function reset_defaults()
    {
        // Handle reset to default permissions
        $this->session->set_flashdata('info', 'Fitur reset default permissions belum diimplementasikan');
        redirect('admin/permissions');
    }
}
