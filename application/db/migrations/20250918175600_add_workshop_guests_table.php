<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_workshop_guests_table extends CI_Migration {

    public function up()
    {
        // Workshop guests table
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
            'nama_lengkap' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'asal_kampus_sekolah' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'usia' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'pekerjaan' => [
                'type' => 'ENUM("Pelajar","Mahasiswa","Karyawan","Wirausaha","PNS","Guru/Dosen","Lainnya")',
                'default' => 'Pelajar'
            ],
            'province_id' => [
                'type' => 'CHAR',
                'constraint' => 2,
                'null' => TRUE
            ],
            'regency_id' => [
                'type' => 'CHAR',
                'constraint' => 4,
                'null' => TRUE
            ],
            'district_id' => [
                'type' => 'CHAR',
                'constraint' => 6,
                'null' => TRUE
            ],
            'no_wa_telegram' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'registered_at' => [
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP'
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_foreign_key('workshop_id', 'workshops', 'id', 'CASCADE', 'CASCADE');
        $this->dbforge->add_foreign_key('province_id', 'reg_provinces', 'id', 'SET NULL', 'SET NULL');
        $this->dbforge->add_foreign_key('regency_id', 'reg_regencies', 'id', 'SET NULL', 'SET NULL');
        $this->dbforge->add_foreign_key('district_id', 'reg_districts', 'id', 'SET NULL', 'SET NULL');
        $this->dbforge->create_table('workshop_guests');
    }

    public function down()
    {
        $this->dbforge->drop_table('workshop_guests', TRUE);
    }
}
