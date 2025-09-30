<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Free_classes extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Free_class_model');
        $this->load->model('Enrollment_model');
        $this->load->library('Permission');
        
        // Check if user is logged in and has student role
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        
        // Debug: Check user role
        $role = $this->session->userdata('role');
        if ($role !== 'siswa') {
            show_error('Access denied. Current role: ' . $role . '. Student role (siswa) required.', 403);
        }
    }

    public function index()
    {
        $student_id = $this->session->userdata('user_id');
        
        // Get enrolled classes
        $data['enrolled_classes'] = $this->Enrollment_model->get_student_enrollments($student_id, 'Enrolled');
        
        // Get completed classes
        $data['completed_classes'] = $this->Enrollment_model->get_student_enrollments($student_id, 'Completed');
        
        // Get popular classes
        $data['popular_classes'] = $this->Free_class_model->get_popular_free_classes(5);
        
        // Get recent classes
        $data['recent_classes'] = $this->Free_class_model->get_recent_free_classes(5);
        
        // Get progress statistics
        $data['progress_stats'] = $this->Enrollment_model->get_student_progress_stats($student_id);
        
        $data['title'] = 'Kelas Gratis';
        $this->load->view('templates/header', $data);
        $this->load->view('student/free_classes/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function browse()
    {
        $keyword = $this->input->get('keyword');
        $category = $this->input->get('category');
        $level = $this->input->get('level');
        
        $data['free_classes'] = $this->Free_class_model->search_free_classes($keyword, $category, $level);
        $data['categories'] = $this->Free_class_model->get_categories();
        $data['search_params'] = [
            'keyword' => $keyword,
            'category' => $category,
            'level' => $level
        ];
        
        $data['title'] = 'Jelajahi Kelas Gratis';
        $this->load->view('templates/header', $data);
        $this->load->view('student/free_classes/browse', $data);
        $this->load->view('templates/footer');
    }
    
    public function view($class_id)
    {
        $student_id = $this->session->userdata('user_id');
        $free_class = $this->Free_class_model->get_free_class_by_id($class_id);
        
        if (!$free_class) {
            show_error('Kelas gratis tidak ditemukan', 404);
        }
        
        if ($free_class->status != 'Published') {
            show_error('Kelas ini belum dipublikasikan', 403);
        }
        
        // Check if student is enrolled
        $enrollment = $this->Enrollment_model->get_enrollment($class_id, $student_id);
        $data['is_enrolled'] = ($enrollment !== null);
        $data['enrollment'] = $enrollment;
        
        // Get class materials
        $data['materials'] = $this->Free_class_model->get_free_class_materials($class_id);
        
        // Get enrolled students count
        $data['enrolled_count'] = $this->Free_class_model->count_enrolled_students($class_id);
        
        // Check if class has reached max students
        $data['is_full'] = ($free_class->max_students !== null && $data['enrolled_count'] >= $free_class->max_students);
        
        $data['free_class'] = $free_class;
        $data['title'] = $free_class->title;
        
        $this->load->view('templates/header', $data);
        $this->load->view('student/free_classes/view', $data);
        $this->load->view('templates/footer');
    }
    
    public function enroll($class_id)
    {
        $student_id = $this->session->userdata('user_id');
        $free_class = $this->Free_class_model->get_free_class_by_id($class_id);
        
        if (!$free_class) {
            show_error('Kelas gratis tidak ditemukan', 404);
        }
        
        if ($free_class->status != 'Published') {
            show_error('Kelas ini belum dipublikasikan', 403);
        }
        
        // Check if class has reached max students
        $enrolled_count = $this->Free_class_model->count_enrolled_students($class_id);
        if ($free_class->max_students !== null && $enrolled_count >= $free_class->max_students) {
            $this->session->set_flashdata('error', 'Kelas sudah penuh');
            redirect('student/free_classes/view/' . $class_id);
        }
        
        // Enroll student
        $enrollment_id = $this->Enrollment_model->enroll_student($class_id, $student_id);
        
        if ($enrollment_id) {
            $this->session->set_flashdata('success', 'Anda berhasil mendaftar ke kelas ini');
            redirect('student/free_classes/learn/' . $enrollment_id);
        } else {
            $this->session->set_flashdata('error', 'Anda sudah terdaftar di kelas ini');
            redirect('student/free_classes/view/' . $class_id);
        }
    }
    
    public function learn($enrollment_id)
    {
        $student_id = $this->session->userdata('user_id');
        $enrollment = $this->Enrollment_model->get_enrollment_details($enrollment_id);

        if (!$enrollment || $enrollment->student_id != $student_id) {
            show_error('Data pendaftaran tidak ditemukan', 404);
        }

        // Get class materials
        $data['materials'] = $this->Free_class_model->get_free_class_materials($enrollment->class_id);

        // Get class schedule
        $this->load->model('Jadwal_model');
        $data['jadwal'] = $this->Jadwal_model->get_free_class_jadwal($enrollment->class_id);

        // Load timezone library
        $this->load->library('timezone_lib');

        // Check attendance status for each schedule
        $data['attendance_status'] = [];
        $data['can_attend_now'] = false;

        foreach ($data['jadwal'] as $jadwal) {
            $attendance_record = $this->timezone_lib->get_student_attendance($jadwal->id, $student_id);

            if ($attendance_record) {
                $data['attendance_status'][$jadwal->id] = [
                    'status' => $attendance_record->status,
                    'catatan' => $attendance_record->catatan,
                    'waktu_absen' => $attendance_record->created_at
                ];
            } else {
                // Check if can attend now
                $can_attend = $this->timezone_lib->can_attend_schedule($jadwal, $student_id);
                $attendance_status = $this->timezone_lib->get_attendance_status($jadwal, $student_id);

                $data['attendance_status'][$jadwal->id] = [
                    'status' => 'not_attended',
                    'can_attend' => $can_attend,
                    'attendance_status' => $attendance_status
                ];

                if ($can_attend) {
                    $data['can_attend_now'] = true;
                    $data['current_schedule'] = $jadwal;
                }
            }
        }

        // Get material progress
        $data['progress'] = $this->Enrollment_model->get_all_material_progress($enrollment_id);

        // Get discussions
        $data['discussions'] = $this->Free_class_model->get_free_class_discussions($enrollment->class_id);

        $data['enrollment'] = $enrollment;
        $data['title'] = 'Belajar - ' . $enrollment->title;

        $this->load->view('templates/header', $data);
        $this->load->view('student/free_classes/learn', $data);
        $this->load->view('templates/footer');
    }

    public function submit_attendance()
    {
        $student_id = $this->session->userdata('user_id');
        $jadwal_id = $this->input->post('jadwal_id');
        $enrollment_id = $this->input->post('enrollment_id');

        if (!$student_id || !$jadwal_id) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Data tidak lengkap'
            ]));
            return;
        }

        // Validasi enrollment
        $enrollment = $this->Enrollment_model->get_enrollment_details($enrollment_id);
        if (!$enrollment || $enrollment->student_id != $student_id) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Data pendaftaran tidak valid'
            ]));
            return;
        }

        // Load timezone library
        $this->load->library('timezone_lib');

        // Check if already attended
        if ($this->timezone_lib->has_student_attended($jadwal_id, $student_id)) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Anda sudah mengisi absensi untuk jadwal ini'
            ]));
            return;
        }

        // Get jadwal details
        $jadwal = $this->db->get_where('jadwal_kelas_view', ['id' => $jadwal_id])->row();
        if (!$jadwal) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Jadwal tidak ditemukan'
            ]));
            return;
        }

        // Check if within attendance window
        if (!$this->timezone_lib->can_attend_schedule($jadwal, $student_id)) {
            $status = $this->timezone_lib->get_attendance_status($jadwal, $student_id);
            $message = ($status === 'late') ? 'Waktu absensi sudah terlewat' : 'Belum waktunya absensi';
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => $message
            ]));
            return;
        }

        // Insert attendance record
        $attendance_data = [
            'jadwal_id' => $jadwal_id,
            'siswa_id' => $student_id,
            'status' => 'Hadir',
            'catatan' => 'Absensi otomatis via sistem',
            'created_at' => date('Y-m-d H:i:s')
        ];

        $result = $this->db->insert('absensi', $attendance_data);

        if ($result) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => true,
                'message' => 'Absensi berhasil dicatat',
                'attendance_time' => date('d M Y H:i:s')
            ]));
        } else {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Gagal mencatat absensi'
            ]));
        }
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

    public function material($enrollment_id, $material_id)
    {
        $student_id = $this->session->userdata('user_id');
        $enrollment = $this->Enrollment_model->get_enrollment_details($enrollment_id);
        
        if (!$enrollment || $enrollment->student_id != $student_id) {
            show_error('Data pendaftaran tidak ditemukan', 404);
        }
        
        $material = $this->Free_class_model->get_free_class_material_by_id($material_id);
        
        if (!$material || $material->class_id != $enrollment->class_id) {
            show_error('Materi tidak ditemukan', 404);
        }
        
        // Get material progress
        $progress = $this->Enrollment_model->get_material_progress($enrollment_id, $material_id);
        
        // Update last accessed time if not completed
        if ($progress && $progress->status != 'Completed') {
            $this->Enrollment_model->update_material_progress($enrollment_id, $material_id, 'In Progress');
        }
        
        // Get all materials for navigation
        $data['all_materials'] = $this->Free_class_model->get_free_class_materials($enrollment->class_id);
        
        // Find next and previous materials
        $data['next_material'] = null;
        $data['prev_material'] = null;
        
        foreach ($data['all_materials'] as $index => $m) {
            if ($m->id == $material_id) {
                if ($index > 0) {
                    $data['prev_material'] = $data['all_materials'][$index - 1];
                }
                if ($index < count($data['all_materials']) - 1) {
                    $data['next_material'] = $data['all_materials'][$index + 1];
                }
                break;
            }
        }
        
        $data['enrollment'] = $enrollment;
        $data['material'] = $material;
        $data['progress'] = $progress;
        $data['title'] = $material->title;
        
        $this->load->view('templates/header', $data);
        $this->load->view('student/free_classes/material', $data);
        $this->load->view('templates/footer');
    }
    
    public function complete_material($enrollment_id, $material_id)
    {
        $student_id = $this->session->userdata('user_id');
        $enrollment = $this->Enrollment_model->get_enrollment_details($enrollment_id);
        
        if (!$enrollment || $enrollment->student_id != $student_id) {
            show_error('Data pendaftaran tidak ditemukan', 404);
        }
        
        $material = $this->Free_class_model->get_free_class_material_by_id($material_id);
        
        if (!$material || $material->class_id != $enrollment->class_id) {
            show_error('Materi tidak ditemukan', 404);
        }
        
        // Mark material as completed
        $this->Enrollment_model->update_material_progress($enrollment_id, $material_id, 'Completed');
        
        // Find next material
        $next_material = null;
        $materials = $this->Free_class_model->get_free_class_materials($enrollment->class_id);
        
        foreach ($materials as $index => $m) {
            if ($m->id == $material_id && $index < count($materials) - 1) {
                $next_material = $materials[$index + 1];
                break;
            }
        }
        
        $this->session->set_flashdata('success', 'Materi berhasil diselesaikan');
        
        if ($next_material) {
            redirect('student/free_classes/material/' . $enrollment_id . '/' . $next_material->id);
        } else {
            redirect('student/free_classes/learn/' . $enrollment_id);
        }
    }
    
    public function post_discussion()
    {
        $student_id = $this->session->userdata('user_id');
        $class_id = $this->input->post('class_id');
        $parent_id = $this->input->post('parent_id');
        $message = $this->input->post('message');
        
        if (empty($message)) {
            $this->session->set_flashdata('error', 'Pesan tidak boleh kosong');
            redirect('student/free_classes/view/' . $class_id);
        }
        
        $discussion_data = [
            'class_id' => $class_id,
            'user_id' => $student_id,
            'parent_id' => $parent_id ? $parent_id : null,
            'message' => $message
        ];
        
        if ($this->Free_class_model->create_free_class_discussion($discussion_data)) {
            $this->session->set_flashdata('success', 'Diskusi berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan diskusi');
        }
        
        redirect('student/free_classes/view/' . $class_id);
    }
    
    public function my_classes()
    {
        $student_id = $this->session->userdata('user_id');
        
        // Get all enrollments
        $data['enrollments'] = $this->Enrollment_model->get_student_enrollments($student_id);
        
        // Get progress statistics
        $data['progress_stats'] = $this->Enrollment_model->get_student_progress_stats($student_id);
        
        $data['title'] = 'Kelas Saya';
        $this->load->view('templates/header', $data);
        $this->load->view('student/free_classes/my_classes', $data);
        $this->load->view('templates/footer');
    }
}
