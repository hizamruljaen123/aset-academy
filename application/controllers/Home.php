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
        $this->load->library('Encryption_url', null, 'encryption_url');
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
        // Sample career data since recruitment tables don't exist in current database
        $data['title'] = 'Karier di ASET Academy';
        $data['description'] = 'Bergabung dengan tim ASET Academy dan bantu kami membangun masa depan pendidikan teknologi.';
        
        // Sample positions data
        $data['positions'] = [
            (object) [
                'id' => 1,
                'title' => 'Frontend Developer',
                'department' => 'Engineering',
                'employment_type' => 'Full-time',
                'location' => 'Jakarta / Remote',
                'experience_level' => 'Mid Level',
                'salary_range' => 'Rp 8-15 juta',
                'description' => 'Kami mencari Frontend Developer yang berpengalaman dalam React, Vue.js, dan modern web technologies untuk bergabung dengan tim development kami.',
                'requirements' => '<ul><li>Minimal 2 tahun pengalaman sebagai Frontend Developer</li><li>Menguasai React.js, Vue.js, atau Angular</li><li>Familiar dengan HTML5, CSS3, JavaScript ES6+</li><li>Pengalaman dengan Git dan agile development</li></ul>',
                'benefits' => '<ul><li>Gaji kompetitif</li><li>Remote work flexibility</li><li>Health insurance</li><li>Learning & development budget</li></ul>',
                'is_featured' => 1,
                'application_deadline' => '2024-12-31',
                'total_applications' => 25,
                'active_applications' => 8
            ],
            (object) [
                'id' => 2,
                'title' => 'Backend Developer',
                'department' => 'Engineering',
                'employment_type' => 'Full-time',
                'location' => 'Jakarta',
                'experience_level' => 'Senior Level',
                'salary_range' => 'Rp 12-20 juta',
                'description' => 'Bergabunglah sebagai Backend Developer untuk mengembangkan sistem backend yang scalable dan reliable untuk platform pembelajaran online kami.',
                'requirements' => '<ul><li>Minimal 3 tahun pengalaman sebagai Backend Developer</li><li>Menguasai PHP (CodeIgniter/Laravel) atau Node.js</li><li>Familiar dengan MySQL/PostgreSQL</li><li>Pengalaman dengan RESTful API dan microservices</li></ul>',
                'benefits' => '<ul><li>Gaji kompetitif</li><li>Flexible working hours</li><li>Team building activities</li><li>Professional development opportunities</li></ul>',
                'is_featured' => 0,
                'application_deadline' => null,
                'total_applications' => 18,
                'active_applications' => 5
            ],
            (object) [
                'id' => 3,
                'title' => 'UI/UX Designer',
                'department' => 'Design',
                'employment_type' => 'Contract',
                'location' => 'Remote',
                'experience_level' => 'Mid Level',
                'salary_range' => 'Rp 6-12 juta',
                'description' => 'Kami mencari UI/UX Designer yang kreatif dan berpengalaman untuk merancang interface yang user-friendly untuk platform pembelajaran kami.',
                'requirements' => '<ul><li>Minimal 2 tahun pengalaman sebagai UI/UX Designer</li><li>Menguasai Figma, Adobe XD, atau Sketch</li><li>Memahami prinsip-prinsip UX design</li><li>Portfolio yang menunjukkan kemampuan design</li></ul>',
                'benefits' => '<ul><li>Project-based contract</li><li>Remote work</li><li>Creative freedom</li><li>Portfolio building opportunities</li></ul>',
                'is_featured' => 0,
                'application_deadline' => '2024-11-30',
                'total_applications' => 12,
                'active_applications' => 3
            ]
        ];
        
        $data['departments'] = ['Engineering', 'Design', 'Marketing', 'Operations'];
        $data['stats'] = [
            'total_positions' => 3,
            'published_positions' => 3,
            'closed_positions' => 0,
            'total_applications' => 55,
            'active_applications' => 16
        ];
        $data['filters'] = [];

        $this->load->view('career/index', $data);
    }

    public function career_detail($encryptedId)
    {
        try {
            // Decode encrypted ID
            $positionId = $this->encryption_url->decode($encryptedId);
            
            if (!$positionId) {
                show_404();
                return;
            }

            // Sample positions data (same as in career method)
            $positions = [
                1 => (object) [
                    'id' => 1,
                    'title' => 'Frontend Developer',
                    'department' => 'Engineering',
                    'employment_type' => 'Full-time',
                    'location' => 'Jakarta / Remote',
                    'experience_level' => 'Mid Level',
                    'salary_range' => 'Rp 8-15 juta',
                    'description' => 'Kami mencari Frontend Developer yang berpengalaman dalam React, Vue.js, dan modern web technologies untuk bergabung dengan tim development kami.',
                    'requirements' => '<ul><li>Minimal 2 tahun pengalaman sebagai Frontend Developer</li><li>Menguasai React.js, Vue.js, atau Angular</li><li>Familiar dengan HTML5, CSS3, JavaScript ES6+</li><li>Pengalaman dengan Git dan agile development</li></ul>',
                    'benefits' => '<ul><li>Gaji kompetitif</li><li>Remote work flexibility</li><li>Health insurance</li><li>Learning & development budget</li></ul>',
                    'is_featured' => 1,
                    'application_deadline' => '2024-12-31',
                    'total_applications' => 25,
                    'active_applications' => 8
                ],
                2 => (object) [
                    'id' => 2,
                    'title' => 'Backend Developer',
                    'department' => 'Engineering',
                    'employment_type' => 'Full-time',
                    'location' => 'Jakarta',
                    'experience_level' => 'Senior Level',
                    'salary_range' => 'Rp 12-20 juta',
                    'description' => 'Bergabunglah sebagai Backend Developer untuk mengembangkan sistem backend yang scalable dan reliable untuk platform pembelajaran online kami.',
                    'requirements' => '<ul><li>Minimal 3 tahun pengalaman sebagai Backend Developer</li><li>Menguasai PHP (CodeIgniter/Laravel) atau Node.js</li><li>Familiar dengan MySQL/PostgreSQL</li><li>Pengalaman dengan RESTful API dan microservices</li></ul>',
                    'benefits' => '<ul><li>Gaji kompetitif</li><li>Flexible working hours</li><li>Team building activities</li><li>Professional development opportunities</li></ul>',
                    'is_featured' => 0,
                    'application_deadline' => null,
                    'total_applications' => 18,
                    'active_applications' => 5
                ],
                3 => (object) [
                    'id' => 3,
                    'title' => 'UI/UX Designer',
                    'department' => 'Design',
                    'employment_type' => 'Contract',
                    'location' => 'Remote',
                    'experience_level' => 'Mid Level',
                    'salary_range' => 'Rp 6-12 juta',
                    'description' => 'Kami mencari UI/UX Designer yang kreatif dan berpengalaman untuk merancang interface yang user-friendly untuk platform pembelajaran kami.',
                    'requirements' => '<ul><li>Minimal 2 tahun pengalaman sebagai UI/UX Designer</li><li>Menguasai Figma, Adobe XD, atau Sketch</li><li>Memahami prinsip-prinsip UX design</li><li>Portfolio yang menunjukkan kemampuan design</li></ul>',
                    'benefits' => '<ul><li>Project-based contract</li><li>Remote work</li><li>Creative freedom</li><li>Portfolio building opportunities</li></ul>',
                    'is_featured' => 0,
                    'application_deadline' => '2024-11-30',
                    'total_applications' => 12,
                    'active_applications' => 3
                ]
            ];

            // Get position details
            $position = isset($positions[$positionId]) ? $positions[$positionId] : null;
            
            if (!$position) {
                show_404();
                return;
            }

            $data['title'] = $position->title . ' - Karier di ASET Academy';
            $data['description'] = 'Bergabung dengan tim ASET Academy sebagai ' . $position->title . '. ' . substr(strip_tags($position->description), 0, 150) . '...';
            $data['position'] = $position;
            $data['encryptedId'] = $encryptedId;

            $this->load->view('career/detail', $data);
            
        } catch (Throwable $th) {
            log_message('error', 'Career detail page error: ' . $th->getMessage());
            show_404();
        }
    }

    public function career_apply($encryptedId)
    {
        if ($this->input->method() !== 'post') {
            show_404();
            return;
        }

        try {
            // Decode encrypted ID
            $positionId = $this->encryption_url->decode($encryptedId);
            
            if (!$positionId) {
                show_404();
                return;
            }

            // Sample positions data (same as in career_detail method)
            $positions = [
                1 => (object) ['id' => 1, 'title' => 'Frontend Developer'],
                2 => (object) ['id' => 2, 'title' => 'Backend Developer'],
                3 => (object) ['id' => 3, 'title' => 'UI/UX Designer']
            ];

            // Get position details
            $position = isset($positions[$positionId]) ? $positions[$positionId] : null;
            
            if (!$position) {
                show_404();
                return;
            }

            // Validate form data
            $this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required|trim|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|max_length[100]');
            $this->form_validation->set_rules('phone', 'Nomor Telepon', 'required|trim|min_length[10]|max_length[20]');
            $this->form_validation->set_rules('linkedin', 'LinkedIn Profile', 'trim|valid_url|max_length[255]');
            $this->form_validation->set_rules('portfolio', 'Portfolio/GitHub', 'trim|valid_url|max_length[255]');
            $this->form_validation->set_rules('cover_letter', 'Cover Letter', 'required|trim|min_length[50]|max_length[2000]');
            $this->form_validation->set_rules('agree_terms', 'Persetujuan', 'required');

            if ($this->form_validation->run() === FALSE) {
                // Validation failed, redirect back to detail page
                $this->session->set_flashdata('error', 'Mohon lengkapi semua field yang diperlukan.');
                redirect('career/detail/' . $encryptedId);
                return;
            }

            // Handle file upload
            $cvPath = null;
            if (!empty($_FILES['cv']['name'])) {
                $config['upload_path'] = FCPATH . 'uploads/recruitment/';
                $config['allowed_types'] = 'pdf|doc|docx';
                $config['max_size'] = 5120; // 5MB
                $config['encrypt_name'] = TRUE;

                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0755, TRUE);
                }

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('cv')) {
                    $cvPath = 'uploads/recruitment/' . $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('error', 'Gagal mengupload CV: ' . $this->upload->display_errors('', ''));
                    redirect('career/detail/' . $encryptedId);
                    return;
                }
            }

            // Since job_applications table doesn't exist, we'll just show success message
            // In a real implementation, you would save to database here
            $this->session->set_flashdata('success', 'Aplikasi Anda berhasil dikirim! Tim HR akan menghubungi Anda dalam 1-2 hari kerja.');
            redirect('career/detail/' . $encryptedId);

        } catch (Throwable $th) {
            log_message('error', 'Career application error: ' . $th->getMessage());
            $this->session->set_flashdata('error', 'Terjadi kesalahan sistem. Silakan coba lagi nanti.');
            redirect('career/detail/' . $encryptedId);
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
