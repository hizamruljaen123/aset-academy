<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_categories()
    {
        return $this->db->get('forum_categories')->result();
    }

    public function get_category_by_slug($slug)
    {
        return $this->db->get_where('forum_categories', ['slug' => $slug])->row();
    }

    public function get_threads_by_category($category_id, $limit, $offset)
    {
        $this->db->select('ft.*, u.nama_lengkap, u.username, (SELECT COUNT(id) FROM forum_posts WHERE thread_id = ft.id) as post_count');
        $this->db->from('forum_threads ft');
        $this->db->join('users u', 'ft.user_id = u.id');
        $this->db->where('ft.category_id', $category_id);
        $this->db->order_by('ft.is_pinned DESC, ft.updated_at DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }

    public function count_threads_by_category($category_id)
    {
        $this->db->where('category_id', $category_id);
        return $this->db->count_all_results('forum_threads');
    }

    public function get_thread($thread_id)
    {
        $this->db->select('ft.*, u.nama_lengkap, u.username');
        $this->db->from('forum_threads ft');
        $this->db->join('users u', 'ft.user_id = u.id');
        $this->db->where('ft.id', $thread_id);
        return $this->db->get()->row();
    }

    public function create_thread($data)
    {
        $this->db->insert('forum_threads', $data);
        return $this->db->insert_id();
    }

    public function get_posts_by_thread($thread_id)
    {
        $this->db->select('fp.*, u.nama_lengkap, u.username');
        $this->db->from('forum_posts fp');
        $this->db->join('users u', 'fp.user_id = u.id');
        $this->db->where('fp.thread_id', $thread_id);
        $this->db->order_by('fp.created_at', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function create_post($data)
    {
        $this->db->insert('forum_posts', $data);
        return $this->db->insert_id();
    }

    public function toggle_like($user_id, $thread_id = null, $post_id = null)
    {
        $this->db->where('user_id', $user_id);
        if ($thread_id) {
            $this->db->where('thread_id', $thread_id);
        } else {
            $this->db->where('post_id', $post_id);
        }
        $query = $this->db->get('forum_likes');

        if ($query->num_rows() > 0) {
            $this->db->where('id', $query->row()->id);
            $this->db->delete('forum_likes');
            return false; // Unliked
        } else {
            $data = ['user_id' => $user_id];
            if ($thread_id) {
                $data['thread_id'] = $thread_id;
            } else {
                $data['post_id'] = $post_id;
            }
            $this->db->insert('forum_likes', $data);
            return true; // Liked
        }
    }

    public function get_likes_count($thread_id = null, $post_id = null)
    {
        if ($thread_id) {
            $this->db->where('thread_id', $thread_id);
        } else {
            $this->db->where('post_id', $post_id);
        }
        return $this->db->count_all_results('forum_likes');
    }

    // Admin Methods
    public function get_all_threads($limit, $offset)
    {
        $this->db->select('ft.*, u.nama_lengkap, fc.name as category_name');
        $this->db->from('forum_threads ft');
        $this->db->join('users u', 'ft.user_id = u.id');
        $this->db->join('forum_categories fc', 'ft.category_id = fc.id');
        $this->db->order_by('ft.created_at', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }

    public function count_all_threads()
    {
        return $this->db->count_all_results('forum_threads');
    }

    public function delete_thread($thread_id)
    {
        // Deleting a thread will also cascade delete posts and likes due to foreign key constraints
        return $this->db->delete('forum_threads', ['id' => $thread_id]);
    }

    public function delete_post($post_id)
    {
        // Deleting a post will also cascade delete likes and replies
        return $this->db->delete('forum_posts', ['id' => $post_id]);
    }
}
