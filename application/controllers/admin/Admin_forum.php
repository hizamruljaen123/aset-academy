<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_forum extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Forum_model', 'forum');
        $this->load->library('session');
        $this->load->library('pagination');

        if (!in_array($this->session->userdata('role'), ['admin', 'super_admin'])) {
            redirect('auth/login');
        }
    }

    public function index($offset = 0)
    {
        $data['title'] = 'Manajemen Forum';

        $limit = 10;
        $data['threads'] = $this->forum->get_all_threads($limit, $offset);

        $config['base_url'] = site_url('admin/admin_forum/index');
        $config['total_rows'] = $this->forum->count_all_threads();
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/forum/index', $data);
        $this->load->view('templates/admin_footer');
    }

    public function delete_thread($thread_id)
    {
        if ($this->forum->delete_thread($thread_id)) {
            $this->session->set_flashdata('success', 'Topik berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus topik.');
        }
        redirect('admin/admin_forum');
    }

    public function delete_post($post_id)
    {
        // Get thread_id before deleting for redirection
        $post = $this->db->get_where('forum_posts', ['id' => $post_id])->row();
        $thread_id = $post->thread_id;

        if ($this->forum->delete_post($post_id)) {
            $this->session->set_flashdata('success', 'Komentar berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus komentar.');
        }
        redirect('forum/thread/' . $thread_id);
    }
}
