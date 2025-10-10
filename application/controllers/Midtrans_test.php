<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Midtrans_test extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->config->load('midtrans');
        $this->load->helper('url');
    }

    public function index()
    {
        $client_key = $this->config->item('midtrans_client_key');
        $is_production = $this->config->item('midtrans_is_production');
        $snap_js_url = $is_production
            ? 'https://app.midtrans.com/snap/snap.js'
            : 'https://app.sandbox.midtrans.com/snap/snap.js';
        $data = [
            'title' => 'Midtrans Payment Testing',
            'client_key' => $client_key,
            'is_production' => $is_production,
            'snap_js_url' => $snap_js_url,
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('midtrans/test', $data);
        $this->load->view('templates/footer');
    }

    public function create_transaction()
    {
        if (strtoupper($this->input->server('REQUEST_METHOD')) !== 'POST') {
            show_404();
        }

        $amount = $this->input->post('amount');
        $customer_name = $this->input->post('customer_name');
        $customer_email = $this->input->post('customer_email');

        if (!$amount || !is_numeric($amount)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode(['error' => 'Invalid amount value']));
        }

        $transaction_details = [
            'order_id' => 'MIDTEST-' . time(),
            'gross_amount' => (int) $amount,
        ];

        $customer_details = [
            'first_name' => $customer_name ?: 'Test User',
            'email' => $customer_email ?: 'test@example.com',
        ];

        $payload = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'enabled_payments' => [
                'credit_card',
                'gopay',
                'shopeepay',
                'bca_va',
                'bni_va',
                'bri_va',
                'permata_va',
                'other_va',
                'kredivo',
                'akulaku',
            ],
        ];

        $is_production = $this->config->item('midtrans_is_production');
        $server_key = $this->config->item('midtrans_server_key');

        $snap_url = $is_production
            ? 'https://app.midtrans.com/snap/v1/transactions'
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

        $ch = curl_init($snap_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Basic ' . base64_encode($server_key . ':'),
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

        $response = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            $error_message = curl_error($ch);
            curl_close($ch);
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode(['error' => $error_message]));
        }

        curl_close($ch);

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header($http_status)
            ->set_output($response);
    }
}
