<?php
class Company_bank_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    // Get all active bank accounts
    public function get_active_bank_accounts() {
        return $this->db->where('is_active', 1)
                       ->order_by('display_order', 'ASC')
                       ->get('company_bank_accounts')
                       ->result();
    }

    // Get bank account by ID
    public function get_bank_account($id) {
        return $this->db->where('id', $id)
                       ->where('is_active', 1)
                       ->get('company_bank_accounts')
                       ->row();
    }

    // Get bank account by bank code
    public function get_bank_by_code($bank_code) {
        return $this->db->where('bank_code', $bank_code)
                       ->where('is_active', 1)
                       ->get('company_bank_accounts')
                       ->row();
    }

    // Get all bank accounts (including inactive)
    public function get_all_bank_accounts() {
        return $this->db->order_by('display_order', 'ASC')
                       ->get('company_bank_accounts')
                       ->result();
    }

    // Create new bank account
    public function create_bank_account($data) {
        $this->db->insert('company_bank_accounts', $data);
        return $this->db->insert_id();
    }

    // Update bank account
    public function update_bank_account($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('company_bank_accounts', $data);
        return $this->db->affected_rows();
    }

    // Delete bank account
    public function delete_bank_account($id) {
        $this->db->where('id', $id);
        $this->db->delete('company_bank_accounts');
        return $this->db->affected_rows();
    }
}