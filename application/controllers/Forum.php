<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Forum_model', 'forum');
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->helper('form');
        $this->load->helper('date');
        $this->load->library('form_validation');
        $this->load->library('encryption_url');

        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['title'] = 'Forum Diskusi';
        
        // Get all categories with thread counts
        $categories = $this->forum->get_categories();
        foreach ($categories as &$category) {
            $category->thread_count = $this->forum->count_threads_by_category($category->id);
        }
        $data['categories'] = $categories;
        
        // Get popular threads (most commented)
        $data['popular_threads'] = $this->forum->get_popular_threads(5);

        // Check if forum has any threads
        $data['has_threads'] = $this->forum->count_all_threads() > 0;

        // Check if user is admin or super admin
        $user_role = $this->session->userdata('role');
        $data['is_admin'] = in_array($user_role, ['admin', 'super_admin']);
        $data['is_super_admin'] = ($user_role === 'super_admin');

        // Load views with layout
        $this->load->view('templates/header', $data);
        $this->load->view('forum/index', $data);
        $this->load->view('templates/footer');
    }

    public function delete_thread($thread_id)
    {
        if ($this->session->userdata('role') !== 'super_admin') {
            show_error('Access denied. Only super admin can delete threads.', 403);
        }

        $thread = $this->forum->get_thread($thread_id);
        if (!$thread) {
            show_404();
        }

        if ($this->forum->delete_thread($thread_id)) {
            $this->session->set_flashdata('success', 'Diskusi berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus diskusi.');
        }

        $category = $this->forum->get_category($thread->category_id);
        $category_slug = $category ? $category->slug : null;

        if ($category_slug) {
            redirect('forum/category/' . $category_slug);
        }

        redirect('forum');
    }

    public function category($slug, $offset = 0)
    {
        $data['category'] = $this->forum->get_category_by_slug($slug);
        if (!$data['category']) {
            show_404();
        }

        $limit = 10;
        $threads = $this->forum->get_threads_by_category($data['category']->id, $limit, $offset);
        foreach ($threads as $thread) {
            $thread->latest_posts = $this->forum->get_posts_by_thread($thread->id, 2);
        }
        $data['threads'] = $threads;
        $data['title'] = $data['category']->name;
        $data['is_super_admin'] = $this->session->userdata('role') === 'super_admin';

        $config['base_url'] = site_url('forum/category/' . $slug);
        $config['total_rows'] = $this->forum->count_threads_by_category($data['category']->id);
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('templates/header', $data);
        $this->load->view('forum/category_view', $data);
        $this->load->view('templates/footer');
    }

    public function thread($thread_id = null)
    {
        // If no id is provided, show 404
        if (!$thread_id) {
            show_404();
        }
        
        // Decrypt thread_id
        $thread_id = $this->encryption_url->decode($thread_id);
        
        if ($thread_id === false) {
            show_error('Invalid thread ID', 404);
        }
        
        // Get thread data by id
        $data['thread'] = $this->forum->get_thread($thread_id);
        if (!$data['thread']) {
            show_404();
        }
        
        // Record the view
        if ($this->session->userdata('user_id')) {
            $this->forum->record_view($thread_id, $this->session->userdata('user_id'));
        }

        // Get category info
        $data['category'] = $this->forum->get_category($data['thread']->category_id);
        
        // Get posts with hierarchical structure (all posts for now, to ensure display)
        $user_id = $this->session->userdata('user_id');
        $data['posts'] = $this->forum->get_thread_posts_with_replies($data['thread']->id, $user_id);
        $data['post_count'] = $this->forum->count_posts($data['thread']->id);
        $data['view_count'] = $this->forum->get_thread_view_count($thread_id);
        
        // Get similar threads
        $data['similar_threads'] = $this->forum->get_similar_threads(
            $data['thread']->category_id, 
            $data['thread']->id, 
            5
        );
        
        // Note: Pagination temporarily disabled to ensure all comments display; can be re-implemented for top-level posts if needed
        $data['pagination'] = '';
        
        // Load views
        $data['title'] = $data['thread']->title;
        $data['scripts'] = [
            'https://cdn.quilljs.com/1.3.6/quill.min.js'
        ];
        $data['styles'] = [
            'https://cdn.quilljs.com/1.3.6/quill.snow.css',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css'
        ];
        
        $this->load->view('templates/header', $data);
        $this->load->view('forum/thread_view', $data);
        $this->load->view('templates/footer', $data);
    }

    public function create_thread($category_id = null)
    {
        // Check if category_id is provided and numeric
        if (!$category_id || !is_numeric($category_id)) {
            show_404();
        }

        // Get category data
        $data['category'] = $this->forum->get_category($category_id);
        if (!$data['category']) {
            show_404();
        }

        $this->form_validation->set_rules('title', 'Judul', 'required|trim|min_length[5]');
        $this->form_validation->set_rules('content', 'Konten', 'required|trim|min_length[10]');

        if ($this->form_validation->run() == FALSE) {
            // Load the create thread view
            $data['title'] = 'Buat Topik Baru - ' . $data['category']->name;
            $this->load->view('templates/header', $data);
            $this->load->view('forum/create_thread', $data);
            $this->load->view('templates/footer');
        } else {
            $thread_data = [
                'user_id' => $this->session->userdata('user_id'),
                'category_id' => $category_id,
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content'),
            ];

            $thread_id = $this->forum->create_thread($thread_data);

            if ($thread_id) {
                $this->session->set_flashdata('success', 'Topik berhasil dibuat!');
                redirect('forum/thread/' . $this->encryption_url->encode($thread_id));
            } else {
                $this->session->set_flashdata('error', 'Gagal membuat topik. Silakan coba lagi.');
                redirect('forum/create_thread/' . $category_id);
            }
        }
    }

    public function create_post($thread_id)
    {
        // Decrypt thread_id
        $thread_id = $this->encryption_url->decode($thread_id);
        
        if ($thread_id === false) {
            show_error('Invalid thread ID', 404);
        }
        
        // Validate thread exists
        $thread = $this->forum->get_thread($thread_id);
        if (!$thread) {
            show_404();
        }

        // Validate user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }

        $this->form_validation->set_rules('content', 'Komentar', 'required|trim|min_length[5]|max_length[5000]');

        if ($this->form_validation->run() == TRUE) {
            $post_data = [
                'thread_id' => $thread_id,
                'user_id' => $this->session->userdata('user_id'),
                'parent_id' => $this->input->post('parent_id') ? (int)$this->input->post('parent_id') : NULL,
                'content' => $this->security->xss_clean($this->input->post('content')),
            ];
            
            $post_id = $this->forum->create_post($post_data);
            
            if ($post_id) {
                $this->session->set_flashdata('success', 'Komentar berhasil ditambahkan!');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan komentar. Silakan coba lagi.');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
        }

        // Redirect back to the thread
        redirect('forum/thread/' . $this->encryption_url->encode($thread_id));
    }

    public function get_comments_ajax($thread_id)
    {
        $offset = $this->input->get('offset') ? (int)$this->input->get('offset') : 0;
        $limit = 10;
        $posts = $this->forum->get_posts_by_thread($thread_id, $limit, $offset);
        
        // Debug logging
        log_message('debug', 'get_comments_ajax called for thread: ' . $thread_id . ', offset: ' . $offset . ', posts found: ' . count($posts));
        
        // Format posts for AJAX response
        $formatted_posts = [];
        foreach ($posts as $post) {
            $formatted_posts[] = [
                'id' => $post->id,
                'nama_lengkap' => $post->nama_lengkap,
                'content' => $post->content,
                'created_at' => $post->created_at,
                'replies' => $this->forum->get_replies($post->id)
            ];
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($formatted_posts));
    }

    public function get_viewers($thread_id)
    {
        // Validate request is AJAX
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        // Validate thread exists
        $thread = $this->forum->get_thread($thread_id);
        if (!$thread) {
            show_404();
        }

        $viewers = $this->forum->get_thread_viewers($thread_id);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($viewers));
    }

    public function create_category()
    {
        // Check if user is admin or super admin
        if (!in_array($this->session->userdata('role'), ['admin', 'super_admin'])) {
            show_error('Access denied. Only admin can create categories.', 403);
        }

        $this->form_validation->set_rules('name', 'Nama Kategori', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim|max_length[255]');
        $this->form_validation->set_rules('slug', 'Slug', 'required|trim|alpha_dash|is_unique[forum_categories.slug]');

        if ($this->form_validation->run() == FALSE) {
            // Redirect back with validation errors
            $this->session->set_flashdata('error', validation_errors());
            redirect('forum');
        } else {
            $category_data = [
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'slug' => $this->input->post('slug')
            ];

            if ($this->forum->create_category($category_data)) {
                $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan!');
                redirect('forum');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan kategori. Silakan coba lagi.');
                redirect('forum');
            }
        }
    }

    public function reply($post_id)
    {
        // Decrypt post_id
        $post_id = $this->encryption_url->decode($post_id);
        
        if ($post_id === false) {
            show_error('Invalid post ID', 404);
        }
        
        // Validate post exists and get user info
        $this->db->select('fp.*, u.nama_lengkap, u.username, u.role as user_role');
        $this->db->from('forum_posts fp');
        $this->db->join('users u', 'fp.user_id = u.id', 'left');
        $this->db->where('fp.id', $post_id);
        $post = $this->db->get()->row();
        if (!$post) {
            show_404();
        }

        // Get thread and category
        $thread = $this->forum->get_thread($post->thread_id);
        if (!$thread) {
            show_404();
        }

        $category = $this->forum->get_category($thread->category_id);

        $data['title'] = 'Balas Komentar - ' . $thread->title;
        $data['post'] = $post;
        $data['thread'] = $thread;
        $data['category'] = $category;

        // Add Quill.js scripts and styles
        $data['scripts'] = [
            'https://cdn.quilljs.com/1.3.6/quill.min.js'
        ];
        $data['styles'] = [
            'https://cdn.quilljs.com/1.3.6/quill.snow.css'
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('forum/reply', $data);
        $this->load->view('templates/footer');
    }
}
