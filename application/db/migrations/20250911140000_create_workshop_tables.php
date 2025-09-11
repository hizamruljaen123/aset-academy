<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_workshop_tables extends CI_Migration {

    public function up()
    {
        // Workshops table
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => TRUE
            ],
            'description' => [
                'type' => 'TEXT'
            ],
            'type' => [
                'type' => 'ENUM("workshop","seminar")',
                'default' => 'workshop'
            ],
            'price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00
            ],
            'start_datetime' => [
                'type' => 'DATETIME'
            ],
            'end_datetime' => [
                'type' => 'DATETIME'
            ],
            'location' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'max_participants' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'thumbnail' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ],
            'status' => [
                'type' => 'ENUM("draft","published","completed")',
                'default' => 'draft'
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP'
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => TRUE
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('workshops');

        // Workshop materials table
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'workshop_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'file_path' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'file_type' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP'
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_foreign_key('workshop_id', 'workshops', 'id', 'CASCADE', 'CASCADE');
        $this->dbforge->create_table('workshop_materials');

        // Workshop participants table
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'workshop_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE
            ],
            'external_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ],
            'external_email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ],
            'role' => [
                'type' => 'ENUM("student","teacher","external")',
                'default' => 'external'
            ],
            'status' => [
                'type' => 'ENUM("registered","attended","cancelled")',
                'default' => 'registered'
            ],
            'registered_at' => [
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP'
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_foreign_key('workshop_id', 'workshops', 'id', 'CASCADE', 'CASCADE');
        $this->dbforge->add_foreign_key('user_id', 'users', 'id', 'CASCADE', 'SET NULL');
        $this->dbforge->create_table('workshop_participants');
    }

    public function down()
    {
        $this->dbforge->drop_table('workshop_participants', TRUE);
        $this->dbforge->drop_table('workshop_materials', TRUE);
        $this->dbforge->drop_table('workshops', TRUE);
    }
}
