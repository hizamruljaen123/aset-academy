<?php
class Migration_Create_materi_progress_table extends CI_Migration {
    public function up() {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'materi_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ],
            'siswa_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Not Started','In Progress','Completed'],
                'default' => 'Not Started'
            ],
            'last_accessed' => [
                'type' => 'TIMESTAMP',
                'null' => TRUE
            ],
            'completion_date' => [
                'type' => 'TIMESTAMP',
                'null' => TRUE
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);
        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key(['materi_id', 'siswa_id'], TRUE);
        $this->dbforge->create_table('materi_progress');
        
        // Add foreign key constraint
        $this->db->query('ALTER TABLE materi_progress ADD CONSTRAINT fk_materi_id FOREIGN KEY (materi_id) REFERENCES materi(id) ON DELETE CASCADE');
    }
    
    public function down() {
        $this->dbforge->drop_table('materi_progress');
    }
}
