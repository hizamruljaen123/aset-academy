<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Midtrans extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Midtrans_model');
        $this->config->load('midtrans');
        $this->load->helper('settings');

        // Check if user is super admin
        if (!$this->session->userdata('logged_in') || $this->session->userdata('level') != '1') {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Midtrans Management',
            'transactions' => $this->Midtrans_model->get_all_transactions(50),
            'stats' => $this->Midtrans_model->get_transaction_stats()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('admin/midtrans/index', $data);
        $this->load->view('templates/footer');
    }

    public function settings()
    {
        $data = [
            'title' => 'Midtrans Settings',
            'config' => [
                'is_production' => $this->config->item('midtrans_is_production'),
                'server_key' => $this->config->item('midtrans_server_key'),
                'client_key' => $this->config->item('midtrans_client_key'),
                'merchant_id' => $this->config->item('midtrans_merchant_id'),
            ]
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('admin/midtrans/settings', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Save maintenance mode settings
     */
    public function save_maintenance()
    {
        // Check if this is an AJAX request
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        // Check if user is admin
        if (!$this->session->userdata('logged_in') || $this->session->userdata('level') != '1') {
            $this->output->set_status_header(403);
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
            return;
        }

        // Get POST data
        $maintenance_mode = $this->input->post('maintenance_mode', true);
        $maintenance_message = $this->input->post('maintenance_message', true);

        // Validate input
        if (!in_array($maintenance_mode, ['0', '1'])) {
            $this->output->set_status_header(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid maintenance mode']);
            return;
        }

        // Save settings to database
        $this->load->model('Settings_model');
        
        // Save maintenance mode
        $this->Settings_model->set_setting('midtrans_maintenance_mode', $maintenance_mode, 'boolean');
        
        // Save maintenance message if provided
        if ($maintenance_message !== null) {
            $this->Settings_model->set_setting('midtrans_maintenance_message', $maintenance_message, 'string');
        }

        // Return success response
        echo json_encode([
            'status' => 'success',
            'message' => 'Pengaturan maintenance mode berhasil disimpan'
        ]);
    }

    public function test()
    {
        $this->load->model('Kelas_programming_model');
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
            'classes' => $this->Kelas_programming_model->get_all_active_classes() // Ambil semua kelas aktif
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('admin/midtrans/test', $data);
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
        $class_id = $this->input->post('class_id');
        $user_id = $this->input->post('user_id') ?: $this->session->userdata('user_id');

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

        $response_data = json_decode($response, true);

        if ($http_status == 201 && isset($response_data['token'])) {
            // Save transaction to database
            $transaction_data = [
                'order_id' => $transaction_details['order_id'],
                'transaction_id' => $response_data['transaction_id'] ?? null,
                'payment_type' => null,
                'transaction_status' => 'pending',
                'gross_amount' => $transaction_details['gross_amount'],
                'user_id' => $user_id,
                'class_id' => $class_id ?: null,
                'customer_details' => json_encode($customer_details),
                'payment_data' => $response,
                'redirect_url' => $response_data['redirect_url'] ?? null,
            ];

            $this->Midtrans_model->save_transaction($transaction_data);
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header($http_status)
            ->set_output($response);
    }

    public function update_transaction_status()
    {
        // This would be called by Midtrans webhook
        // For now, just handle manual status updates

        $order_id = $this->input->post('order_id');
        $status = $this->input->post('status');

        if (!$order_id || !$status) {
            $this->session->set_flashdata('error', 'Order ID dan status diperlukan');
            redirect('admin/midtrans');
        }

        $update_data = [
            'transaction_status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->Midtrans_model->update_transaction($order_id, $update_data);

        $this->session->set_flashdata('success', 'Status transaksi berhasil diperbarui');
        redirect('admin/midtrans');
    }

    public function delete_transaction($order_id)
    {
        // In production, you might want to soft delete instead
        $this->db->where('order_id', $order_id)->delete('midtrans_transactions');

        $this->session->set_flashdata('success', 'Transaksi berhasil dihapus');
        redirect('admin/midtrans');
    }

    // Handle Midtrans notification/webhook
    public function notification() {
        // Get raw POST data
        $raw_post_data = file_get_contents('php://input');
        $notification = json_decode($raw_post_data, true);

        if (!$notification) {
            log_message('error', 'Invalid Midtrans notification: ' . $raw_post_data);
            http_response_code(400);
            exit;
        }

        $order_id = $notification['order_id'];
        $transaction_status = $notification['transaction_status'];
        $payment_type = $notification['payment_type'] ?? null;
        $transaction_id = $notification['transaction_id'] ?? null;

        // Generate transaction_id if not provided by Midtrans
        if (!$transaction_id) {
            $transaction_id = 'TXN-' . time() . '-' . mt_rand(1000, 9999);
        }

        log_message('info', 'Midtrans notification received: ' . $order_id . ' - ' . $transaction_status . ' - TXN: ' . $transaction_id);

        // Update Midtrans transaction
        $this->Midtrans_model->update_transaction($order_id, [
            'transaction_status' => $transaction_status,
            'payment_type' => $payment_type,
            'transaction_id' => $transaction_id,
            'payment_data' => json_encode($notification)
        ]);

        // Extract payment ID from order_id (format: PAY-{payment_id}-{timestamp})
        if (preg_match('/PAY-(\d+)-/', $order_id, $matches)) {
            $payment_id = $matches[1];

            // Update payment status based on transaction status
            $payment_status = 'Pending';
            $notes = '';

            switch ($transaction_status) {
                case 'settlement':
                case 'capture':
                    $payment_status = 'Verified';
                    $notes = 'Pembayaran berhasil melalui Midtrans';

                    // Create premium class enrollment
                    $payment = $this->db->where('id', $payment_id)->get('payments')->row();
                    if ($payment) {
                        $this->load->model('Premium_enrollment_model');
                        $enrollment_data = [
                            'class_id' => $payment->class_id,
                            'student_id' => $payment->user_id,
                            'payment_id' => $payment->id,
                            'status' => 'Active'
                        ];
                        $this->Premium_enrollment_model->create_enrollment($enrollment_data);
                    }
                    break;

                case 'pending':
                    $payment_status = 'Pending';
                    $notes = 'Pembayaran sedang diproses';
                    break;

                case 'deny':
                case 'cancel':
                case 'expire':
                case 'failure':
                    $payment_status = 'Rejected';
                    $notes = 'Pembayaran gagal/ditolak: ' . $transaction_status;
                    break;
            }

            // Update payment record
            $this->db->where('id', $payment_id)->update('payments', [
                'status' => $payment_status,
                'notes' => $notes,
                'verified_by' => null, // Auto-verified by Midtrans
                'verified_at' => date('Y-m-d H:i:s')
            ]);

            log_message('info', 'Payment ' . $payment_id . ' updated to status: ' . $payment_status);
        }

        // Return success response
        http_response_code(200);
        echo 'OK';
        exit;
    }
}
