<?php
class Migration_Populate_forum_thread_slugs extends CI_Migration {
    public function up() {
        // Load the Forum_model to use the generate_slug method
        $CI =& get_instance();
        $CI->load->model('Forum_model');
        
        // Get all threads that don't have a slug
        $CI->db->where('slug IS NULL');
        $threads = $CI->db->get('forum_threads')->result();
        
        foreach ($threads as $thread) {
            // Generate a slug for this thread
            $slug = $CI->Forum_model->generate_slug($thread->title, $thread->id);
            
            // Update the thread with the generated slug
            $CI->db->where('id', $thread->id);
            $CI->db->update('forum_threads', ['slug' => $slug]);
        }
    }
    
    public function down() {
        // Set all slugs to NULL
        $this->db->update('forum_threads', ['slug' => NULL]);
    }
}
