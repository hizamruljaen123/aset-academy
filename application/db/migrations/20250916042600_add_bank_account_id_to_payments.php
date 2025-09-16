<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_bank_account_id_to_payments extends CI_Migration {

    public function up()
    {
        // Add bank_account_id column to payments table
        $fields = [
            'bank_account_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
                'after' => 'account_number'
            ]
        ];
        
        $this->dbforge->add_column('payments', $fields);

        // Add foreign key constraint
        $this->db->query('ALTER TABLE payments ADD CONSTRAINT fk_payments_bank_account FOREIGN KEY (bank_account_id) REFERENCES company_bank_accounts(id) ON DELETE SET NULL');
    }

    public function down()
    {
        // Remove foreign key constraint
        $this->db->query('ALTER TABLE payments DROP FOREIGN KEY fk_payments_bank_account');
        
        // Remove bank_account_id column
        $this->dbforge->drop_column('payments', 'bank_account_id');
    }
}