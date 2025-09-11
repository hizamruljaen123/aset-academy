<?php
class Migration_Add_slug_to_forum_threads extends CI_Migration {
    public function up() {
        // Add slug column to forum_threads table
        $fields = [
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
                'unique' => TRUE
            ]
        ];
        
        $this->dbforge->add_column('forum_threads', $fields);
        
        // Add index for better performance
        $this->db->query('ALTER TABLE forum_threads ADD INDEX idx_slug (slug)');
    }
    
    public function down() {
        // Remove slug column from forum_threads table
        $this->dbforge->drop_column('forum_threads', 'slug');
    }
}
