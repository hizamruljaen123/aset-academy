<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        // Check admin permission
        if($this->session->userdata('level') != '1' && $this->session->userdata('level') != '2') {
            redirect('dashboard');
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola User',
            'users' => $this->User_model->get_all_users()
        ];
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/users/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah User Baru'
        ];
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/users/create', $data);
        $this->load->view('templates/footer');
    }

    public function store()
    {
        // Handle form submission
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit User',
            'user' => $this->User_model->get_user_by_id($id)
        ];
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/users/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update($id)
    {
        // Handle update form submission
    }

    public function delete($id)
    {
        // Handle user deletion
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail User',
            'user' => $this->User_model->get_user_by_id($id)
        ];
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/users/detail', $data);
        $this->load->view('templates/footer');
    }
}
