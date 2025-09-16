<?php
class Payment_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    // Get pending payments for admin verification
    public function get_pending_payments() {
        return $this->db->select('payments.*, users.nama_lengkap as user_name, users.email as user_email, kelas_programming.nama_kelas as class_name')
                       ->from('payments')
                       ->join('users', 'users.id = payments.user_id')
                       ->join('kelas_programming', 'kelas_programming.id = payments.class_id')
                       ->where('payments.status', 'Pending')
                       ->order_by('payments.created_at', 'DESC')
                       ->get()
                       ->result();
    }

    // Get payment by ID
    public function get_payment($payment_id) {
        return $this->db->where('id', $payment_id)->get('payments')->row();
    }

    // Get user payments
    public function get_user_payments($user_id) {
        return $this->db->select('payments.*, kelas_programming.nama_kelas as class_name')
                       ->from('payments')
                       ->join('kelas_programming', 'kelas_programming.id = payments.class_id')
                       ->where('user_id', $user_id)
                       ->order_by('created_at', 'DESC')
                       ->get()
                       ->result();
    }

    // Get payment with full details
    public function get_payment_with_details($payment_id) {
        return $this->db->select('payments.*, kelas_programming.nama_kelas as class_name, company_bank_accounts.bank_name as company_bank_name, company_bank_accounts.account_number as company_account_number, company_bank_accounts.account_holder as company_account_holder')
                       ->from('payments')
                       ->join('kelas_programming', 'kelas_programming.id = payments.class_id')
                       ->join('company_bank_accounts', 'company_bank_accounts.id = payments.bank_account_id', 'left')
                       ->where('payments.id', $payment_id)
                       ->get()
                       ->row();
    }
}
