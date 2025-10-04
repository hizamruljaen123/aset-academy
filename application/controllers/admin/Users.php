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

    public function delete($id = null)
    {
        if (!$id) {
            $this->session->set_flashdata('error', 'User ID tidak valid');
            redirect('admin/users');
        }

        // Check if user exists
        $user = $this->User_model->get_user_by_id($id);
        if (!$user) {
            $this->session->set_flashdata('error', 'User tidak ditemukan');
            redirect('admin/users');
        }

        // Prevent deleting own account
        if ($id == $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Tidak bisa menghapus akun sendiri');
            redirect('admin/users');
        }

        // Start transaction
        $this->db->trans_begin();

        try {
            // Delete user from users table
            $this->db->where('id', $id);
            $this->db->delete('users');

            // Check if user was deleted
            if ($this->db->affected_rows() > 0) {
                // Delete related records in other tables if needed
                // Example: $this->db->where('user_id', $id)->delete('user_related_table');
                
                // Commit transaction
                $this->db->trans_commit();
                
                $this->session->set_flashdata('success', 'User berhasil dihapus');
            } else {
                throw new Exception('Gagal menghapus user');
            }
        } catch (Exception $e) {
            // Rollback transaction on error
            $this->db->trans_rollback();
            
            // Log the error
            log_message('error', 'Error deleting user: ' . $e->getMessage());
            
            // Get database error if any
            $db_error = $this->db->error();
            if (!empty($db_error['message'])) {
                log_message('error', 'Database error: ' . $db_error['message']);
            }
            
            $this->session->set_flashdata('error', 'Gagal menghapus user. ' . $e->getMessage());
        }
        
        redirect('admin/users');
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
