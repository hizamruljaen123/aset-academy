<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_testimonials_table extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'position' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'photo' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'content' => array(
                'type' => 'TEXT',
                'null' => FALSE,
            ),
            'rating' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'unsigned' => TRUE,
                'default' => 5,
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('testimonials');
    }

    public function down()
    {
        $this->dbforge->drop_table('testimonials');
    }
}
