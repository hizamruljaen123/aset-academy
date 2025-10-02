<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }

    // ========================================
    // CATEGORIES
    // ========================================

    public function get_categories()
    {
        return $this->db->get('forum_categories')->result();
    }

    public function get_category($category_id)
    {
        return $this->db->get_where('forum_categories', ['id' => $category_id])->row();
    }

    public function get_category_by_slug($slug)
    {
        return $this->db->get_where('forum_categories', ['slug' => $slug])->row();
    }

    // ========================================
    // THREADS
    // ========================================

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
        $this->db->select('ft.*, u.nama_lengkap, u.username,
                          fc.name as category_name,
                          (SELECT COUNT(*) FROM forum_posts WHERE thread_id = ft.id) as post_count,
                          (SELECT COUNT(*) FROM forum_thread_views WHERE thread_id = ft.id) as views');
        $this->db->from('forum_threads ft');
        $this->db->join('users u', 'ft.user_id = u.id');
        $this->db->join('forum_categories fc', 'ft.category_id = fc.id');
        $this->db->where('ft.id', $thread_id);
        return $this->db->get()->row();
    }

    public function get_thread_replies($thread_id)
    {
        return $this->get_posts_by_thread($thread_id, 50, 0); // Get all replies with limit
    }


    public function get_recent_threads($limit = 10, $offset = 0)
    {
        $this->db->select('ft.*, u.nama_lengkap, u.username,
                          (SELECT COUNT(*) FROM forum_posts WHERE thread_id = ft.id) as post_count,
                          (SELECT COUNT(*) FROM forum_likes WHERE thread_id = ft.id) as like_count,
                          (SELECT name FROM forum_categories WHERE id = ft.category_id) as category_name,
                          (SELECT COUNT(*) FROM forum_thread_views WHERE thread_id = ft.id) as views');
        $this->db->from('forum_threads ft');
        $this->db->join('users u', 'u.id = ft.user_id', 'left');
        $this->db->order_by('ft.is_pinned DESC, ft.updated_at DESC, ft.created_at DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }

    public function get_popular_threads($limit = 5)
    {
        $this->db->select('ft.id, ft.title, ft.created_at, ft.slug,
                         u.nama_lengkap as author_name, u.username,
                         (SELECT COUNT(*) FROM forum_posts fp WHERE fp.thread_id = ft.id) as reply_count,
                         (SELECT COUNT(*) FROM forum_likes WHERE thread_id = ft.id) as like_count');
        $this->db->from('forum_threads ft');
        $this->db->join('users u', 'u.id = ft.user_id', 'left');
        $this->db->order_by('like_count', 'DESC');
        $this->db->order_by('ft.created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    public function count_all_threads()
    {
        return $this->db->count_all_results('forum_threads');
    }

    public function create_thread($data)
    {
        // Generate slug if not provided
        if (!isset($data['slug']) || empty($data['slug'])) {
            $data['slug'] = $this->generate_slug($data['title']);
        }

        $this->db->insert('forum_threads', $data);
        return $this->db->insert_id();
    }

    public function create_reply($data)
    {
        $this->db->insert('forum_posts', $data);
        return $this->db->insert_id();
    }

    public function generate_slug($title, $id = null)
    {
        // Create slug from title
        $slug = url_title($title, 'dash', true);

        // If ID is provided, check if this slug already exists for other threads
        if ($id) {
            $this->db->where('slug', $slug);
            $this->db->where('id !=', $id);
            $count = $this->db->count_all_results('forum_threads');

            if ($count > 0) {
                $slug = $slug . '-' . $id;
            }
        } else {
            // For new threads, check if slug exists
            $this->db->where('slug', $slug);
            $count = $this->db->count_all_results('forum_threads');

            if ($count > 0) {
                $slug = $slug . '-' . time();
            }
        }

        return $slug;
    }

    // ========================================
    // POSTS/COMMENTS
    // ========================================

    public function get_posts($thread_id, $limit = 10, $offset = 0)
    {
        // Use LEFT JOIN to prevent missing posts when user is not found
        $this->db->select('fp.*, COALESCE(u.nama_lengkap, "User Deleted") as nama_lengkap, COALESCE(u.username, "deleted") as username');
        $this->db->from('forum_posts fp');
        $this->db->join('users u', 'u.id = fp.user_id', 'LEFT');
        $this->db->where('fp.thread_id', $thread_id);
        $this->db->where('fp.parent_id', 0); // Only top-level posts
        $this->db->order_by('fp.created_at', 'ASC');
        $this->db->limit($limit, $offset);

        return $this->db->get()->result();
    }

    public function get_replies($post_id)
    {
        $this->db->select('fp.*, COALESCE(u.nama_lengkap, "User Deleted") as author_name, COALESCE(u.username, "deleted") as username');
        $this->db->from('forum_posts fp');
        $this->db->join('users u', 'u.id = fp.user_id', 'LEFT');
        $this->db->where('fp.parent_id', $post_id);
        $this->db->order_by('fp.created_at', 'ASC');
        return $this->db->get()->result();
    }

    public function count_posts($thread_id)
    {
        $this->db->where('thread_id', $thread_id);
        return $this->db->count_all_results('forum_posts');
    }

    public function create_post($data)
    {
        $this->db->insert('forum_posts', $data);
        return $this->db->insert_id();
    }

    public function get_posts_by_thread($thread_id, $limit = 10, $offset = 0)
    {
        // Use LEFT JOIN to prevent missing posts when user is not found
        $this->db->select('fp.*, COALESCE(u.nama_lengkap, "User Deleted") as nama_lengkap, COALESCE(u.username, "deleted") as username');
        $this->db->from('forum_posts fp');
        $this->db->join('users u', 'u.id = fp.user_id', 'LEFT');
        $this->db->where('fp.thread_id', $thread_id);
        $this->db->where('fp.parent_id', 0); // Only top-level posts
        $this->db->order_by('fp.created_at', 'ASC');
        $this->db->limit($limit, $offset);

        return $this->db->get()->result();
    }

    public function get_thread_posts_with_replies($thread_id, $user_id = null)
    {
        // Get all posts (including replies) for the thread with like information
        $this->db->select('fp.*, COALESCE(u.nama_lengkap, "User Deleted") as author_name, COALESCE(u.username, "deleted") as username');
        $this->db->select('(SELECT COUNT(*) FROM forum_likes WHERE post_id = fp.id) as like_count');
        if ($user_id) {
            $this->db->select('IF((SELECT COUNT(*) FROM forum_likes WHERE post_id = fp.id AND user_id = ' . (int)$user_id . ') > 0, 1, 0) as user_has_liked');
        } else {
            $this->db->select('0 as user_has_liked');
        }
        $this->db->from('forum_posts fp');
        $this->db->join('users u', 'u.id = fp.user_id', 'LEFT');
        $this->db->where('fp.thread_id', $thread_id);
        $this->db->order_by('fp.created_at', 'ASC');
        
        $posts = $this->db->get()->result();
        
        // Organize posts by parent_id to create hierarchical structure
        $posts_by_id = [];
        $top_level_posts = [];
        
        foreach ($posts as $post) {
            $posts_by_id[$post->id] = $post;
            if ($post->parent_id == 0 || $post->parent_id == null) {
                $top_level_posts[] = $post;
            } else {
                if (!isset($posts_by_id[$post->parent_id]->replies)) {
                    $posts_by_id[$post->parent_id]->replies = [];
                }
                $posts_by_id[$post->parent_id]->replies[] = $post;
            }
        }
        
        return $top_level_posts;
    }

    public function get_thread_with_all_data($thread_id, $user_id = null)
    {
        // Get thread details
        $thread = $this->get_thread($thread_id);
        if (!$thread) {
            return null;
        }

        // Get posts with hierarchical structure
        $thread->posts = $this->get_thread_posts_with_replies($thread_id, $user_id);
        
        // Get view count
        $thread->view_count = $this->get_thread_view_count($thread_id);
        
        // Check if user has viewed this thread
        if ($user_id) {
            $thread->user_has_viewed = $this->has_user_viewed($thread_id, $user_id);
        }
        
        // Get like count and user's like status
        $thread->like_count = $this->count_likes($thread_id, 'thread');
        if ($user_id) {
            $thread->user_has_liked = $this->has_user_liked($user_id, $thread_id, 'thread');
        }
        
        return $thread;
    }

    public function has_user_viewed($thread_id, $user_id)
    {
        $this->db->where('thread_id', $thread_id);
        $this->db->where('user_id', $user_id);
        return $this->db->count_all_results('forum_thread_views') > 0;
    }

    // ========================================
    // LIKES
    // ========================================

    public function count_likes($item_id, $type = 'thread')
    {
        if ($type == 'thread') {
            $this->db->where('thread_id', $item_id);
        } else {
            $this->db->where('post_id', $item_id);
        }
        return $this->db->count_all_results('forum_likes');
    }

    public function has_user_liked($user_id, $item_id, $type = 'thread')
    {
        $this->db->where('user_id', $user_id);
        if ($type == 'thread') {
            $this->db->where('thread_id', $item_id);
        } else {
            $this->db->where('post_id', $item_id);
        }
        return $this->db->count_all_results('forum_likes') > 0;
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

    // ========================================
    // VIEWS
    // ========================================

    public function record_view($thread_id, $user_id)
    {
        // Check if the view already exists
        $this->db->where('thread_id', $thread_id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('forum_thread_views');

        if ($query->num_rows() == 0) {
            // If it doesn't exist, insert it
            $data = [
                'thread_id' => $thread_id,
                'user_id' => $user_id
            ];
            $this->db->insert('forum_thread_views', $data);
        }
    }

    public function record_thread_view($thread_id, $user_id)
    {
        return $this->record_view($thread_id, $user_id);
    }

    public function get_thread_view_count($thread_id)
    {
        return $this->db->where('thread_id', $thread_id)->count_all_results('forum_thread_views');
    }

    public function get_thread_viewers($thread_id)
    {
        $this->db->select('u.nama_lengkap, u.username, fv.viewed_at');
        $this->db->from('forum_thread_views fv');
        $this->db->join('users u', 'u.id = fv.user_id', 'left');
        $this->db->where('fv.thread_id', $thread_id);
        $this->db->order_by('fv.viewed_at', 'DESC');
        $this->db->limit(10);
        
        return $this->db->get()->result();
    }

    // ========================================
    // ADMIN METHODS
    // ========================================

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

    // ========================================
    // CATEGORY MANAGEMENT
    // ========================================

    public function create_category($data)
    {
        return $this->db->insert('forum_categories', $data);
    }

    public function get_similar_threads($category_id, $exclude_thread_id = null, $limit = 5)
    {
        $this->db->select('ft.id, ft.title, ft.created_at, ft.slug, u.nama_lengkap as author_name, u.username');
        $this->db->from('forum_threads ft');
        $this->db->join('users u', 'u.id = ft.user_id', 'left');
        $this->db->where('ft.category_id', $category_id);
        
        if ($exclude_thread_id) {
            $this->db->where('ft.id !=', $exclude_thread_id);
        }
        
        $this->db->order_by('ft.updated_at DESC');
        $this->db->limit($limit);
        
        return $this->db->get()->result();
    }
}
