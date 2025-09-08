<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->model('Auth_model');
        
        // Jika method logout dipanggil, skip pengecekan login
        if ($this->router->method === 'logout') {
            return;
        }
        
        // Cek apakah user sudah login, jika sudah redirect berdasarkan role dan level
        if ($this->session->userdata('logged_in')) {
            $role = $this->session->userdata('role');
            $level = $this->session->userdata('level');
            $redirect_url = $this->Auth_model->get_redirect_url($role, $level);
            redirect($redirect_url);
        }
    }

    // Menampilkan halaman login
    public function index()
    {
        // Force destroy any existing sessions when accessing login page directly
        if (!$this->input->post() && $this->session->userdata('logged_in')) {
            $this->session->sess_destroy();
        }
        
        $data['title'] = 'Login - Academy Lite';
        
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login', $data);
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            $user = $this->Auth_model->authenticate($username, $password);
            
            if ($user) {
                // Set enhanced session data with level and permissions
                $session_data = array(
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'nama_lengkap' => $user->nama_lengkap,
                    'email' => $user->email,
                    'role' => $user->role,
                    'level' => $user->level,
                    'department' => $user->department,
                    'permissions' => $user->permissions,
                    'logged_in' => TRUE
                );
                
                $this->session->set_userdata($session_data);
                
                // Redirect berdasarkan role dan level
                $redirect_url = $this->Auth_model->get_redirect_url($user->role, $user->level);
                redirect($redirect_url);
            } else {
                // Login gagal
                $this->session->set_flashdata('error', 'Username atau password salah');
                redirect('auth');
            }
        }
    }

    // Logout
    public function logout()
    {
        // Set flash message before destroying session
        $this->session->set_flashdata('success', 'Anda telah berhasil logout');
        
        // Destroy all session data
        $this->session->sess_destroy();
        
        // Redirect to login page
        redirect('auth');
    }

    // Menampilkan halaman register (jika diperlukan)
    public function register()
    {
        $data['title'] = 'Register - Academy Lite';
        
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]', [
            'required' => 'Username harus diisi',
            'is_unique' => 'Username sudah terdaftar'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]', [
            'required' => 'Password harus diisi',
            'min_length' => 'Password minimal 6 karakter'
        ]);
        $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required|trim|matches[password]', [
            'required' => 'Konfirmasi password harus diisi',
            'matches' => 'Password tidak cocok'
        ]);
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'required' => 'Email harus diisi',
            'valid_email' => 'Email tidak valid',
            'is_unique' => 'Email sudah terdaftar'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register', $data);
        } else {
            $data = [
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'email' => $this->input->post('email'),
                'role' => 'user',
                'status' => 'Aktif'
            ];

            $this->Users_model->insert_user($data);
            $this->session->set_flashdata('success', 'Registrasi berhasil, silakan login');
            redirect('auth');
        }
    }

    // Menampilkan halaman lupa password (jika diperlukan)
    public function forgot_password()
    {
        $data['title'] = 'Lupa Password - Academy Lite';
        
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/forgot_password', $data);
        } else {
            $email = $this->input->post('email');
            
            // Cek email ada di database
            $user = $this->Users_model->get_user_by_email($email);
            
            if ($user) {
                // Generate token reset password
                $token = bin2hex(random_bytes(32));
                
                // Simpan token ke database (implementasi sesuai kebutuhan)
                
                // Kirim email reset password (implementasi sesuai kebutuhan)
                
                $this->session->set_flashdata('success', 'Link reset password telah dikirim ke email Anda');
                redirect('auth');
            } else {
                $this->session->set_flashdata('error', 'Email tidak terdaftar');
                redirect('auth/forgot_password');
            }
        }
    }
}
?>