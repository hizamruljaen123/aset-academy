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

    public function reset_defaults()
    {
        // Handle reset to default permissions
    }
}
