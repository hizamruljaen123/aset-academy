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
        $this->load->library('form_validation');

        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['title'] = 'Forum Diskusi';
        $data['categories'] = $this->forum->get_categories();
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
        $data['threads'] = $this->forum->get_threads_by_category($data['category']->id, $limit, $offset);
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

    public function thread($thread_id)
    {
        $data['thread'] = $this->forum->get_thread($thread_id);
        if (!$data['thread']) {
            show_404();
        }

        $data['title'] = $data['thread']->title;
        $data['posts'] = $this->forum->get_posts_by_thread($thread_id);
        $data['likes'] = $this->forum->get_likes_count($thread_id);

        $this->load->view('templates/header', $data);
        $this->load->view('forum/thread_view', $data);
        $this->load->view('templates/footer');
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
        redirect('forum/thread/' . $thread_id);
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
}
