<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_payment_description_fields extends CI_Migration {

    public function up()
    {
        // Add payment description fields to payments table
        $fields = [
            'payment_description' => [
                'type' => 'TEXT',
                'null' => TRUE,
                'after' => 'account_number'
            ],
            'user_bank_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
                'after' => 'payment_description'
            ],
            'user_account_holder' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
                'after' => 'user_bank_name'
            ],
            'invoice_number' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => TRUE,
                'after' => 'user_account_holder'
            ],
            'invoice_generated_at' => [
                'type' => 'TIMESTAMP',
                'null' => TRUE,
                'after' => 'invoice_number'
            ]
        ];

        $this->dbforge->add_column('payments', $fields);
    }

    public function down()
    {
        // Remove the added columns
        $this->dbforge->drop_column('payments', 'payment_description');
        $this->dbforge->drop_column('payments', 'user_bank_name');
        $this->dbforge->drop_column('payments', 'user_account_holder');
        $this->dbforge->drop_column('payments', 'invoice_number');
        $this->dbforge->drop_column('payments', 'invoice_generated_at');
    }
}