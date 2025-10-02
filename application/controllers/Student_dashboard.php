<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Siswa_model');
        $this->load->model('Materi_model');
        $this->load->library('Permission');
        $this->load->library('form_validation');
        
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
        
        // Get paid classes the student has active enrollment for
        $this->load->model('Premium_enrollment_model');
        $data['paid_classes'] = $this->Premium_enrollment_model->get_student_enrollments($student_id);
        
        // Get available paid classes (excluding already purchased ones)
        $this->db->select('kp.*');
        $this->db->from('kelas_programming kp');
        $this->db->where('kp.status', 'Aktif');
        $this->db->where('kp.harga >', 0);
        
        // Exclude classes already purchased by student
        $this->db->join('payments p', "kp.id = p.class_id AND p.user_id = $student_id AND p.status = 'Verified'", 'left');
        $this->db->where('p.id IS NULL');
        
        $data['available_paid_classes'] = $this->db->get()->result();
        
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

                // Get class schedule
                $this->load->model('Jadwal_model');
                $jadwal_objects = $this->Jadwal_model->get_jadwal_by_kelas($kelas_id);
                $data['jadwal'] = array_map(function($j) { return (array)$j; }, $jadwal_objects);
            }
        } else {
            $data['class_materials'] = [];
            $data['recent_materials'] = [];
            $data['total_materi'] = 0;
            $data['class_details'] = null;
            $data['classmates'] = [];
            $data['total_classmates'] = 0;
            $data['jadwal'] = [];
        }
        
        $data['title'] = 'Dashboard Siswa';
        $this->load->view('templates/header', $data);
        $this->load->view('student/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function all_classes()
    {
        $student_id = $this->session->userdata('user_id');

        $this->load->model('Enrollment_model');
        $this->load->model('Premium_enrollment_model');

        $data['free_classes'] = $this->Enrollment_model->get_student_enrollments($student_id);
        $data['premium_classes'] = $this->Premium_enrollment_model->get_student_enrollments($student_id);

        $data['title'] = 'Semua Kelas Saya';
        $this->load->view('templates/header', $data);
        $this->load->view('student/all_classes', $data);
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

    public function edit_profile()
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
            $data['student']->nis = '';
            $data['student']->kelas = '';
            $data['student']->jurusan = '';
            $data['student']->no_telepon = '';
            $data['student']->alamat = '';
            $data['student']->tanggal_lahir = '';
            $data['student']->jenis_kelamin = '';
            $data['student']->status = 'Aktif';
        }
        
        $data['title'] = 'Edit Profil';
        $this->load->view('templates/header', $data);
        $this->load->view('student/edit_profile', $data);
        $this->load->view('templates/footer');
    }

    public function update_profile()
    {
        $student_id = $this->session->userdata('user_id');
        
        // Get user data first
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $student_id);
        $user = $this->db->get()->row();
        
        if (!$user) {
            $this->session->set_flashdata('error', 'User data not found.');
            redirect('student/profile');
        }
        
        // Set validation rules
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('nis', 'NIS', 'trim');
        $this->form_validation->set_rules('kelas', 'Kelas', 'trim');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'trim');
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Data tidak valid. Silakan periksa kembali.');
            redirect('student/profile/edit');
        }
        
        // Prepare data for users table
        $user_data = [
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        // Update users table
        $this->db->where('id', $student_id);
        $this->db->update('users', $user_data);
        
        // Prepare data for siswa table
        $siswa_data = [
            'nis' => $this->input->post('nis'),
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'email' => $user->email,
            'no_telepon' => $this->input->post('no_telepon'),
            'kelas' => $this->input->post('kelas'),
            'jurusan' => $this->input->post('jurusan'),
            'alamat' => $this->input->post('alamat'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir') ? $this->input->post('tanggal_lahir') : null,
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'status' => 'Aktif',
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        // Check if student profile already exists
        $this->db->select('id');
        $this->db->from('siswa');
        $this->db->where('email', $user->email);
        $existing_profile = $this->db->get()->row();
        
        if ($existing_profile) {
            // Update existing profile
            $this->db->where('id', $existing_profile->id);
            $this->db->update('siswa', $siswa_data);
        } else {
            // Insert new profile
            $this->db->insert('siswa', $siswa_data);
        }
        
        $this->session->set_flashdata('success', 'Profil berhasil diperbarui.');
        redirect('student/profile');
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

    public function absensi()
    {
        $student_id = $this->session->userdata('user_id');

        // Load timezone library
        $this->load->library('timezone_lib');

        // Get all classes the student is enrolled in (both premium and free)
        $enrolled_classes = $this->get_student_enrolled_classes($student_id);

        $data['enrolled_classes'] = $enrolled_classes;
        $data['attendance_summary'] = $this->get_student_attendance_summary($student_id, $enrolled_classes);

        // Get attendance calendar data
        $data['attendance_dates'] = $this->timezone_lib->get_student_attendance_dates($student_id);

        $data['title'] = 'Absensi Saya';
        $this->load->view('templates/header', $data);
        $this->load->view('student/absensi', $data);
        $this->load->view('templates/footer');
    }

    private function get_student_enrolled_classes($student_id)
    {
        // Get premium class enrollments (siswa.kelas matches kelas_programming.nama_kelas)
        $this->db->select('kp.id, kp.nama_kelas as nama_kelas, kp.level, kp.bahasa_program, kp.status, "premium" as class_type, NOW() as enrollment_date');
        $this->db->from('siswa s');
        $this->db->join('kelas_programming kp', 's.kelas = kp.nama_kelas');
        $this->db->where('s.id', $student_id);
        $this->db->where('kp.status', 'Aktif');
        $premium_classes = $this->db->get()->result();

        // Get free class enrollments
        $this->db->select('fc.id, fc.title as nama_kelas, fc.level, fc.category as bahasa_program, fc.status, "gratis" as class_type, fce.enrollment_date');
        $this->db->from('free_classes fc');
        $this->db->join('free_class_enrollments fce', 'fc.id = fce.class_id');
        $this->db->where('fce.student_id', $student_id);
        $this->db->where('fce.status', 'Enrolled');
        $this->db->where('fc.status', 'Published');
        $free_classes = $this->db->get()->result();

        return array_merge($premium_classes, $free_classes);
    }

    private function get_student_attendance_summary($student_id, $enrolled_classes)
    {
        $summary = [
            'present_classes' => [],
            'absent_classes' => []
        ];

        foreach ($enrolled_classes as $class) {
            // Get attendance records for this class
            $this->db->select('a.*, jk.judul_pertemuan, jk.tanggal_pertemuan, jk.waktu_mulai, jk.waktu_selesai');
            $this->db->from('absensi a');
            $this->db->join('jadwal_kelas jk', 'a.jadwal_id = jk.id');
            $this->db->where('a.siswa_id', $student_id);
            $this->db->where('jk.kelas_id', $class->id);
            $this->db->where('jk.class_type', $class->class_type);
            $this->db->order_by('jk.tanggal_pertemuan', 'DESC');
            $attendance_records = $this->db->get()->result();

            if (!empty($attendance_records)) {
                // Student has attendance records for this class
                $class->attendance_records = $attendance_records;
                $class->total_sessions = count($attendance_records);
                $class->present_count = 0;
                $class->absent_count = 0;

                foreach ($attendance_records as $record) {
                    if ($record->status == 'Hadir') {
                        $class->present_count++;
                    } else {
                        $class->absent_count++;
                    }
                }

                $summary['present_classes'][] = $class;
            } else {
                // Student has no attendance records for this class
                $class->attendance_records = [];
                $class->total_sessions = 0;
                $class->present_count = 0;
                $class->absent_count = 0;

                $summary['absent_classes'][] = $class;
            }
        }

        return $summary;
    }

    public function set_timezone()
    {
        $student_id = $this->session->userdata('user_id');
        $timezone = $this->input->post('timezone');

        if (!$student_id) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'User tidak terautentikasi'
            ]));
            return;
        }

        // Load timezone library
        $this->load->library('timezone_lib');

        // Set timezone for user
        $result = $this->timezone_lib->set_user_timezone($student_id, $timezone);

        if ($result) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => true,
                'message' => 'Zona waktu berhasil disimpan'
            ]));
        } else {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Zona waktu tidak valid'
            ]));
        }
    }
}
