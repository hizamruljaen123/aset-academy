<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kelas_model', 'kelas_model');
        $this->load->model('Free_class_model', 'free_class_model');
        $this->load->model('Testimonial_model', 'testimonial_model');
        $this->load->model('Kelas_programming_model', 'kelas_programming_model');
        $this->load->model('Materi_model', 'materi_model');
        $this->load->model('User_model', 'user_model');
        $this->load->model('Jadwal_model', 'jadwal_model');
        $this->load->model('Workshop_model', 'workshop_model');
        $this->load->model('Recruitment_model', 'recruitment_model');
        $this->load->model('Settings_model', 'settings_model');
        $this->load->helper(['url', 'text']);
    }

    public function index()
    {
        // Check if maintenance mode is enabled
        if ($this->settings_model->is_maintenance_mode()) {
            $data['maintenance_message'] = $this->settings_model->get_maintenance_message();
            $data['title'] = 'Website Sedang Dalam Pemeliharaan';
            $data['description'] = 'Website Aset Academy sedang dalam pemeliharaan. Kami akan segera kembali melayani Anda.';
            $this->load->view('home/maintenance', $data);
            return;
        }

        // Get featured premium classes
        $data['featured_premium'] = $this->kelas_model->get_popular_kelas(3);

        // Get featured free classes
        $data['featured_free'] = $this->free_class_model->get_popular_free_classes(3);

        // Get testimonials
        $data['testimonials'] = $this->testimonial_model->get_featured_testimonials(6);

        // Get upcoming workshops and seminars
        $data['upcoming_workshops'] = $this->workshop_model->get_upcoming_workshops(3);

        $data['title'] = 'Aset Academy - Belajar Programming Jadi Mudah & Menyenangkan';
        $data['description'] = 'Platform pembelajaran programming terdepan dengan berbagai kelas premium dan gratis untuk semua level. Mulai perjalanan Anda menjadi programmer handal hari ini!';

        $this->load->view('home/index', $data);
    }

    
    public function about()
    {
        $data['title'] = 'Tentang Kami - Asset Academy';
        $data['description'] = 'Pelajari lebih lanjut tentang Asset Academy dan misi kami dalam mendidik programmer masa depan.';

        $this->load->view('home/about', $data);
    }

    public function faq()
    {
        $data['title'] = 'FAQ - Asset Academy';
        $data['description'] = 'Temukan jawaban untuk pertanyaan umum tentang platform pembelajaran kami.';

        $this->load->view('home/faq', $data);
    }

    public function download_app()
    {
        $data['title'] = 'Download Aset Academy Mobile App';
        $data['description'] = 'Download aplikasi mobile Aset Academy untuk Android. Akses materi pembelajaran dan fitur interaktif dimana saja.';

        $this->load->view('home/download_app', $data);
    }

    public function premium()
    {
        $data['premium_classes'] = $this->kelas_model->get_all_kelas();
        $data['title'] = 'Kelas Premium - Asset Academy';
        $data['description'] = 'Jelajahi koleksi kelas premium kami untuk pembelajaran programming yang komprehensif.';

        $this->load->view('home/premium', $data);
    }

    public function free()
    {
        $free_classes = $this->free_class_model->get_all_free_classes();
        
        // Add material count to each class
        foreach ($free_classes as $class) {
            $materials = $this->free_class_model->get_free_class_materials($class->id);
            $class->material_count = count($materials);
        }
        
        $data['free_classes'] = $free_classes;
        $data['title'] = 'Kelas Gratis - Asset Academy';
        $data['description'] = 'Akses kelas gratis berkualitas tinggi untuk memulai perjalanan programming Anda.';

        $this->load->view('home/free', $data);
    }
    
    public function view_free_class($encrypted_class_id)
    {
        $class_id = $this->decrypt_id($encrypted_class_id, 'Class ID');
        $free_class = $this->free_class_model->get_free_class_by_id($class_id);
        
        if (!$free_class) {
            show_404();
        }
        
        if ($free_class->status != 'Published') {
            show_error('Kelas ini belum dipublikasikan', 403);
        }
        
        // Get class materials
        $materials = $this->free_class_model->get_free_class_materials($class_id);
        $free_class->material_count = count($materials);
        
        // Get enrolled students count
        $enrolled_count = $this->free_class_model->count_enrolled_students($class_id);
        
        // Get related free classes
        $related_classes = $this->free_class_model->get_recent_free_classes(3);
        
        $data['free_class'] = $free_class;
        $data['materials'] = $materials;
        $data['enrolled_count'] = $enrolled_count;
        $data['related_classes'] = $related_classes;
        $data['title'] = $free_class->title . ' - Asset Academy';
        $data['description'] = 'Lihat detail kelas gratis: ' . $free_class->title . '. ' . $free_class->description;
        
        $this->load->view('home/free_class_view', $data);
    }
    
    public function kelas_premium($encrypted_id)
    {
        $id = $this->decrypt_id($encrypted_id, 'Class ID');
        $kelas = $this->kelas_model->get_kelas_by_id($id);
        
        if (!$kelas) {
            show_404();
        }
        
        if ($kelas->status != 'Aktif') {
            show_error('Kelas ini tidak tersedia', 403);
        }
        
        // Get related materials
        $materi = $this->materi_model->get_materi_with_parts_by_kelas($id);
        
        // Get schedule
        $jadwal = $this->jadwal_model->get_jadwal_by_kelas($id);
        
        // Get attendance statistics
        $attendance_stats = $this->absensi_model->get_attendance_stats_by_class($id);
        
        // Get student progress
        $student_progress = $this->kelas_model->get_student_progress($id);
        
        // Get enrolled students count
        $enrolled_count = $this->kelas_model->count_enrolled_students($id);
        
        $data['kelas'] = $kelas;
        $data['materi'] = $materi;
        $data['jadwal'] = $jadwal;
        $data['attendance_stats'] = $attendance_stats;
        $data['student_progress'] = $student_progress;
        $data['enrolled_count'] = $enrolled_count;
        $data['title'] = $kelas->nama_kelas . ' - Detail Kelas Premium';
        $data['description'] = 'Detail lengkap kelas premium: ' . $kelas->nama_kelas . '. Pelajari apa saja yang akan Anda pelajari dalam kelas ini.';
        
        $this->load->view('kelas/detail_premium', $data);
    }
    
    public function partnership()
    {
        $data['title'] = 'Partnership & Corporate Training - Aset Academy';
        $data['description'] = 'Transformasi digital perusahaan Anda dengan program pelatihan programming terbaik. Solusi edukasi khusus untuk korporasi, institusi, dan komunitas.';

        $this->load->view('home/partnership', $data);
    }

    public function premium_class_view($encrypted_id = null)
    {
        if (!$encrypted_id) {
            show_404();
        }

        $id = $this->decrypt_id($encrypted_id, 'Premium Class ID');
        $data['kelas'] = $this->kelas_programming_model->get_kelas_by_id($id);

        if (!$data['kelas']) {
            show_404();
        }
        
        // Tambahkan deskripsi_singkat jika tidak ada
        if (!isset($data['kelas']->deskripsi_singkat)) {
            $data['kelas']->deskripsi_singkat = substr($data['kelas']->deskripsi, 0, 100) . '...';
        }

        $data['materi'] = $this->materi_model->get_materi_by_kelas($id);
        
        // Get instructor info
        $data['instruktur'] = null;
        $this->db->select('users.*');
        $this->db->from('guru_kelas');
        $this->db->join('users', 'users.id = guru_kelas.guru_id');
        $this->db->where('guru_kelas.kelas_id', $data['kelas']->id);
        $data['instruktur'] = $this->db->get()->row();

        $data['testimonials'] = []; // Initialize as empty array since model doesn't exist
        $data['total_siswa'] = $this->kelas_programming_model->count_siswa($id);
        $data['avg_rating'] = $this->kelas_programming_model->get_average_rating($id);

        // Pengecekan enrollment
        $data['sudah_bergabung'] = false;
        if ($this->session->userdata('user_id') && isset($data['kelas']->id)) {
            $user_id = $this->session->userdata('user_id');
            $data['sudah_bergabung'] = $this->kelas_programming_model->is_user_enrolled($user_id, $data['kelas']->id);
        }

        $data['title'] = $data['kelas']->nama_kelas . ' - ASET Academy';

        $this->load->view('home/premium_class_view', $data);
    }

    public function digital_solutions()
    {
        $data['title'] = 'Pengembangan Software Custom untuk UMKM - ASET Academy';
        $data['description'] = 'Pengembangan software khusus untuk kebutuhan bisnis UMKM. Sistem manajemen, aplikasi kasir, otomasi bisnis, dan solusi digital terintegrasi untuk meningkatkan efisiensi dan produktivitas.';

        $this->load->view('home/digital_solutions', $data);
    }

    public function career()
    {
        $filters = [
            'search' => $this->input->get('q', true),
            'department' => $this->input->get('department', true),
            'employment_type' => $this->input->get('employment_type', true),
            'location' => $this->input->get('location', true),
            'status_in' => ['Published']
        ];

        $filters = array_filter($filters, static function ($value) {
            if (is_array($value)) {
                return !empty($value);
            }
            return $value !== null && $value !== '';
        });

        $data['title'] = 'Karier di ASET Academy';
        $data['description'] = 'Bergabung dengan tim ASET Academy dan bantu kami membangun masa depan pendidikan teknologi.';
        $data['filters'] = $filters;
        $data['positions'] = $this->recruitment_model->get_job_positions_with_stats($filters);
        $data['departments'] = $this->recruitment_model->get_departments();
        $data['stats'] = $this->recruitment_model->get_recruitment_stats();

        try {
            $this->load->view('career/index', $data);
        } catch (Throwable $th) {
            log_message('error', 'Career page error: ' . $th->getMessage());
            $errorData = [
                'heading' => 'Terjadi Kesalahan',
                'message' => 'Maaf, kami tidak dapat menampilkan halaman karier saat ini. Silakan coba lagi nanti.',
                'error_id' => strtoupper(bin2hex(random_bytes(4)))
            ];
            $this->output->set_status_header(500);
            $this->load->view('errors/html/error_500', $errorData);
        }
    }

    public function contact()
    {
        $data['title'] = 'Hubungi Kami - Aset Academy';
        $data['description'] = 'Hubungi tim Aset Academy untuk pertanyaan, kerjasama, dan dukungan lainnya. Kami siap membantu melalui email.';

        $data['contact_channels'] = [
            'email' => 'support@asetacademy.id',
            'office' => 'Jl. Teknologi No. 123, Jakarta Selatan, Indonesia'
        ];

        $this->load->view('home/contact', $data);
    }

    public function maintenance()
    {
        $data['maintenance_message'] = $this->settings_model->get_maintenance_message();
        $data['title'] = 'Website Sedang Dalam Pemeliharaan';
        $data['description'] = 'Website Aset Academy sedang dalam pemeliharaan. Kami akan segera kembali melayani Anda.';
        $this->load->view('home/maintenance', $data);
    }
}
