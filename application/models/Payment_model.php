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

    // Update payment proof
    public function update_payment_proof($payment_id, $payment_proof) {
        $this->db->where('id', $payment_id);
        return $this->db->update('payments', [
            'payment_proof' => $payment_proof,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    // Get pending payments for a specific user
    public function get_user_pending_payments($user_id) {
        return $this->db->select('payments.*, kelas_programming.nama_kelas as class_name, kelas_programming.bahasa_program, kelas_programming.level, kelas_programming.durasi')
                       ->from('payments')
                       ->join('kelas_programming', 'kelas_programming.id = payments.class_id')
                       ->where('payments.user_id', $user_id)
                       ->where('payments.status', 'Pending')
                       ->order_by('payments.created_at', 'DESC')
                       ->get()
                       ->result();
    }

    // Get completed payments for a specific user
    public function get_user_completed_payments($user_id) {
        return $this->db->select('payments.*, kelas_programming.nama_kelas as class_name, kelas_programming.bahasa_program, kelas_programming.level, kelas_programming.durasi')
                       ->from('payments')
                       ->join('kelas_programming', 'kelas_programming.id = payments.class_id')
                       ->where('payments.user_id', $user_id)
                       ->where_in('payments.status', ['Verified', 'Rejected'])
                       ->order_by('payments.created_at', 'DESC')
                       ->get()
                       ->result();
    }

    // Get all payments for a specific user (for orders page)
    public function get_user_all_payments($user_id) {
        $payments = $this->db->select('payments.*, kelas_programming.nama_kelas as class_name, kelas_programming.bahasa_program, kelas_programming.level, kelas_programming.durasi')
                       ->from('payments')
                       ->join('kelas_programming', 'kelas_programming.id = payments.class_id')
                       ->where('payments.user_id', $user_id)
                       ->order_by('payments.created_at', 'DESC')
                       ->get()
                       ->result();

        // Add class object to each payment
        foreach ($payments as $payment) {
            $class = $this->db->where('id', $payment->class_id)->get('kelas_programming')->row();
            $payment->class = $class;
        }

        return $payments;
    }
}
