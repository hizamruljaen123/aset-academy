<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->model('Auth_model');
        $this->load->model('Settings_model', 'settings_model');
        
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
                // Check if maintenance mode is enabled and user is not super admin
                if ($this->settings_model->is_maintenance_mode() &&
                    !($user->role === 'super_admin' && $user->level == '1')) {
                    // If maintenance mode is active and user is not super admin, deny login
                    $this->session->set_flashdata('error', 'Website sedang dalam pemeliharaan.');
                    redirect('auth');
                    return;
                }

                // Set enhanced session data with level and permissions
                $session_data = array(
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email,
                    'role' => $user->role,
                    'level' => $user->level,
                    'logged_in' => TRUE
                );

                $this->session->set_userdata($session_data);

                // Redirect based on role and level
                $redirect_url = $this->Auth_model->get_redirect_url($user->role, $user->level);
                redirect($redirect_url);
            } else {
                // Login gagal
                $this->session->set_flashdata('error', 'Username atau password salah!');
                redirect('auth');
            }
        }
    }

    // Alias untuk method index (login)
    public function login()
    {
        $this->index();
    }

    // Logout
    public function logout()
    {
        // Set flash message before destroying session
        $this->session->set_flashdata('success', 'Anda telah berhasil logout');
        
        // Destroy all session data
        $this->session->sess_destroy();
        
        redirect('auth');
    }

    // Menampilkan halaman register (jika diperlukan)
    public function register()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('student');
        }

        $data['title'] = 'Registrasi Siswa';
        $this->load->view('auth/register', $data);
    }

    public function process_register()
    {
        // Enable database debugging for detailed error messages
        $this->db->db_debug = TRUE;
        
        // Load necessary libraries
        $this->load->library('form_validation');
        
        // Set validation rules
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');

        if ($this->form_validation->run() === FALSE) {
            // If validation fails, show errors
            $this->session->set_flashdata('error', validation_errors('<div class="error">', '</div>'));
            $this->register();
            return;
        }

        try {
            // Generate NIS otomatis
            $last_siswa = $this->db->order_by('id', 'DESC')->get('siswa', 1)->row();
            $last_id = $last_siswa ? (int) substr($last_siswa->nis, -4) : 0;
            $new_nis = date('Y') . str_pad($last_id + 1, 4, '0', STR_PAD_LEFT);

            // Prepare user data
            $user_data = array(
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'email' => $this->input->post('email'),
                'role' => 'siswa',
                'level' => '4',
                'status' => 'Aktif',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            
            // Prepare siswa data
            $siswa_data = array(
                'id' => null, // Will be set after user creation
                'nis' => $new_nis,
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'email' => $this->input->post('email'),
                'no_telepon' => NULL,
                'kelas' => NULL,
                'jurusan' => NULL,
                'alamat' => NULL,
                'tanggal_lahir' => NULL,
                'jenis_kelamin' => NULL,
                'status' => 'Aktif',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            
            // Start transaction
            $this->db->trans_begin();
            
            // Insert to users table
            $this->db->insert('users', $user_data);
            $user_id = $this->db->insert_id();
            
            if (!$user_id) {
                throw new Exception('Gagal membuat akun pengguna');
            }
            
            // Set the ID for siswa_data
            $siswa_data['id'] = $user_id;
            
            // Insert to siswa table
            $this->db->insert('siswa', $siswa_data);
            
            if ($this->db->affected_rows() === 0) {
                throw new Exception('Gagal membuat data siswa');
            }
            
            // Commit transaction
            $this->db->trans_commit();
            
            // Send success response
            $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login');
            redirect('auth');
            
        } catch (Exception $e) {
            // Rollback transaction on error
            $this->db->trans_rollback();
            
            // Log the error
            log_message('error', 'Registration error: ' . $e->getMessage());
            log_message('error', 'Last query: ' . $this->db->last_query());
            
            // Get database error if any
            $db_error = $this->db->error();
            if (!empty($db_error['message'])) {
                log_message('error', 'Database error: ' . $db_error['message']);
            }
            
            // Show user-friendly error message
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat registrasi. Silakan coba lagi atau hubungi administrator.');
            redirect('auth/register');
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

    public function mobile_login()
    {
        // Jika sudah login, redirect ke dashboard mobile
        if ($this->session->userdata('logged_in')) {
            redirect('student_mobile');
        }

        $data['title'] = 'Login Mobile';
        $this->load->view('auth/mobile_login', $data);
    }

    public function process_mobile_login()
    {
        $this->load->library('form_validation');
        
        // Set validation rules
        $this->form_validation->set_rules('username', 'Username/NIS', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->mobile_login();
        } else {
            // Get input
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            // Coba login dengan username atau NIS
            $user = $this->Auth_model->login_mobile($username, $password);

            if ($user) {
                // Set session data
                $user_data = array(
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'nama_lengkap' => $user->nama_lengkap,
                    'email' => $user->email,
                    'role' => $user->role,
                    'level' => $user->level,
                    'logged_in' => true
                );
                
                $this->session->set_userdata($user_data);
                
                // Redirect ke dashboard mobile - tetap gunakan mobile dashboard jika tersedia
                redirect('student_mobile');
            } else {
                // Jika login gagal
                $this->session->set_flashdata('login_failed', 'Username/NIS atau password salah');
                redirect('mobile/login');
            }
        }
    }

    public function mobile_register()
    {
        // Jika sudah login, redirect ke dashboard
        if ($this->session->userdata('logged_in')) {
            redirect('student_mobile');
        }

        $data['title'] = 'Registrasi Siswa';
        $this->load->view('auth/mobile_register', $data);
    }

    public function process_mobile_register()
    {
        $this->load->library('form_validation');
        
        // Set validation rules
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->mobile_register();
        } else {
            // Generate NIS otomatis
            $last_siswa = $this->db->order_by('id', 'DESC')->get('siswa')->row();
            $last_id = $last_siswa ? (int) substr($last_siswa->nis, -4) : 0;
            $new_nis = date('Y') . str_pad($last_id + 1, 4, '0', STR_PAD_LEFT);

            // Data untuk tabel users
            $user_data = array(
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'email' => $this->input->post('email'),
                'role' => 'siswa',
                'level' => '4', // Level siswa
                'status' => 'Aktif'
            );
            
            // Data untuk tabel siswa (default values)
            $siswa_data = array(
                'id' => $user_id, // Pastikan id siswa sama dengan users.id
                'nis' => $new_nis,
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'email' => $this->input->post('email'),
                'no_telepon' => '',
                'kelas' => '', // Biarkan kosong
                'jurusan' => '',
                'alamat' => '',
                'tanggal_lahir' => date('Y-m-d'), // Default tanggal lahir hari ini
                'jenis_kelamin' => 'L', // Default Laki-laki
                'status' => 'Aktif'
            );
            
            $this->db->trans_start();
            
            // Insert ke tabel users
            $this->db->insert('users', $user_data);
            $user_id = $this->db->insert_id();
            
            // Insert ke tabel siswa
            $this->db->insert('siswa', $siswa_data);
            
            $this->db->trans_complete();
            
            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('register_error', 'Gagal melakukan registrasi');
                redirect('mobile/register');
            } else {
                $this->session->set_flashdata('register_success', 'Registrasi berhasil! Silakan login');
                redirect('mobile/login');
            }
        }
    }
}
?>