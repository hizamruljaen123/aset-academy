<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Midtrans_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function save_transaction($data)
    {
        // Generate transaction_id if not provided
        if (empty($data['transaction_id'])) {
            $data['transaction_id'] = 'TXN-' . time() . '-' . mt_rand(1000, 9999);
        }

        $this->db->insert('midtrans_transactions', $data);
        return $this->db->insert_id();
    }

    public function update_transaction($order_id, $data)
    {
        // Get existing transaction to check current transaction_id
        $existing = $this->get_transaction_by_order_id($order_id);

        // Don't overwrite transaction_id if it already exists and new value is null
        if ($existing && !empty($existing->transaction_id) && isset($data['transaction_id']) && empty($data['transaction_id'])) {
            unset($data['transaction_id']);
        }

        $this->db->where('order_id', $order_id);
        return $this->db->update('midtrans_transactions', $data);
    }

    public function get_transaction_by_order_id($order_id)
    {
        return $this->db->where('order_id', $order_id)->get('midtrans_transactions')->row();
    }

    public function get_transactions_by_user($user_id, $limit = null, $offset = null)
    {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('created_at', 'DESC');

        if ($limit) {
            $this->db->limit($limit, $offset);
        }

        return $this->db->get('midtrans_transactions')->result();
    }

    public function get_all_transactions($limit = null, $offset = null)
    {
        $this->db->order_by('created_at', 'DESC');

        if ($limit) {
            $this->db->limit($limit, $offset);
        }

        return $this->db->get('midtrans_transactions')->result();
    }

    public function get_transaction_stats()
    {
        $this->db->select('transaction_status, COUNT(*) as count, SUM(gross_amount) as total_amount');
        $this->db->group_by('transaction_status');
        return $this->db->get('midtrans_transactions')->result();
    }
}
