<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Siswa_model');
        $this->load->model('Materi_model');
        $this->load->library('Permission');
        
        // Check if user is logged in and has student role
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        
        if (!$this->permission->is_student()) {
            show_error('Access denied. Student role required.', 403);
        }
    }

    public function index()
    {
        $student_id = $this->session->userdata('user_id');
        $user_email = $this->session->userdata('email');
        
        // Get student profile data
        $this->db->select('s.*');
        $this->db->from('siswa s');
        $this->db->join('users u', 's.email = u.email', 'left');
        $this->db->where('u.id', $student_id);
        $data['student_profile'] = $this->db->get()->row();
        
        // If no profile found, create a temporary profile for display
        if (!$data['student_profile']) {
            // Get user data
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('id', $student_id);
            $user = $this->db->get()->row();
            
            if ($user) {
                // Create temporary profile object
                $data['student_profile'] = new stdClass();
                $data['student_profile']->id = null;
                $data['student_profile']->nis = 'Belum terdaftar';
                $data['student_profile']->nama_lengkap = $user->nama_lengkap;
                $data['student_profile']->email = $user->email;
                $data['student_profile']->no_telepon = '-';
                $data['student_profile']->kelas = 'Belum terdaftar';
                $data['student_profile']->jurusan = 'Belum terdaftar';
                $data['student_profile']->status = 'Aktif';
                
                // Set flag for incomplete profile
                $data['incomplete_profile'] = true;
            } else {
                show_error('User data not found. Please contact administrator.', 404);
            }
        }
        
        // Get available classes for student's major
        $this->db->where('status', 'Aktif');
        $data['available_classes'] = $this->db->get('kelas_programming')->result();
        
        // Get materials for student's class
        if ($data['student_profile']->kelas) {
            // Get kelas_id from nama_kelas
            $this->db->select('id');
            $this->db->where('nama_kelas', $data['student_profile']->kelas);
            $kelas = $this->db->get('kelas_programming')->row();
            
            if ($kelas) {
                $kelas_id = $kelas->id;
                
                // Get materials for student's class
                $this->db->select('m.*, kp.nama_kelas');
                $this->db->from('materi m');
                $this->db->join('kelas_programming kp', 'm.kelas_id = kp.id');
                $this->db->where('kp.nama_kelas', $data['student_profile']->kelas);
                $this->db->order_by('m.created_at', 'DESC');
                $data['class_materials'] = $this->db->get()->result();
                
                // Get progress statistics
                $this->db->select('COUNT(*) as total_materi');
                $this->db->from('materi');
                $this->db->where('kelas_id', $kelas_id);
                $data['total_materi'] = $this->db->get()->row()->total_materi;
                
                // Get recent materials (last 5)
                $this->db->select('m.*, kp.nama_kelas');
                $this->db->from('materi m');
                $this->db->join('kelas_programming kp', 'm.kelas_id = kp.id');
                $this->db->where('kp.nama_kelas', $data['student_profile']->kelas);
                $this->db->order_by('m.created_at', 'DESC');
                $this->db->limit(5);
                $data['recent_materials'] = $this->db->get()->result();
                
                // Get class details
                $this->db->select('*');
                $this->db->from('kelas_programming');
                $this->db->where('id', $kelas_id);
                $data['class_details'] = $this->db->get()->row();
                
                // Get classmates
                $this->db->select('*');
                $this->db->from('siswa');
                $this->db->where('kelas', $data['student_profile']->kelas);
                $this->db->where('id !=', $data['student_profile']->id);
                $this->db->limit(5);
                $data['classmates'] = $this->db->get()->result();
                
                // Count total classmates
                $this->db->where('kelas', $data['student_profile']->kelas);
                $data['total_classmates'] = $this->db->count_all_results('siswa');
            }
        } else {
            $data['class_materials'] = [];
            $data['recent_materials'] = [];
            $data['total_materi'] = 0;
            $data['class_details'] = null;
            $data['classmates'] = [];
            $data['total_classmates'] = 0;
        }
        
        $data['title'] = 'Dashboard Siswa';
        $this->load->view('templates/header', $data);
        $this->load->view('student/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function profile()
    {
        $student_id = $this->session->userdata('user_id');
        
        // Get user data first
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $student_id);
        $user = $this->db->get()->row();
        
        if (!$user) {
            show_error('User data not found. Please contact administrator.', 404);
        }
        
        // Get student profile data if exists
        $this->db->select('*');
        $this->db->from('siswa');
        $this->db->where('email', $user->email);
        $student_profile = $this->db->get()->row();
        
        // Combine user and student data
        $data['student'] = $user;
        
        // Check if student profile exists
        $data['profile_exists'] = ($student_profile !== null);
        
        // If profile exists, merge the data
        if ($data['profile_exists']) {
            foreach ($student_profile as $key => $value) {
                $data['student']->$key = $value;
            }
        } else {
            // Set default values for missing profile data
            $data['student']->nis = 'Belum terdaftar';
            $data['student']->kelas = 'Belum terdaftar';
            $data['student']->jurusan = 'Belum terdaftar';
            $data['student']->no_telepon = '-';
            $data['student']->alamat = '-';
            $data['student']->tanggal_lahir = null;
            $data['student']->jenis_kelamin = '-';
            
            // Make sure we don't overwrite the user status
            if (!isset($data['student']->status)) {
                $data['student']->status = 'Aktif';
            }
        }
        
        $data['title'] = 'Profil Saya';
        $this->load->view('templates/header', $data);
        $this->load->view('student/profile', $data);
        $this->load->view('templates/footer');
    }

    public function materi()
    {
        $student_id = $this->session->userdata('user_id');
        
        // Get student's class
        $this->db->select('u.id, u.nama_lengkap, u.email, s.kelas');
        $this->db->from('users u');
        $this->db->join('siswa s', 's.email = u.email', 'left');
        $this->db->where('u.id', $student_id);
        $student = $this->db->get()->row();
        
        if (!$student) {
            show_error('User data not found. Please contact administrator.', 404);
        }
        
        // Check if student has a profile and is assigned to a class
        $has_class = isset($student->kelas) && $student->kelas != 'Belum terdaftar' && $student->kelas != '';
        
        if (!$has_class) {
            $data['materials'] = [];
            $data['no_class_assigned'] = true;
            
            // Get all available materials for browsing
            $this->db->select('m.*, kp.nama_kelas');
            $this->db->from('materi m');
            $this->db->join('kelas_programming kp', 'm.kelas_id = kp.id');
            $this->db->order_by('m.created_at', 'DESC');
            $this->db->limit(5); // Show only 5 latest materials
            $data['featured_materials'] = $this->db->get()->result();
        } else {
            // Get materials for student's class
            $this->db->select('m.*, kp.nama_kelas');
            $this->db->from('materi m');
            $this->db->join('kelas_programming kp', 'm.kelas_id = kp.id');
            $this->db->where('kp.nama_kelas', $student->kelas);
            $this->db->order_by('m.created_at', 'DESC');
            $data['materials'] = $this->db->get()->result();
            $data['no_class_assigned'] = false;
        }
        
        $data['title'] = 'Materi Pembelajaran';
        $this->load->view('templates/header', $data);
        $this->load->view('student/materi', $data);
        $this->load->view('templates/footer');
    }

    public function materi_detail($id)
    {
        $student_id = $this->session->userdata('user_id');
        
        // Get student's class
        $this->db->select('u.id, u.nama_lengkap, u.email, s.kelas');
        $this->db->from('users u');
        $this->db->join('siswa s', 's.email = u.email', 'left');
        $this->db->where('u.id', $student_id);
        $student = $this->db->get()->row();
        
        if (!$student) {
            show_error('User data not found. Please contact administrator.', 404);
        }
        
        // Check if the material exists
        $this->db->select('m.*, kp.nama_kelas');
        $this->db->from('materi m');
        $this->db->join('kelas_programming kp', 'm.kelas_id = kp.id');
        $this->db->where('m.id', $id);
        $materi = $this->db->get()->row();
        
        if (!$materi) {
            show_error('Materi tidak ditemukan.', 404);
        }
        
        // Check if student has a profile and is assigned to a class
        $has_class = isset($student->kelas) && $student->kelas != 'Belum terdaftar' && $student->kelas != '';
        
        // If student has a class, check if they have access to this material
        if ($has_class && $materi->nama_kelas != $student->kelas) {
            // Set flag for restricted access
            $data['restricted_access'] = true;
            $data['student_class'] = $student->kelas;
            $data['material_class'] = $materi->nama_kelas;
        } else {
            $data['restricted_access'] = false;
        }
        
        // Get materi parts
        $this->db->where('materi_id', $id);
        $this->db->order_by('part_order', 'ASC');
        $data['parts'] = $this->db->get('materi_parts')->result();
        
        $data['materi'] = $materi;
        $data['title'] = 'Detail Materi - ' . $materi->judul;
        $this->load->view('templates/header', $data);
        $this->load->view('student/materi_detail', $data);
        $this->load->view('templates/footer');
    }
}
