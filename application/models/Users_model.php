<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

    // Konstruktor untuk memuat library database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Fungsi untuk mendapatkan semua data users
    public function get_all_users()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->order_by('nama_lengkap', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Fungsi untuk mendapatkan data user berdasarkan ID
    public function get_user_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    // Fungsi untuk mendapatkan data user berdasarkan username
    public function get_user_by_username($username)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username', $username);
        $query = $this->db->get();
        return $query->row();
    }

    // Fungsi untuk mendapatkan data user berdasarkan email
    public function get_user_by_email($email)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->row();
    }

    // Fungsi untuk menambah data user
    public function insert_user($data)
    {
        if (isset($data['password'])) {
            $data['password'] = md5($data['password']);
        }
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    // Fungsi untuk mengupdate data user
    public function update_user($id, $data)
    {
        if (isset($data['password']) && $data['password'] != '') {
            $data['password'] = md5($data['password']);
        } else {
            unset($data['password']);
        }
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        return $this->db->affected_rows();
    }

    // Fungsi untuk menghapus data user
    public function delete_user($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('users');
        return $this->db->affected_rows();
    }

    // Fungsi untuk login user
    public function login($username, $password)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username', $username);
        $this->db->where('status', 'Aktif');
        $query = $this->db->get();
        
        if ($query->num_rows() == 1) {
            $user = $query->row();
            if (md5($password) == $user->password) {
                // Update last login
                $this->update_last_login($user->id);
                return $user;
            }
        }
        return false;
    }

    // Fungsi untuk update last login
    public function update_last_login($id)
    {
        $this->db->set('last_login', 'CURRENT_TIMESTAMP', FALSE);
        $this->db->where('id', $id);
        $this->db->update('users');
    }

    // Fungsi untuk mendapatkan jumlah total users
    public function count_users()
    {
        return $this->db->count_all('users');
    }

    // Fungsi untuk mendapatkan jumlah users berdasarkan role
    public function count_users_by_role($role)
    {
        $this->db->from('users');
        $this->db->where('role', $role);
        return $this->db->count_all_results();
    }

    // Fungsi untuk mendapatkan jumlah users berdasarkan status
    public function count_users_by_status($status)
    {
        $this->db->from('users');
        $this->db->where('status', $status);
        return $this->db->count_all_results();
    }

    // Fungsi untuk cek username sudah ada atau belum
    public function is_username_exists($username, $id = null)
    {
        $this->db->from('users');
        $this->db->where('username', $username);
        if ($id) {
            $this->db->where('id !=', $id);
        }
        return $this->db->count_all_results() > 0;
    }

    // Fungsi untuk cek email sudah ada atau belum
    public function is_email_exists($email, $id = null)
    {
        $this->db->from('users');
        $this->db->where('email', $email);
        if ($id) {
            $this->db->where('id !=', $id);
        }
        return $this->db->count_all_results() > 0;
    }
}
?>