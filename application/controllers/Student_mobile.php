<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_mobile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Siswa_model');
        $this->load->model('User_model');
        $this->load->model('Kelas_model');
        $this->load->model('Materi_model');
        $this->load->model('Materi_part_model');
        $this->load->model('Enrollment_model');
        $this->load->model('Jadwal_model');
        $this->load->model('Forum_model');
        $this->load->model('Absensi_model');
        $this->load->model('Free_class_model', 'free_class');
        
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        
        // Check if user is a student
        if ($this->session->userdata('role') !== 'siswa') {
            show_error('Access denied. Student role required.', 403);
        }
        
        // Load necessary helpers
        $this->load->helper('url');
        $this->load->library('pagination');
        $this->load->helper('form');
        $this->load->helper('text');
        $this->load->helper('date');
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');
        
        // Get student profile
        $data['student_profile'] = $this->Siswa_model->get_siswa_by_id($user_id);
        
        // Get student's class details
        $data['class_details'] = null;
        $data['total_materi'] = 0;
        $data['total_classmates'] = 0;
        $data['recent_materials'] = [];
        $data['available_classes'] = [];
        $data['paid_classes'] = [];
        $data['available_paid_classes'] = [];
        $data['class_materials'] = [];
        $data['classmates'] = [];
        $data['jadwal'] = [];
        
        // Check if student is enrolled in any class
        $enrollment = $this->Enrollment_model->get_active_enrollment($user_id);
        
        if ($enrollment) {
            // Get class details
            $data['class_details'] = $this->Kelas_model->get_kelas_by_id($enrollment->kelas_id);
            
            if ($data['class_details']) {
                // Get total materials for this class
                $data['total_materi'] = $this->Materi_model->count_by_kelas($enrollment->kelas_id);
                
                // Get classmates
                $data['classmates'] = $this->Enrollment_model->get_classmates($enrollment->kelas_id);
                $data['total_classmates'] = count($data['classmates']);
                
                // Get recent materials
                $data['recent_materials'] = $this->Materi_model->get_recent_by_kelas($enrollment->kelas_id, 5);
                
                // Get class materials
                $data['class_materials'] = $this->Materi_model->get_by_kelas($enrollment->kelas_id);
                
                // Get jadwal for this class
                $data['jadwal'] = $this->Jadwal_model->get_by_kelas($enrollment->kelas_id);
            }
        }
        
        // Get available classes for enrollment
        $data['available_classes'] = $this->Kelas_model->get_available_for_enrollment($user_id);
        
        // Get paid/premium classes
        $data['paid_classes'] = $this->Enrollment_model->get_paid_classes($user_id);
        $data['available_paid_classes'] = $this->Kelas_model->get_premium_classes();
        
        // Set page title
        $data['title'] = 'Dashboard Siswa - Mobile';
        
        // Load mobile views
        $this->load->view('templates/mobile_header', $data);
        $this->load->view('student/mobile/dashboard', $data);
        $this->load->view('templates/mobile_footer');
    }

    public function profile()
    {
        $user_id = $this->session->userdata('user_id');
        
        // Get student profile
        $data['student'] = $this->Siswa_model->get_siswa_by_id($user_id);
        
        // Check if profile exists
        $data['profile_exists'] = ($data['student'] !== null);
        
        // Set page title
        $data['title'] = 'Profil Siswa - Mobile';
        
        // Load mobile views
        $this->load->view('templates/mobile_header', $data);
        $this->load->view('student/mobile/profile', $data);
        $this->load->view('templates/mobile_footer');
    }

        public function absensi()
        {
            $user_id = $this->session->userdata('user_id');
            
            // Get student profile
            $data['student_profile'] = $this->Siswa_model->get_siswa_by_id($user_id);
            
            // Get attendance summary
            $data['attendance_summary'] = $this->Absensi_model->get_attendance_summary($user_id);
            $data['attendance_rate'] = $this->Absensi_model->get_attendance_rate($user_id);
            
            // Get attendance records
            $data['attendance_records'] = $this->Absensi_model->get_student_attendance($user_id, 10);
            
            // Get attendance dates for calendar
            $attendance_dates = $this->Absensi_model->get_attendance_dates($user_id);
            $data['attendance_dates'] = $attendance_dates;
            
            // Set page title
            $data['title'] = 'Absensi Siswa - Mobile';
            
            // Load mobile views
            $this->load->view('templates/mobile_header', $data);
            $this->load->view('student/mobile/absensi', $data);
            $this->load->view('templates/mobile_footer');
        }
    
        public function kelas()
        {
            $user_id = $this->session->userdata('user_id');
            
            // Get student profile
            $data['student_profile'] = $this->Siswa_model->get_siswa_by_id($user_id);
            
            // Get active classes
            $data['active_classes'] = $this->Enrollment_model->get_student_classes($user_id, 'Aktif');
            
            // Get completed classes
            $data['completed_classes'] = $this->Enrollment_model->get_student_classes($user_id, 'Selesai');
            
            // Get premium classes
            $data['premium_classes'] = $this->Kelas_model->get_premium_classes();
            
            // Set page title
            $data['title'] = 'Kelas Saya - Mobile';
            
            // Load mobile views
            $this->load->view('templates/mobile_header', $data);
            $this->load->view('student/mobile/kelas', $data);
            $this->load->view('templates/mobile_footer');
        }
    
        public function jadwal()
        {
            $user_id = $this->session->userdata('user_id');
            
            // Get student profile
            $data['student_profile'] = $this->Siswa_model->get_siswa_by_id($user_id);
            
            // Get student's class enrollment
            $enrollment = $this->Enrollment_model->get_active_enrollment($user_id);
            $kelas_id = $enrollment ? $enrollment->kelas_id : null;
            
            // Initialize data array
            $data['schedule'] = [];
            $data['today_schedule'] = [];
            $data['upcoming_classes'] = [];
            $data['calendar_classes'] = [];
            
            if ($kelas_id) {
                // Get all schedule for the class
                $data['schedule'] = $this->Jadwal_model->get_jadwal_by_kelas($kelas_id);
                
                // Get today's schedule
                $today = date('Y-m-d');
                $this->db->where('kelas_id', $kelas_id);
                $this->db->where('tanggal_pertemuan', $today);
                $this->db->order_by('waktu_mulai', 'ASC');
                $data['today_schedule'] = $this->db->get('jadwal_kelas')->result();
                
                // Get upcoming classes (next 5)
                $this->db->where('kelas_id', $kelas_id);
                $this->db->where('tanggal_pertemuan >=', $today);
                $this->db->order_by('tanggal_pertemuan', 'ASC');
                $this->db->order_by('waktu_mulai', 'ASC');
                $this->db->limit(5);
                $data['upcoming_classes'] = $this->db->get('jadwal_kelas')->result();
                
                // Format for calendar
                foreach ($data['schedule'] as $item) {
                    $data['calendar_classes'][] = [
                        'title' => 'Kelas ' . $item->nama_kelas,
                        'start' => $item->tanggal_pertemuan . 'T' . $item->waktu_mulai,
                        'end' => $item->tanggal_pertemuan . 'T' . $item->waktu_selesai,
                        'className' => 'bg-blue-500'
                    ];
                }
            }
            
            // Set page title
            $data['title'] = 'Jadwal Kelas - Mobile';
            
            // Load mobile views
            $this->load->view('templates/mobile_header', $data);
            $this->load->view('student/mobile/jadwal', $data);
            $this->load->view('templates/mobile_footer');
        }
    
        public function enrollment()
        {
            $user_id = $this->session->userdata('user_id');
            
            // Get student profile
            $data['student_profile'] = $this->Siswa_model->get_siswa_by_id($user_id);
            
            // Get available classes
            $data['featured_classes'] = $this->Kelas_model->get_featured_classes(5);
            $data['free_classes'] = $this->Kelas_model->get_free_classes();
            $data['premium_classes'] = $this->Kelas_model->get_premium_classes();
            
            // Set page title
            $data['title'] = 'Daftar Kelas - Mobile';
            
            // Load mobile views
            $this->load->view('templates/mobile_header', $data);
            $this->load->view('student/mobile/enrollment', $data);
            $this->load->view('templates/mobile_footer');
        }
    
        public function browse_classes()
        {
            $user_id = $this->session->userdata('user_id');
            
            // Get student profile
            $data['student_profile'] = $this->Siswa_model->get_siswa_by_id($user_id);
            
            // Get free classes with enrollment counts
            $free_classes = $this->free_class->get_all_free_classes();
            foreach ($free_classes as $class) {
                $class->enrollment_count = $this->free_class->count_enrolled_students($class->id);
            }
            $data['free_classes'] = $free_classes;
            
            // Get premium classes with enrollment counts
            $premium_classes = $this->Kelas_model->get_all_kelas();
            foreach ($premium_classes as $class) {
                $class->enrollment_count = $this->Kelas_model->count_enrolled_students($class->id);
            }
            $data['premium_classes'] = $premium_classes;
            
            // Set page title
            $data['title'] = 'Jelajahi Kelas - Mobile';
            
            // Load mobile views
            $this->load->view('templates/mobile_header', $data);
            $this->load->view('student/mobile/browse_classes', $data);
            $this->load->view('templates/mobile_footer');
        }
    
        public function browse_premium()
        {
            $user_id = $this->session->userdata('user_id');
            
            // Get student profile
            $data['student_profile'] = $this->Siswa_model->get_siswa_by_id($user_id);
            
            // Get premium classes
            $data['premium_classes'] = $this->Kelas_model->get_premium_classes();
            
            // Set page title
            $data['title'] = 'Kelas Premium - Mobile';
            
            // Load mobile views
            $this->load->view('templates/mobile_header', $data);
            $this->load->view('student/mobile/browse_premium', $data);
            $this->load->view('templates/mobile_footer');
        }
    
        public function premium_detail($kelas_id)
        {
            $user_id = $this->session->userdata('user_id');
            
            // Get student profile
            $data['student_profile'] = $this->Siswa_model->get_siswa_by_id($user_id);
            
            // Get class details
            $data['kelas'] = $this->Kelas_model->get_kelas_by_id($kelas_id);
            
            if (!$data['kelas']) {
                show_404();
            }
            
            // Check if student is already enrolled
            $data['is_enrolled'] = $this->Enrollment_model->is_enrolled($user_id, $kelas_id);
            
            // Get class materials
            $data['materials'] = $this->Materi_model->get_materi_by_kelas($kelas_id);
            
            // Get class schedule
            $data['schedule'] = $this->Jadwal_model->get_jadwal_by_kelas($kelas_id);
            
            // Set page title
            $data['title'] = $data['kelas']->nama_kelas . ' - Mobile';
            
            // Load mobile views
            $this->load->view('templates/mobile_header', $data);
            $this->load->view('student/mobile/premium_detail', $data);
            $this->load->view('templates/mobile_footer');
        }
    
        public function materi()
        {
            $user_id = $this->session->userdata('user_id');
            $kelas_id = $this->input->get('kelas_id');
            
            // Get student profile
            $data['student_profile'] = $this->Siswa_model->get_siswa_by_id($user_id);
            
            if ($kelas_id) {
                // Get materials for specific class
                $data['materials'] = $this->Materi_model->get_materi_by_kelas($kelas_id);
                $kelas = $this->Kelas_model->get_kelas_by_id($kelas_id);
                $data['class_name'] = $kelas ? $kelas->nama_kelas : 'Kelas tidak ditemukan';
            } else {
                // Get materials for enrolled class
                $enrollment = $this->Enrollment_model->get_active_enrollment($user_id);
                if ($enrollment) {
                    $data['materials'] = $this->Materi_model->get_materi_by_kelas($enrollment->kelas_id);
                    $kelas = $this->Kelas_model->get_kelas_by_id($enrollment->kelas_id);
                    $data['class_name'] = $kelas ? $kelas->nama_kelas : 'Kelas tidak ditemukan';
                } else {
                    $data['materials'] = [];
                    $data['class_name'] = 'Tidak ada kelas aktif';
                }
            }
            
            // Set page title
            $data['title'] = 'Materi Pembelajaran - Mobile';
            
            // Load mobile views
            $this->load->view('templates/mobile_header', $data);
            $this->load->view('student/mobile/materi', $data);
            $this->load->view('templates/mobile_footer');
        }

    public function materi_detail($materi_id)
    {
        $user_id = $this->session->userdata('user_id');
        
        // Get material details
        $data['materi'] = $this->Materi_model->get_materi_by_id($materi_id);
        
        if (!$data['materi']) {
            show_404();
        }
        
        // Check if student is enrolled in the class
        $enrollment = $this->Enrollment_model->get_active_enrollment($user_id);
        
        if ($enrollment) {
            $student_class = $this->Kelas_model->get_kelas_by_id($enrollment->kelas_id);
            $data['student_class'] = $student_class ? $student_class->nama_kelas : 'Tidak diketahui';
        } else {
            $data['student_class'] = 'Tidak terdaftar';
        }
        
        // Check access restriction
        $data['restricted_access'] = false;
        if ($enrollment && $data['materi']->kelas_id != $enrollment->kelas_id) {
            $material_class = $this->Kelas_model->get_kelas_by_id($data['materi']->kelas_id);
            $data['material_class'] = $material_class ? $material_class->nama_kelas : 'Tidak diketahui';
            $data['restricted_access'] = true;
        }
        
        // Get material parts
        $data['parts'] = $this->Materi_part_model->get_parts_by_materi_id($materi_id);
        
        // Set page title
        $data['title'] = $data['materi']->judul . ' - Mobile';
        
        // Load mobile views
        $this->load->view('templates/mobile_header', $data);
        $this->load->view('student/mobile/materi_detail', $data);
        $this->load->view('templates/mobile_footer');
    }
    
    public function my_classes()
    {
        $user_id = $this->session->userdata('user_id');
        
        // Get student profile
        $data['student_profile'] = $this->Siswa_model->get_siswa_by_id($user_id);
        
        // Get all enrolled classes
        $enrollments = $this->free_class->get_all_enrolled_classes($user_id);

        foreach ($enrollments as $enrollment) {
            $enrollment->attendance = $this->free_class->get_student_attendance_by_class($user_id, $enrollment->id) ?? [];
            $enrollment->classmates = $this->free_class->get_enrolled_students($enrollment->id) ?? [];
        }

        $data['enrollments'] = $enrollments;
        $data['progress_stats'] = $this->free_class->get_progress_stats($user_id);

        // Set page title
        $data['title'] = 'Kelas Saya - Mobile';
        
        // Load mobile views
        $this->load->view('templates/mobile_header', $data);
        $this->load->view('student/mobile/my_classes', $data);
        $this->load->view('templates/mobile_footer');
    }

    /**
     * Forum main method - handles forum index, category, and thread viewing
     */
    public function forum($method = 'index', $param1 = null, $param2 = null)
    {
        // Check which forum method to call
        $method_name = '_forum_' . $method;
        if (method_exists($this, $method_name)) {
            // Call the appropriate method
            $this->$method_name($param1, $param2);
        } else {
            // Default to forum index
            $this->_forum_index();
        }
    }
    
    /**
     * Display forum index page with recent threads
     */
    private function _forum_index()
    {
        // Get user data
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->get_user_by_id($user_id);
        
        // Get forum categories
        $data['categories'] = $this->Forum_model->get_categories();
        
        // Pagination configuration
        $per_page = 10;
        $page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
        $offset = ($page - 1) * $per_page;
        
        // Get recent threads with pagination
        $data['threads'] = $this->Forum_model->get_recent_threads($per_page, $offset);
        
        // Check if there are more threads to load
        $total_threads = $this->db->count_all_results('forum_threads');
        $data['has_more'] = ($offset + count($data['threads'])) < $total_threads;
        
        // Set page title
        $data['title'] = 'Forum Diskusi - Mobile';
        
        // Load views
        $this->load->view('templates/mobile_header', $data);
        $this->load->view('student/mobile/forum', $data);
        $this->load->view('templates/mobile_footer');
    }
    
    /**
     * Mobile payment initiation page
     */
    public function payment($class_id)
    {
        $user_id = $this->session->userdata('user_id');
        
        // Load required models
        $this->load->model('Kelas_programming_model');
        $this->load->model('Payment_model');
        $this->load->model('Company_bank_model');
        
        // Get class details
        $class = $this->Kelas_programming_model->get_kelas_by_id($class_id);
        if (!$class) {
            show_404();
        }
        
        // Check if already enrolled
        $is_enrolled = $this->db->where([
            'class_id' => $class_id,
            'user_id' => $user_id,
            'status' => 'Verified'
        ])->get('payments')->row();
        
        if ($is_enrolled) {
            $this->session->set_flashdata('message', 'Anda sudah memiliki akses ke kelas ini.');
            redirect('student_mobile');
        }
        
        // Check for pending payment
        $pending_payment = $this->db->where([
            'class_id' => $class_id,
            'user_id' => $user_id,
            'status' => 'Pending'
        ])->get('payments')->row();
        
        if ($pending_payment) {
            $this->session->set_flashdata('message', 'Anda sudah memiliki pembayaran yang sedang diverifikasi');
            redirect('payment/status/' . $pending_payment->id);
        }
        
        // Get active bank accounts
        $bank_accounts = $this->Company_bank_model->get_active_bank_accounts();
        
        $data = [
            'title' => 'Pembayaran Kelas - Mobile',
            'class' => $class,
            'bank_accounts' => $bank_accounts,
            'user' => $this->User_model->get_user_by_id($user_id)
        ];
        
        // Load mobile payment view
        $this->load->view('templates/mobile_header', $data);
        $this->load->view('student/mobile/payment', $data);
        $this->load->view('templates/mobile_footer');
    }
    
    /**
     * Display user's payment orders with status filtering
     */
    public function orders()
    {
        $user_id = $this->session->userdata('user_id');
        
        // Load payment model
        $this->load->model('Payment_model');
        $this->load->model('Kelas_programming_model');
        
        // Get all user payments with class details
        $payments = $this->Payment_model->get_user_payments($user_id);
        
        // Categorize payments by status
        $data['pending_payments'] = [];
        $data['paid_payments'] = [];
        $data['all_payments'] = $payments;
        
        foreach ($payments as $payment) {
            // Get class details for each payment
            $payment->class = $this->Kelas_programming_model->get_kelas_by_id($payment->class_id);
            
            if ($payment->status === 'Pending') {
                $data['pending_payments'][] = $payment;
            } elseif ($payment->status === 'Verified' || $payment->status === 'Completed') {
                $data['paid_payments'][] = $payment;
            }
        }
        
        $data['title'] = 'Daftar Pemesanan - Mobile';
        
        // Load mobile orders view
        $this->load->view('templates/mobile_header', $data);
        $this->load->view('student/mobile/orders', $data);
        $this->load->view('templates/mobile_footer');
    }
    
    /**
     * Display threads in a specific category
     */
    private function _forum_category($category_id = null)
    {
        // Get user data
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->get_user_by_id($user_id);
        
        // Get category info
        $data['category'] = $this->Forum_model->get_category($category_id);
        if (!$data['category']) {
            show_404();
        }
        
        // Pagination configuration
        $per_page = 10;
        $page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
        $offset = ($page - 1) * $per_page;
        
        // Get threads in this category with pagination
        $data['threads'] = $this->Forum_model->get_threads_by_category($category_id, $per_page, $offset);
        
        // Check if there are more threads to load
        $total_threads = $this->Forum_model->count_threads_by_category($category_id);
        $data['has_more'] = ($offset + count($data['threads'])) < $total_threads;
        
        // Set page title
        $data['title'] = $data['category']->name . ' - Forum - Mobile';
        
        // Load views
        $this->load->view('templates/mobile_header', $data);
        $this->load->view('student/mobile/forum_category', $data);
        $this->load->view('templates/mobile_footer');
    }
    
    /**
     * Display a single thread with its replies (Clean version without header)
     */
    public function forum_thread_clean($thread_id = null, $slug = null)
    {
        // Get user data
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->get_user_by_id($user_id);
        
        // Get thread data
        $data['thread'] = $this->Forum_model->get_thread($thread_id);
        if (!$data['thread']) {
            show_404();
        }
        
        // Verify slug
        $correct_slug = url_title($data['thread']->title, '-', true);
        if ($slug !== $correct_slug) {
            redirect('student_mobile/forum_thread_clean/' . $thread_id . '/' . $correct_slug);
        }
        
        // Get thread replies
        $data['replies'] = $this->Forum_model->get_thread_replies($thread_id);
        
        // Record view
        $this->Forum_model->record_view($thread_id, $user_id);
        
        // Set page title
        $data['title'] = $data['thread']->title . ' - Forum - Mobile';
        
        $this->load->view('templates/mobile_header', $data);
        $this->load->view('student/mobile/forum_thread_clean', $data);
        $this->load->view('templates/mobile_footer');
    }
    
    /**
     * Display a single thread with its replies
     */
    private function _forum_thread($thread_id = null, $slug = null)
    {
        // Get user data
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->get_user_by_id($user_id);
        
        // Get thread data
        $data['thread'] = $this->Forum_model->get_thread($thread_id);
        if (!$data['thread']) {
            show_404();
        }
        
        // Verify slug
        $correct_slug = url_title($data['thread']->title, '-', true);
        if ($slug !== $correct_slug) {
            redirect('student_mobile/forum/thread/' . $thread_id . '/' . $correct_slug);
        }
        
        // Get thread replies
        $data['replies'] = $this->Forum_model->get_thread_replies($thread_id);
        
        // Record view
        $this->Forum_model->record_view($thread_id, $user_id);
        
        // Set page title
        $data['title'] = $data['thread']->title . ' - Forum - Mobile';
        
        // Load views
        $this->load->view('templates/mobile_header', $data);
        $this->load->view('student/mobile/forum_thread', $data);
        $this->load->view('templates/mobile_footer');
    }
    
    /**
     * Handle forum reply submission
     */
    private function _forum_reply($thread_id)
    {
        // Validate thread exists
        $thread = $this->Forum_model->get_thread($thread_id);
        if (!$thread) {
            show_404();
        }
        
        // Process the reply submission
        $this->_forum_save_reply($thread_id);
    }
    
    /**
     * Display form to create a new thread
     */
    private function _forum_create()
    {
        // Get user data
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->get_user_by_id($user_id);
        
        // Get categories for dropdown
        $data['categories'] = $this->Forum_model->get_categories();
        
        // Set page title
        $data['title'] = 'Buat Thread Baru - Forum - Mobile';
        
        // Load form validation library
        $this->load->library('form_validation');
        
        // Set validation rules
        $this->form_validation->set_rules('title', 'Judul', 'required|min_length[10]|max_length[200]');
        $this->form_validation->set_rules('content', 'Isi', 'required|min_length[10]');
        $this->form_validation->set_rules('category_id', 'Kategori', 'required|numeric');
        
        if ($this->form_validation->run() === FALSE) {
            // Form not submitted or validation failed, show the form
            $this->load->view('templates/mobile_header', $data);
            $this->load->view('student/mobile/forum_create', $data);
            $this->load->view('templates/mobile_footer');
        } else {
            // Form submitted and validated, save the thread
            $this->_forum_save_thread();
        }
    }
    
    /**
     * Save a new thread to the database
     */
    private function _forum_save_thread()
    {
        // Get user ID
        $user_id = $this->session->userdata('user_id');
        
        // Prepare thread data
        $thread_data = array(
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'category_id' => $this->input->post('category_id'),
            'user_id' => $user_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        
        // Save thread
        $thread_id = $this->Forum_model->create_thread($thread_data);
        
        if ($thread_id) {
            // Thread created successfully
            $this->session->set_flashdata('success', 'Thread berhasil dibuat!');
            redirect('student_mobile/forum/thread/' . $thread_id . '/' . url_title($thread_data['title'], '-', true));
        } else {
            // Error creating thread
            $this->session->set_flashdata('error', 'Gagal membuat thread. Silakan coba lagi.');
            redirect('student_mobile/forum/create');
        }
    }
    
    /**
     * Save a reply to a thread
     */
    private function _forum_save_reply($thread_id)
    {
        // Get user ID
        $user_id = $this->session->userdata('user_id');
        
        // Validate thread exists
        $thread = $this->Forum_model->get_thread($thread_id);
        if (!$thread) {
            show_404();
        }
        
        // Load form validation library
        $this->load->library('form_validation');
        
        // Set validation rules
        $this->form_validation->set_rules('content', 'Isi Balasan', 'required|min_length[5]');
        
        if ($this->form_validation->run() === FALSE) {
            // Validation failed, redirect back to thread
            $this->session->set_flashdata('error', validation_errors());
            redirect('student_mobile/forum/thread/' . $thread_id . '/' . url_title($thread->title, '-', true));
        } else {
            // Prepare reply data
            $reply_data = array(
                'thread_id' => $thread_id,
                'user_id' => $user_id,
                'parent_id' => NULL, // Reply langsung ke thread
                'content' => $this->input->post('content'),
                'created_at' => date('Y-m-d H:i:s')
            );
            
            // Save reply
            $reply_id = $this->Forum_model->create_post($reply_data);
            
            if ($reply_id) {
                // Reply created successfully
                $this->session->set_flashdata('success', 'Balasan berhasil dikirim!');
            } else {
                // Error creating reply
                $this->session->set_flashdata('error', 'Gagal mengirim balasan. Silakan coba lagi.');
            }
            
            // Redirect back to thread
            redirect('student_mobile/forum/thread/' . $thread_id . '/' . url_title($thread->title, '-', true) . '#reply-' . $reply_id);
        }
    }

    public function free_class_detail($class_id)
    {
        $user_id = $this->session->userdata('user_id');
        
        // Get student profile
        $data['student_profile'] = $this->Siswa_model->get_siswa_by_id($user_id);
        
        // Get class details
        $data['free_class'] = $this->free_class->get_free_class_by_id($class_id);
        if (!$data['free_class'] || $data['free_class']->status != 'Published') {
            show_404();
        }
        
        // Get class materials
        $data['materials'] = $this->free_class->get_free_class_materials($class_id);
        $data['enrolled_count'] = $this->free_class->count_enrolled_students($class_id);
        $data['is_enrolled'] = $this->free_class->is_enrolled($user_id, $class_id);
        $data['is_full'] = ($data['free_class']->max_students && $data['enrolled_count'] >= $data['free_class']->max_students);
        $data['discussions'] = $this->free_class->get_free_class_discussions($class_id);
        $data['enrolled_students'] = $this->free_class->get_enrolled_students($class_id);
        $data['jadwal'] = $this->free_class->get_class_schedule($class_id);
        
        if ($data['is_enrolled']) {
            $data['enrollment'] = $this->free_class->get_enrollment($user_id, $class_id);
        }
        
        // Set page title
        $data['title'] = $data['free_class']->title . ' - Mobile';
        
        // Load mobile views
        $this->load->view('templates/mobile_header', $data);
        $this->load->view('student/mobile/free_class_detail', $data);
        $this->load->view('templates/mobile_footer');
    }

    public function enroll_free_class($class_id)
    {
        $user_id = $this->session->userdata('user_id');
        
        $class = $this->free_class->get_free_class_by_id($class_id);

        if (!$class || $class->status != 'Published') {
            $this->session->set_flashdata('error', 'Kelas tidak ditemukan.');
            redirect('student_mobile/browse_classes');
        }

        if ($this->free_class->is_enrolled($user_id, $class_id)) {
            $this->session->set_flashdata('error', 'Anda sudah terdaftar di kelas ini.');
            redirect('student_mobile/free_class_detail/' . $class_id);
        }

        $enrolled_count = $this->free_class->count_enrolled_students($class_id);
        if ($class->max_students && $enrolled_count >= $class->max_students) {
            $this->session->set_flashdata('error', 'Kelas ini sudah penuh.');
            redirect('student_mobile/free_class_detail/' . $class_id);
        }

        if ($this->free_class->enroll_student($user_id, $class_id)) {
            $this->session->set_flashdata('success', 'Anda berhasil mendaftar di kelas ini!');
            redirect('student_mobile/my_classes');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat mendaftar.');
            redirect('student_mobile/free_class_detail/' . $class_id);
        }
    }
}