<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kelas_model');
        $this->load->model('Free_class_model');
        $this->load->model('Testimonial_model');
        $this->load->helper('url');
    }

    public function index()
    {
        // Get featured premium classes
        $data['featured_premium'] = $this->Kelas_model->get_popular_kelas(3);

        // Get featured free classes
        $data['featured_free'] = $this->Free_class_model->get_popular_free_classes(3);

        // Get testimonials
        $data['testimonials'] = $this->Testimonial_model->get_featured_testimonials(5);

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

    public function premium()
    {
        $data['premium_classes'] = $this->Kelas_model->get_all_kelas();
        $data['title'] = 'Kelas Premium - Asset Academy';
        $data['description'] = 'Jelajahi koleksi kelas premium kami untuk pembelajaran programming yang komprehensif.';

        $this->load->view('home/premium', $data);
    }

    public function free()
    {
        $free_classes = $this->Free_class_model->get_all_free_classes();
        
        // Add material count to each class
        foreach ($free_classes as $class) {
            $materials = $this->Free_class_model->get_free_class_materials($class->id);
            $class->material_count = count($materials);
        }
        
        $data['free_classes'] = $free_classes;
        $data['title'] = 'Kelas Gratis - Asset Academy';
        $data['description'] = 'Akses kelas gratis berkualitas tinggi untuk memulai perjalanan programming Anda.';

        $this->load->view('home/free', $data);
    }
    
    public function view_free_class($class_id)
    {
        $free_class = $this->Free_class_model->get_free_class_by_id($class_id);
        
        if (!$free_class) {
            show_404();
        }
        
        if ($free_class->status != 'Published') {
            show_error('Kelas ini belum dipublikasikan', 403);
        }
        
        // Get class materials
        $materials = $this->Free_class_model->get_free_class_materials($class_id);
        $free_class->material_count = count($materials);
        
        // Get enrolled students count
        $enrolled_count = $this->Free_class_model->count_enrolled_students($class_id);
        
        $data['free_class'] = $free_class;
        $data['materials'] = $materials;
        $data['enrolled_count'] = $enrolled_count;
        $data['title'] = $free_class->title . ' - Asset Academy';
        $data['description'] = 'Lihat detail kelas gratis: ' . $free_class->title . '. ' . $free_class->description;
        
        $this->load->view('home/free_class_view', $data);
    }
}
