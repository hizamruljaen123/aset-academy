<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_forum extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Forum_model', 'forum');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');

        // Admin authentication check
        if (!$this->session->userdata('logged_in') || !in_array($this->session->userdata('role'), ['admin', 'super_admin'])) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['title'] = 'Kelola Forum';
        $data['categories'] = $this->forum->get_categories();
        $data['threads'] = $this->forum->get_all_threads(20, 0);
        $data['total_threads'] = $this->forum->count_all_threads();
        $data['posts'] = $this->get_recent_posts(10);
        $data['posts'] = $this->get_recent_posts(10);

        $this->load->view('templates/header', $data);
        $this->load->view('admin/forum/index', $data);
        $this->load->view('templates/footer');
    }

    // AJAX Methods for Category CRUD
    public function ajax_get_category($id)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $category = $this->forum->get_category($id);
        if ($category) {
            echo json_encode(['success' => true, 'data' => $category]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Kategori tidak ditemukan']);
        }
    }

    public function ajax_create_category()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $this->form_validation->set_rules('name', 'Nama Kategori', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim|max_length[255]');
        $this->form_validation->set_rules('slug', 'Slug', 'required|trim|alpha_dash|is_unique[forum_categories.slug]');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'success' => false,
                'message' => validation_errors()
            ]);
            return;
        }

        $category_data = [
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'slug' => $this->input->post('slug')
        ];

        if ($this->db->insert('forum_categories', $category_data)) {
            $new_id = $this->db->insert_id();
            $new_category = $this->forum->get_category($new_id);
            echo json_encode([
                'success' => true,
                'message' => 'Kategori berhasil ditambahkan!',
                'data' => $new_category
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal menambahkan kategori'
            ]);
        }
    }

    public function ajax_update_category($id)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $category = $this->forum->get_category($id);
        if (!$category) {
            echo json_encode(['success' => false, 'message' => 'Kategori tidak ditemukan']);
            return;
        }

        $this->form_validation->set_rules('name', 'Nama Kategori', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim|max_length[255]');
        $this->form_validation->set_rules('slug', 'Slug', "required|trim|alpha_dash|callback_check_slug_unique[$id]");

        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'success' => false,
                'message' => validation_errors()
            ]);
            return;
        }

        $category_data = [
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'slug' => $this->input->post('slug')
        ];

        $this->db->where('id', $id);
        if ($this->db->update('forum_categories', $category_data)) {
            $updated_category = $this->forum->get_category($id);
            echo json_encode([
                'success' => true,
                'message' => 'Kategori berhasil diperbarui!',
                'data' => $updated_category
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Tidak ada perubahan atau gagal update'
            ]);
        }
    }

    public function ajax_delete_category($id)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $category = $this->forum->get_category($id);
        if (!$category) {
            echo json_encode(['success' => false, 'message' => 'Kategori tidak ditemukan']);
            return;
        }

        // Check if category has threads
        $thread_count = $this->forum->count_threads_by_category($id);
        if ($thread_count > 0) {
            echo json_encode([
                'success' => false,
                'message' => 'Tidak dapat menghapus kategori yang masih memiliki topik. Hapus semua topik terlebih dahulu.'
            ]);
            return;
        }

        if ($this->db->delete('forum_categories', ['id' => $id])) {
            echo json_encode([
                'success' => true,
                'message' => 'Kategori berhasil dihapus!'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal menghapus kategori'
            ]);
        }
    }

    // AJAX Methods for Thread CRUD
    public function ajax_get_thread($id)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $thread = $this->db->select('ft.*, u.nama_lengkap as author_name, fc.name as category_name, fc.id as category_id')
                           ->from('forum_threads ft')
                           ->join('users u', 'ft.user_id = u.id')
                           ->join('forum_categories fc', 'ft.category_id = fc.id')
                           ->where('ft.id', $id)
                           ->get()
                           ->row();
        if ($thread) {
            echo json_encode(['success' => true, 'data' => $thread]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Topik tidak ditemukan']);
        }
    }

    public function ajax_create_thread()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $this->form_validation->set_rules('category_id', 'Kategori', 'required|integer');
        $this->form_validation->set_rules('title', 'Judul', 'required|trim|min_length[5]');
        $this->form_validation->set_rules('content', 'Konten', 'required|trim|min_length[10]');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'success' => false,
                'message' => validation_errors()
            ]);
            return;
        }

        $thread_data = [
            'user_id' => $this->session->userdata('user_id'),
            'category_id' => $this->input->post('category_id'),
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'is_pinned' => $this->input->post('is_pinned') ? 1 : 0
        ];

        $thread_id = $this->forum->create_thread($thread_data);
        if ($thread_id) {
            echo json_encode([
                'success' => true,
                'message' => 'Topik berhasil dibuat!',
                'data' => ['id' => $thread_id]
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal membuat topik'
            ]);
        }
    }

    public function ajax_update_thread($id)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $thread = $this->forum->get_thread($id);
        if (!$thread) {
            echo json_encode(['success' => false, 'message' => 'Topik tidak ditemukan']);
            return;
        }

        $this->form_validation->set_rules('category_id', 'Kategori', 'required|integer');
        $this->form_validation->set_rules('title', 'Judul', 'required|trim|min_length[5]');
        $this->form_validation->set_rules('content', 'Konten', 'required|trim|min_length[10]');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'success' => false,
                'message' => validation_errors()
            ]);
            return;
        }

        $thread_data = [
            'category_id' => $this->input->post('category_id'),
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'is_pinned' => $this->input->post('is_pinned') ? 1 : 0,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->db->where('id', $id);
        if ($this->db->update('forum_threads', $thread_data)) {
            $updated_thread = $this->forum->get_thread($id);
            echo json_encode([
                'success' => true,
                'message' => 'Topik berhasil diperbarui!',
                'data' => $updated_thread
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal memperbarui topik'
            ]);
        }
    }

    public function ajax_delete_thread($id)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        if ($this->forum->delete_thread($id)) {
            echo json_encode([
                'success' => true,
                'message' => 'Topik forum berhasil dihapus!'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal menghapus topik forum.'
            ]);
        }
    }

    // Get all categories for thread create/edit dropdown
    public function ajax_get_categories()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $categories = $this->forum->get_categories();
        echo json_encode(['success' => true, 'data' => $categories]);
    }

    // AJAX Methods for Post CRUD
    public function ajax_get_post($id)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $post = $this->db->select('fp.*, u.nama_lengkap as author_name, ft.title as thread_title, ft.id as thread_id')
                         ->from('forum_posts fp')
                         ->join('users u', 'fp.user_id = u.id')
                         ->join('forum_threads ft', 'fp.thread_id = ft.id')
                         ->where('fp.id', $id)
                         ->get()
                         ->row();
        if ($post) {
            echo json_encode(['success' => true, 'data' => $post]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Komentar tidak ditemukan']);
        }
    }

    public function ajax_create_post()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $this->form_validation->set_rules('thread_id', 'Topik', 'required|integer');
        $this->form_validation->set_rules('content', 'Konten', 'required|trim|min_length[5]');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'success' => false,
                'message' => validation_errors()
            ]);
            return;
        }

        $post_data = [
            'thread_id' => $this->input->post('thread_id'),
            'user_id' => $this->session->userdata('user_id'),
            'content' => $this->input->post('content')
        ];

        $post_id = $this->forum->create_post($post_data);
        if ($post_id) {
            echo json_encode([
                'success' => true,
                'message' => 'Komentar berhasil ditambahkan!',
                'data' => ['id' => $post_id]
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal menambahkan komentar'
            ]);
        }
    }

    public function ajax_update_post($id)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $post = $this->db->get_where('forum_posts', ['id' => $id])->row();
        if (!$post) {
            echo json_encode(['success' => false, 'message' => 'Komentar tidak ditemukan']);
            return;
        }

        $this->form_validation->set_rules('content', 'Konten', 'required|trim|min_length[5]');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'success' => false,
                'message' => validation_errors()
            ]);
            return;
        }

        $post_data = [
            'content' => $this->input->post('content'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->db->where('id', $id);
        if ($this->db->update('forum_posts', $post_data)) {
            $updated_post = $this->db->get_where('forum_posts', ['id' => $id])->row();
            echo json_encode([
                'success' => true,
                'message' => 'Komentar berhasil diperbarui!',
                'data' => $updated_post
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal memperbarui komentar'
            ]);
        }
    }

    public function ajax_delete_post($id)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        if ($this->forum->delete_post($id)) {
            echo json_encode([
                'success' => true,
                'message' => 'Komentar berhasil dihapus!'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal menghapus komentar.'
            ]);
        }
    }

    // Get recent posts for admin panel
    public function get_recent_posts($limit = 10)
    {
        $posts = $this->db->select('fp.*, u.nama_lengkap, ft.title as thread_title')
                          ->from('forum_posts fp')
                          ->join('users u', 'fp.user_id = u.id')
                          ->join('forum_threads ft', 'fp.thread_id = ft.id')
                          ->order_by('fp.created_at', 'DESC')
                          ->limit($limit)
                          ->get()
                          ->result();
        return $posts;
    }

    public function create_category()
    {
        $data['title'] = 'Tambah Kategori Forum';

        $this->form_validation->set_rules('name', 'Nama Kategori', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim|max_length[255]');
        $this->form_validation->set_rules('slug', 'Slug', 'required|trim|alpha_dash|is_unique[forum_categories.slug]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('admin/forum/create_category', $data);
            $this->load->view('templates/footer');
        } else {
            $category_data = [
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'slug' => $this->input->post('slug')
            ];

            $this->db->insert('forum_categories', $category_data);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Kategori forum berhasil ditambahkan!');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan kategori forum.');
            }

            redirect('admin_forum');
        }
    }

    public function edit_category($id)
    {
        $data['title'] = 'Edit Kategori Forum';
        $data['category'] = $this->forum->get_category($id);

        if (!$data['category']) {
            show_404();
        }

        $this->form_validation->set_rules('name', 'Nama Kategori', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim|max_length[255]');
        $this->form_validation->set_rules('slug', 'Slug', "required|trim|alpha_dash|callback_check_slug_unique[$id]");

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('admin/forum/edit_category', $data);
            $this->load->view('templates/footer');
        } else {
            $category_data = [
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'slug' => $this->input->post('slug')
            ];

            $this->db->where('id', $id);
            $this->db->update('forum_categories', $category_data);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Kategori forum berhasil diperbarui!');
            } else {
                $this->session->set_flashdata('error', 'Tidak ada perubahan yang dilakukan.');
            }

            redirect('admin_forum');
        }
    }

    public function delete_category($id)
    {
        $category = $this->forum->get_category($id);
        if (!$category) {
            show_404();
        }

        // Check if category has threads
        $thread_count = $this->forum->count_threads_by_category($id);
        if ($thread_count > 0) {
            $this->session->set_flashdata('error', 'Tidak dapat menghapus kategori yang masih memiliki topik. Hapus semua topik terlebih dahulu.');
            redirect('admin_forum');
        }

        $this->db->delete('forum_categories', ['id' => $id]);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Kategori forum berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus kategori forum.');
        }

        redirect('admin_forum');
    }

    public function delete_thread($id)
    {
        if ($this->forum->delete_thread($id)) {
            $this->session->set_flashdata('success', 'Topik forum berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus topik forum.');
        }

        redirect('admin_forum');
    }

    public function delete_post($id)
    {
        if ($this->forum->delete_post($id)) {
            $this->session->set_flashdata('success', 'Komentar berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus komentar.');
        }

        redirect('admin_forum');
    }

    // Validation callback for unique slug check
    public function check_slug_unique($slug, $id)
    {
        $this->db->where('slug', $slug);
        $this->db->where('id !=', $id);
        $count = $this->db->count_all_results('forum_categories');

        if ($count > 0) {
            $this->form_validation->set_message('check_slug_unique', 'Slug sudah digunakan. Gunakan slug yang berbeda.');
            return FALSE;
        }

        return TRUE;
    }
}
