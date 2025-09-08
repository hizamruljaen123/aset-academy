<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Profile_model');
        $this->load->library('Permission');
        $this->load->library('form_validation');
        
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index()
    {
        redirect('profile/view');
    }
    
    public function view()
    {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->get_user_by_id($user_id);
        
        // Load role-specific data
        if ($this->permission->is_student()) {
            $data['profile'] = $this->Profile_model->get_student_profile_by_user_id($user_id);
            $data['profile_exists'] = $this->Profile_model->student_profile_exists($user_id);
        } elseif ($this->permission->is_teacher()) {
            $data['kelas_count'] = $this->Profile_model->count_teacher_classes($user_id);
        }

        $data['title'] = 'Profil ' . ($this->permission->is_student() ? 'Siswa' : ($this->permission->is_teacher() ? 'Guru' : 'Admin'));
        $this->load->view('templates/header', $data);
        $this->load->view('profile/unified_profile', $data);
        $this->load->view('templates/footer');
    }
    
    public function update()
    {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->get_user_by_id($user_id);
        
        // Set validation rules based on role
        if ($this->permission->is_student()) {
            $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
            $this->form_validation->set_rules('no_telepon', 'Nomor Telepon', 'required|trim');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
            $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
            $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        } else {
            $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        }
        
        if ($this->form_validation->run() === FALSE) {
            // Form validation failed, show form again with errors
            if ($this->permission->is_student()) {
                $data['profile'] = $this->Profile_model->get_student_profile_by_user_id($user_id);
                $data['profile_exists'] = $this->Profile_model->student_profile_exists($user_id);
                $data['available_classes'] = $this->Profile_model->get_available_classes();
                
                $data['title'] = 'Update Profil';
                $this->load->view('templates/header', $data);
                $this->load->view('profile/update_student_profile', $data);
                $this->load->view('templates/footer');
            } else {
                $data['title'] = 'Update Profil';
                $this->load->view('templates/header', $data);
                $this->load->view('profile/update_user_profile', $data);
                $this->load->view('templates/footer');
            }
        } else {
            // Form validation passed, update profile
            $user_data = [
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'email' => $this->input->post('email')
            ];
            
            // Update user data
            $this->User_model->update_user($user_id, $user_data);
            
            // Update session data
            $this->session->set_userdata('nama_lengkap', $user_data['nama_lengkap']);
            $this->session->set_userdata('email', $user_data['email']);
            
            // If student, update student profile
            if ($this->permission->is_student()) {
                $student_data = [
                    'nama_lengkap' => $this->input->post('nama_lengkap'),
                    'email' => $this->input->post('email'),
                    'no_telepon' => $this->input->post('no_telepon'),
                    'alamat' => $this->input->post('alamat'),
                    'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin')
                ];
                
                // Check if student profile exists
                if ($this->Profile_model->student_profile_exists($user_id)) {
                    // Update existing profile
                    $this->Profile_model->update_student_profile_by_email($user_data['email'], $student_data);
                } else {
                    // Create new profile
                    $student_data['nis'] = 'S' . str_pad($user_id, 5, '0', STR_PAD_LEFT);
                    $student_data['kelas'] = $this->input->post('kelas') ?: 'Belum terdaftar';
                    $student_data['jurusan'] = $this->input->post('jurusan') ?: 'Belum terdaftar';
                    $student_data['status'] = 'Aktif';
                    
                    $this->Profile_model->create_student_profile($student_data);
                }
            }
            
            $this->session->set_flashdata('success', 'Profil berhasil diperbarui');
            redirect('profile/view');
        }
    }
    
    public function change_password()
    {
        $user_id = $this->session->userdata('user_id');
        
        $this->form_validation->set_rules('current_password', 'Password Saat Ini', 'required|trim');
        $this->form_validation->set_rules('new_password', 'Password Baru', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|trim|matches[new_password]');
        
        if ($this->form_validation->run() === FALSE) {
            // Form validation failed, redirect back with errors
            $this->session->set_flashdata('error', validation_errors());
            redirect('profile/view');
        } else {
            // Verify current password
            $current_password = $this->input->post('current_password');
            if (!$this->User_model->verify_password($user_id, $current_password)) {
                $this->session->set_flashdata('error', 'Password saat ini tidak sesuai');
                redirect('profile/view');
            }
            
            // Update password
            $new_password = $this->input->post('new_password');
            $this->User_model->update_password($user_id, $new_password);
            
            $this->session->set_flashdata('success', 'Password berhasil diperbarui');
            redirect('profile/view');
        }
    }
    
    public function upload_photo()
    {
        $user_id = $this->session->userdata('user_id');
        
        // Configure upload
        $config['upload_path'] = './uploads/profile/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 2048; // 2MB
        $config['file_name'] = 'profile_' . $user_id . '_' . time();
        
        // Create directory if it doesn't exist
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }
        
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload('profile_photo')) {
            // Upload failed
            $this->session->set_flashdata('error', $this->upload->display_errors());
        } else {
            // Upload success
            $upload_data = $this->upload->data();
            $photo_path = 'uploads/profile/' . $upload_data['file_name'];
            
            // Update user data with photo path
            $this->User_model->update_user($user_id, ['photo' => $photo_path]);
            
            $this->session->set_flashdata('success', 'Foto profil berhasil diunggah');
        }
        
        redirect('profile/view');
    }
}
