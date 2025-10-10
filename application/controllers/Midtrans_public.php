<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Midtrans_public extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Midtrans_model');
        $this->load->helper('url');
    }

    public function success()
    {
        $order_id = $this->input->get('order_id');
        $transaction_status = $this->input->get('transaction_status');

        if (!$order_id) {
            show_404();
        }

        // Ambil data transaksi dari database
        $transaction = $this->Midtrans_model->get_transaction_by_order_id($order_id);

        if (!$transaction) {
            $data = [
                'title' => 'Pembayaran Berhasil',
                'error' => 'Transaksi tidak ditemukan',
                'order_id' => $order_id
            ];
        } else {
            $data = [
                'title' => 'Pembayaran Berhasil',
                'transaction' => $transaction,
                'status_message' => $this->get_status_message($transaction->transaction_status)
            ];
        }

        $this->load->view('midtrans/success', $data);
    }

    private function get_status_message($status)
    {
        $messages = [
            'pending' => 'Pembayaran sedang diproses',
            'settlement' => 'Pembayaran berhasil diterima',
            'capture' => 'Pembayaran berhasil ditangkap',
            'deny' => 'Pembayaran ditolak',
            'cancel' => 'Pembayaran dibatalkan',
            'expire' => 'Pembayaran kadaluarsa',
            'failure' => 'Pembayaran gagal',
            'refund' => 'Pembayaran dikembalikan',
            'partial_refund' => 'Pembayaran sebagian dikembalikan',
            'chargeback' => 'Chargeback dilakukan',
            'partial_chargeback' => 'Chargeback sebagian dilakukan'
        ];

        return $messages[$status] ?? 'Status tidak diketahui';
    }
}
