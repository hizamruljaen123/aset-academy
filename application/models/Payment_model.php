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
}
