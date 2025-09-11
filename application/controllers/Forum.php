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
        
        // Load views with layout
        $this->load->view('templates/header', $data);
        $this->load->view('forum/index', $data);
        $this->load->view('templates/footer');
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
        if (!$thread_id || !is_numeric($thread_id)) {
            show_404();
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
        
        // Get posts with pagination
        $limit = 10;
        $offset = $this->uri->segment(4, 0);
        $data['posts'] = $this->forum->get_posts($data['thread']->id, $limit, $offset);
        $data['post_count'] = $this->forum->count_posts($data['thread']->id);
        $data['likes'] = $this->forum->count_likes($data['thread']->id, 'thread');
        $data['view_count'] = $this->forum->get_thread_view_count($thread_id);
        
        // Check if user has liked the thread
        $data['user_has_liked'] = false;
        if ($this->session->userdata('user_id')) {
            $data['user_has_liked'] = $this->forum->has_user_liked(
                $this->session->userdata('user_id'), 
                $data['thread']->id, 
                'thread'
            );
        }
        
        // Get similar threads
        $data['similar_threads'] = $this->forum->get_similar_threads(
            $data['thread']->category_id, 
            $data['thread']->id, 
            5
        );
        
        // Set up pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('forum/thread/' . $thread_id);
        $config['total_rows'] = $data['post_count'];
        $config['per_page'] = $limit;
        $config['uri_segment'] = 4;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');
        
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        
        // Load views
        $data['title'] = $data['thread']->title;
        $data['scripts'] = [
            'https://cdn.quilljs.com/1.3.6/quill.min.js',
            base_url('assets/js/forum.js')
        ];
        $data['styles'] = [
            'https://cdn.quilljs.com/1.3.6/quill.snow.css',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css'
        ];
        
        $this->load->view('templates/header', $data);
        $this->load->view('forum/thread_view', $data);
        $this->load->view('templates/footer', $data);
    }

    public function create_thread($category_slug)
    {
        $data['category'] = $this->forum->get_category_by_slug($category_slug);
        if (!$data['category']) {
            show_404();
        }

        $data['title'] = 'Buat Topik Baru';

        $this->form_validation->set_rules('title', 'Judul', 'required|trim|min_length[5]');
        $this->form_validation->set_rules('content', 'Konten', 'required|trim|min_length[10]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('forum/create_thread', $data);
            $this->load->view('templates/footer');
        } else {
            $thread_data = [
                'user_id' => $this->session->userdata('user_id'),
                'category_id' => $data['category']->id,
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content'),
            ];

            $thread_id = $this->forum->create_thread($thread_data);
            redirect('forum/thread/' . $thread_id);
        }
    }

    public function create_post($thread_id)
    {
        $this->form_validation->set_rules('content', 'Komentar', 'required|trim|min_length[5]');

        if ($this->form_validation->run() == TRUE) {
            $post_data = [
                'thread_id' => $thread_id,
                'user_id' => $this->session->userdata('user_id'),
                'parent_id' => $this->input->post('parent_id') ? $this->input->post('parent_id') : NULL,
                'content' => $this->input->post('content'),
            ];
            $this->forum->create_post($post_data);
        }

        // Redirect back to the thread
        $thread = $this->forum->get_thread($thread_id);
        if ($thread) {
            redirect('forum/thread/' . $thread_id);
        } else {
            // Fallback if thread not found
            redirect('forum');
        }
    }

    public function get_comments_ajax($thread_id)
    {
        $offset = $this->input->get('offset') ? (int)$this->input->get('offset') : 0;
        $limit = 10;
        $posts = $this->forum->get_posts_by_thread($thread_id, $limit, $offset);
        $this->output->set_content_type('application/json')->set_output(json_encode($posts));
    }

    public function like($type, $id)
    {
        $user_id = $this->session->userdata('user_id');
        $thread_id = ($type == 'thread') ? $id : null;
        $post_id = ($type == 'post') ? $id : null;

        $this->forum->toggle_like($user_id, $thread_id, $post_id);

        if ($type == 'thread') {
            redirect('forum/thread/' . $id);
        } else {
            // Need to get thread_id from post_id to redirect correctly
            $post = $this->db->get_where('forum_posts', ['id' => $post_id])->row();
            redirect('forum/thread/' . $post->thread_id);
        }
    }

    public function get_viewers($thread_id)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $viewers = $this->forum->get_thread_viewers($thread_id);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($viewers));
    }
}
