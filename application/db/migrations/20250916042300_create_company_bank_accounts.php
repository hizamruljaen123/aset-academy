<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_company_bank_accounts extends CI_Migration {

    public function up()
    {
        // Company bank accounts table
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'bank_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE
            ],
            'bank_code' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => TRUE
            ],
            'account_number' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => FALSE
            ],
            'account_holder' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE,
                'default' => 'CV ASET MEDIA CEMERLANG'
            ],
            'is_active' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1
            ],
            'display_order' => [
                'type' => 'INT',
                'constraint' => 3,
                'default' => 0
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP'
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP',
                'on_update' => 'CURRENT_TIMESTAMP'
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('company_bank_accounts');

        // Insert sample bank accounts data
        $bank_accounts = [
            [
                'bank_name' => 'Bank Central Asia (BCA)',
                'bank_code' => 'BCA',
                'account_number' => '1234567890',
                'account_holder' => 'CV ASET MEDIA CEMERLANG',
                'display_order' => 1
            ],
            [
                'bank_name' => 'Bank Rakyat Indonesia (BRI)',
                'bank_code' => 'BRI',
                'account_number' => '0234567890',
                'account_holder' => 'CV ASET MEDIA CEMERLANG',
                'display_order' => 2
            ],
            [
                'bank_name' => 'Bank Negara Indonesia (BNI)',
                'bank_code' => 'BNI',
                'account_number' => '3456789012',
                'account_holder' => 'CV ASET MEDIA CEMERLANG',
                'display_order' => 3
            ],
            [
                'bank_name' => 'Bank Mandiri',
                'bank_code' => 'Mandiri',
                'account_number' => '7890123456',
                'account_holder' => 'CV ASET MEDIA CEMERLANG',
                'display_order' => 4
            ],
            [
                'bank_name' => 'CIMB Niaga',
                'bank_code' => 'CIMB',
                'account_number' => '0145678901',
                'account_holder' => 'CV ASET MEDIA CEMERLANG',
                'display_order' => 5
            ]
        ];

        $this->db->insert_batch('company_bank_accounts', $bank_accounts);
    }

    public function down()
    {
        $this->dbforge->drop_table('company_bank_accounts', TRUE);
    }
}