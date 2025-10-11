<?php
class Payment extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Kelas_programming_model');
        $this->load->model('Payment_model');
        $this->load->model('Company_bank_model');
        $this->load->model('Settings_model');
        $this->load->library('form_validation');
        $this->load->library('encryption_url');
        
        // Load settings helper if not loaded
        if (!function_exists('get_setting')) {
            $this->load->helper('settings');
        }
    }
    
    /**
     * Check if Midtrans is in maintenance mode
     */
    private function _check_maintenance_mode() {
        $maintenance_mode = get_setting('midtrans_maintenance_mode');
        if ($maintenance_mode == '1') {
            $message = get_setting('midtrans_maintenance_message', 'Pembayaran sedang dalam perbaikan. Silakan coba lagi nanti.');
            
            if ($this->input->is_ajax_request()) {
                $this->output->set_status_header(503);
                echo json_encode([
                    'status' => 'error',
                    'message' => $message
                ]);
            } else {
                $this->session->set_flashdata('error', $message);
                redirect('payment/orders');
            }
            exit();
        }
    }

    // Initiate payment for a class
    public function initiate($encrypted_class_id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        
        // Check for maintenance mode
        $this->_check_maintenance_mode();

        $class_id = $this->encryption_url->decode($encrypted_class_id);
        if (!$class_id) {
            log_message('error', 'Failed to decrypt class_id: ' . $encrypted_class_id);
            show_404();
        }

        $class = $this->Kelas_programming_model->get_kelas_by_id($class_id);
        if (!$class) {
            log_message('error', 'Class not found: ' . $class_id);
            show_404();
        }

        log_message('info', 'Payment initiate for class_id: ' . $class_id . ', user_id: ' . $this->session->userdata('user_id'));

        // Check if already enrolled in premium class (avoid duplicate payment for premium classes)
        $premium_enrollment = $this->db->where([
                'class_id' => $class_id,
                'student_id' => $this->session->userdata('user_id')
            ])
            ->where_in('status', ['Pending', 'Active', 'Completed'])
            ->get('premium_class_enrollments')
            ->row();
        if ($premium_enrollment) {
            // If enrollment exists, send to payment status if we have the payment id, else to student premium page
            if (!empty($premium_enrollment->payment_id)) {
                redirect('payment/status/' . $premium_enrollment->payment_id);
            } else {
                $this->session->set_flashdata('message', 'Anda sudah terdaftar di kelas ini.');
                redirect('student/premium');
            }
        }

        // Check if already has pending payment
        $pending_payment = $this->db->where([
            'class_id' => $class_id, 
            'user_id' => $this->session->userdata('user_id'),
            'status' => 'Pending'
        ])->get('payments')->row();

        if ($pending_payment) {
            $this->session->set_flashdata('message', 'Anda sudah memiliki pembayaran yang sedang diverifikasi');
            redirect('payment/status/' . $pending_payment->id);
        }

        // Get active bank accounts (destination banks)
        $bank_accounts = $this->Company_bank_model->get_active_bank_accounts();

        // Get available banks for sender selection
        $sender_banks = $this->db->order_by('nama_bank', 'ASC')->get('daftar_bank')->result();

        // Midtrans configuration
        $this->config->load('midtrans');
        $midtrans_config = [
            'is_production' => $this->config->item('midtrans_is_production'),
            'client_key' => $this->config->item('midtrans_client_key'),
            'server_key' => $this->config->item('midtrans_server_key'),
            'merchant_id' => $this->config->item('midtrans_merchant_id')
        ];

        $data = [
            'title' => 'Pembayaran Kelas',
            'class' => $class,
            'user' => $this->db->where('id', $this->session->userdata('user_id'))->get('users')->row(),
            'bank_accounts' => $bank_accounts,
            'sender_banks' => $sender_banks,
            'midtrans_config' => $midtrans_config
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('payment/initiate', $data);
        $this->load->view('templates/footer');
    }

    // Show payment confirmation page
    public function confirm($class_id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        $class = $this->Kelas_programming_model->get_kelas_by_id($class_id);
        if (!$class) {
            show_404();
        }

        $this->form_validation->set_rules('payment_method', 'Metode Pembayaran', 'required');
        $this->form_validation->set_rules('bank_name', 'Nama Bank', 'trim');
        $this->form_validation->set_rules('account_number', 'Nomor Rekening', 'trim');
        $this->form_validation->set_rules('bank_account_id', 'ID Bank Perusahaan', 'trim');
        $this->form_validation->set_rules('payment_description', 'Keterangan Pembayaran', 'trim');
        $this->form_validation->set_rules('user_bank_name', 'Nama Bank Pengirim', 'trim');
        $this->form_validation->set_rules('user_account_holder', 'Nama Pemilik Rekening', 'trim');

        if ($this->form_validation->run() == FALSE) {
            $this->initiate($class_id);
        } else {
            // Store payment data in session for confirmation
            $payment_data = [
                'class_id' => $class_id,
                'amount' => $this->input->post('amount'),
                'payment_method' => $this->input->post('payment_method'),
                'bank_name' => $this->input->post('bank_name'),
                'account_number' => $this->input->post('account_number'),
                'bank_account_id' => $this->input->post('bank_account_id'),
                'payment_description' => $this->input->post('payment_description'),
                'user_bank_name' => $this->input->post('user_bank_name'),
                'user_account_holder' => $this->input->post('user_account_holder')
            ];
            
            $this->session->set_userdata('payment_confirmation', $payment_data);
            
            $data = [
                'title' => 'Konfirmasi Pembayaran',
                'class' => $class,
                'payment_data' => $payment_data
            ];

            $this->load->view('payment/confirm', $data);
            $this->load->view('templates/footer');
        }
    }

    /**
     * Process payment creation (without proof initially)
     * @param int $class_id The ID of the class to process payment for
     */
    public function process_payment($class_id) {
        log_message('info', 'Process payment called for class_id: ' . $class_id . ', user_id: ' . $this->session->userdata('user_id'));
        log_message('info', 'Request method: ' . $this->input->server('REQUEST_METHOD'));
        
        if (!$this->session->userdata('logged_in')) {
            log_message('error', 'User not logged in');
            redirect('auth');
        }

        // Only allow POST submissions to prevent CSRF token errors on direct URL access
        if (strtoupper($this->input->server('REQUEST_METHOD')) !== 'POST') {
            log_message('error', 'Invalid request method: ' . $this->input->server('REQUEST_METHOD'));
            redirect('payment/initiate/' . $this->encryption_url->encode($class_id));
        }

        // Check if user is a student
        if ($this->session->userdata('role') != 'siswa') {
            $this->session->set_flashdata('error', 'Hanya siswa yang dapat memproses pembayaran kelas premium.');
            redirect('student');
        }

        $class = $this->Kelas_programming_model->get_kelas_by_id($class_id);
        if (!$class) {
            show_404();
        }

        // Check if already has pending payment
        $pending_payment = $this->db->where([
            'class_id' => $class_id,
            'user_id' => $this->session->userdata('user_id'),
            'status' => 'Pending'
        ])->get('payments')->row();

        if ($pending_payment) {
            $this->session->set_flashdata('message', 'Anda sudah memiliki pembayaran yang sedang diverifikasi');
            redirect('payment/status/' . $pending_payment->id);
        }

        $this->form_validation->set_rules('payment_method', 'Metode Pembayaran', 'required');
        $this->form_validation->set_rules('amount', 'Jumlah Pembayaran', 'required|numeric');

        $payment_method = $this->input->post('payment_method');

        // Additional validation for Transfer method
        if ($payment_method === 'Transfer') {
            $this->form_validation->set_rules('bank_account_id', 'Bank Tujuan', 'required');
            $this->form_validation->set_rules('user_bank_name', 'Nama Bank Pengirim', 'required');
            $this->form_validation->set_rules('user_account_holder', 'Nama Pemilik Rekening', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            // Debug: Log validation errors
            log_message('error', 'Payment validation failed: ' . validation_errors());
            log_message('error', 'POST data: ' . print_r($this->input->post(), true));

            // Set flashdata for validation errors
            $this->session->set_flashdata('error', 'Harap lengkapi semua field yang diperlukan: ' . validation_errors());

            $this->initiate($this->encryption_url->encode($class_id));
            return;
        }

        // Handle Midtrans payment
        if ($payment_method === 'Midtrans') {
            return $this->process_midtrans_payment($class_id);
        }

        // Generate invoice number
        $invoice_number = 'INV-' . date('Ymd') . '-' . str_pad($this->session->userdata('user_id'), 4, '0', STR_PAD_LEFT) . '-' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

        if ($payment_method === 'Transfer') {
            $bank_account_id = $this->input->post('bank_account_id');
            $bank_account_id = ($bank_account_id !== null && $bank_account_id !== '') ? (int) $bank_account_id : null;
            $bank_name = $this->input->post('bank_name');
            $account_number = $this->input->post('account_number');
            $user_bank_name = $this->input->post('user_bank_name');
            $user_account_holder = $this->input->post('user_account_holder');
        } else {
            $bank_account_id = null;
            $bank_name = null;
            $account_number = null;
            $user_bank_name = null;
            $user_account_holder = null;
        }

        $payment_data = [
            'user_id' => $this->session->userdata('user_id'),
            'class_id' => $class_id,
            'amount' => $this->input->post('amount'),
            'payment_method' => $payment_method,
            'bank_name' => $bank_name,
            'account_number' => $account_number,
            'bank_account_id' => $bank_account_id,
            'payment_description' => $this->input->post('payment_description'),
            'user_bank_name' => $user_bank_name,
            'user_account_holder' => $user_account_holder,
            'invoice_number' => $invoice_number,
            'invoice_generated_at' => date('Y-m-d H:i:s'),
            'payment_proof' => null, // No proof initially
            'status' => 'Pending',
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('payments', $payment_data);
        if ($this->db->affected_rows() > 0) {
            $payment_id = $this->db->insert_id();

            $this->session->set_flashdata('success', 'Pesanan pembayaran berhasil dibuat. Silakan lakukan pembayaran dan upload bukti pembayaran.');
            redirect('payment/status/' . $payment_id);
        } else {
            $this->session->set_flashdata('error', 'Gagal membuat pesanan pembayaran. Silakan coba lagi.');
            redirect('payment/initiate/' . $this->encryption_url->encode($class_id));
        }
    }

    // View payment status
    public function status($payment_id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        // Decode the payment ID if it's encrypted
        if (!is_numeric($payment_id)) {
            $payment_id = str_replace(array('-', '_'), array('+', '/'), $payment_id);
            $payment_id = $this->encryption_url->decode($payment_id);
        }

        $payment = $this->Payment_model->get_payment_with_details($payment_id);
        if (!$payment || $payment->user_id != $this->session->userdata('user_id')) {
            show_404();
        }

        if (!$payment) {
            show_404();
        }

        $class = $this->Kelas_programming_model->get_kelas_by_id($payment->class_id);

        // Get enrollment if payment is verified
        $enrollment = null;
        if ($payment->status == 'Verified') {
            $this->load->model('Premium_enrollment_model');
            $enrollment = $this->Premium_enrollment_model->get_enrollment($payment->user_id, $payment->class_id);
        }

        // Load Midtrans transaction if payment method is Midtrans
        $midtrans_transaction = null;
        if ($payment->payment_method == 'Midtrans' && !empty($payment->payment_description)) {
            $this->load->model('Midtrans_model');
            $midtrans_transaction = $this->Midtrans_model->get_transaction_by_order_id($payment->payment_description);
        }

        $data = [
            'title' => 'Status Pembayaran',
            'payment' => $payment,
            'class' => $class,
            'enrollment' => $enrollment,
            'midtrans_transaction' => $midtrans_transaction
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('payment/status', $data);
        $this->load->view('templates/footer');
    }

    // View all payment orders for logged-in student
    public function orders() {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        $user_id = $this->session->userdata('user_id');
        $payments = $this->Payment_model->get_user_payments($user_id);

        // Generate secure URLs for all payment-related links with encrypted IDs
        foreach ($payments as &$payment) {
            $encrypted_id = $this->encryption_url->encode($payment->id);
            $url_safe_id = str_replace(['+', '/'], ['-', '_'], $encrypted_id);
            $payment->secure_status_url = 'payment/status/' . $url_safe_id;
            $payment->secure_upload_url = 'payment/upload_payment_proof/' . $url_safe_id;
        }

        $data = [
            'title' => 'Daftar Pemesanan Kelas',
            'payments' => $payments
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('payment/orders', $data);
        $this->load->view('templates/footer');
    }

    // Admin payment verification
    public function admin_verify() {
        if ($this->session->userdata('level') != '1' && $this->session->userdata('level') != '2') {
            redirect('auth/login');
        }

        $payments = $this->Payment_model->get_pending_payments();

        $data = [
            'title' => 'Verifikasi Pembayaran',
            'payments' => $payments
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('admin/payment/verify', $data);
        $this->load->view('templates/footer');
    }

    // Purchase method - only accessible to students
    public function purchase($class_id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        // Check if user is a student
        if ($this->session->userdata('role') != 'siswa') {
            $this->session->set_flashdata('error', 'Hanya siswa yang dapat membeli kelas premium.');
            redirect('student');
        }

        $this->load->model('Kelas_programming_model');
        $class = $this->Kelas_programming_model->get_kelas_by_id($class_id);
        if (!$class) {
            show_404();
        }

        // Check if the user has already purchased the class
        $is_purchased = $this->db->where([
            'class_id' => $class_id,
            'user_id' => $this->session->userdata('user_id'),
            'status'  => 'Verified'
        ])->get('payments')->row();

        if ($is_purchased) {
            $this->session->set_flashdata('message', 'Anda sudah memiliki akses ke kelas ini.');
            redirect('payment/status/' . $is_purchased->id);
        } else {
            // Proceed to payment initiation
            redirect('payment/initiate/' . $this->encryption_url->encode($class_id));
        }
    }

    // Admin process verification
    public function admin_process_verify($payment_id = null) {
        if ($this->session->userdata('level') != '1' && $this->session->userdata('level') != '2') {
            redirect('auth/login');
        }

        if (strtoupper($this->input->server('REQUEST_METHOD')) !== 'POST') {
            redirect('payment/admin_verify');
        }

        // Get payment_id from POST data if not in URL
        if (!$payment_id) {
            $payment_id = $this->input->post('payment_id');
        }

        $payment = $this->db->where('id', $payment_id)->get('payments')->row();
        if (!$payment) {
            show_404();
        }

        $action = $this->input->post('action');
        $notes = $this->input->post('notes');
        $admin_id = $this->session->userdata('user_id');

        if ($action == 'verify') {
            $this->db->where('id', $payment_id)->update('payments', [
                'status' => 'Verified',
                'verified_by' => $admin_id,
                'verified_at' => date('Y-m-d H:i:s'),
                'notes' => $notes
            ]);
            
            // Create premium class enrollment
            $this->load->model('Premium_enrollment_model');
            $enrollment_data = [
                'class_id' => $payment->class_id,
                'student_id' => $payment->user_id,
                'payment_id' => $payment->id,
                'status' => 'Active'
            ];
            $this->Premium_enrollment_model->create_enrollment($enrollment_data);
            
            $this->session->set_flashdata('success', 'Pembayaran berhasil diverifikasi. Akses kelas telah diaktifkan.');
        } elseif ($action == 'reject') {
            $this->db->where('id', $payment_id)->update('payments', [
                'status' => 'Rejected',
                'verified_by' => $admin_id,
                'verified_at' => date('Y-m-d H:i:s'),
                'notes' => $notes
            ]);
            $this->session->set_flashdata('success', 'Pembayaran ditolak');
        }

        redirect('payment/admin_verify');
    }

    // Upload payment proof for existing payment
    public function upload_payment_proof($payment_id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        $payment = $this->Payment_model->get_payment($payment_id);
        if (!$payment || $payment->user_id != $this->session->userdata('user_id')) {
            show_404();
        }

        if ($payment->status !== 'Pending') {
            $this->session->set_flashdata('error', 'Pembayaran ini sudah diproses.');
            redirect('payment/status/' . $payment_id);
        }

        $class = $this->Kelas_programming_model->get_kelas_by_id($payment->class_id);

        $data = [
            'title' => 'Upload Bukti Pembayaran',
            'payment' => $payment,
            'class' => $class
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('student/mobile/upload_payment_proof', $data);
        $this->load->view('templates/footer');
    }

    // Process payment proof upload
    public function process_upload_payment_proof($encrypted_payment_id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        // Check for maintenance mode
        $this->_check_maintenance_mode();

        // Decode payment ID if it's encrypted
        if (!is_numeric($encrypted_payment_id)) {
            $encrypted_payment_id = str_replace(array('-', '_'), array('+', '/'), $encrypted_payment_id);
            $payment_id = $this->encryption_url->decode($encrypted_payment_id);
        } else {
            $payment_id = $encrypted_payment_id;
        }

        $payment = $this->Payment_model->get_payment($payment_id);
        if (!$payment || $payment->user_id != $this->session->userdata('user_id')) {
            show_404();
        }
        
        if ($payment->status !== 'Pending') {
            $this->session->set_flashdata('error', 'Pembayaran ini sudah diproses.');
            redirect('payment/status/' . $payment_id);
        }

        $upload_dir = FCPATH . 'uploads/payments/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $config['upload_path'] = $upload_dir;
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('payment_proof')) {
            $upload_data = $this->upload->data();
            $payment_proof = $upload_data['file_name'];

            // Update payment with proof
            $this->Payment_model->update_payment_proof($payment_id, $payment_proof);

            $this->session->set_flashdata('success', 'Bukti pembayaran berhasil diupload. Mohon tunggu verifikasi admin.');
        } else {
            $this->session->set_flashdata('error', 'Upload bukti pembayaran gagal: ' . $this->upload->display_errors());
        }

        redirect('payment/orders');
    }

    /**
     * Process Midtrans payment
     * @param int $class_id The class ID to process payment for
     */
    private function process_midtrans_payment($class_id) {
        // Check for maintenance mode
        $this->_check_maintenance_mode();
        $this->load->model('Midtrans_model');
        $this->config->load('midtrans');

        $amount = $this->input->post('amount');
        $user = $this->db->where('id', $this->session->userdata('user_id'))->get('users')->row();
        $class = $this->Kelas_programming_model->get_kelas_by_id($class_id);

        // Generate invoice number
        $invoice_number = 'INV-' . date('Ymd') . '-' . str_pad($this->session->userdata('user_id'), 4, '0', STR_PAD_LEFT) . '-' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

        // Create payment record first using validated method
        $payment_data = [
            'user_id' => $this->session->userdata('user_id'),
            'class_id' => $class_id,
            'amount' => $amount,
            'payment_method' => 'Midtrans', // Always set to Midtrans for this method
            'invoice_number' => $invoice_number,
            'invoice_generated_at' => date('Y-m-d H:i:s'),
            'status' => 'Pending'
        ];

        $payment_id = $this->Payment_model->create_payment($payment_data);

        // Double-check payment was created with correct payment_method
        if (!$payment_id) {
            log_message('error', 'Failed to create Midtrans payment record');
            $this->session->set_flashdata('error', 'Gagal membuat record pembayaran. Silakan coba lagi.');
            redirect('payment/initiate/' . $this->encryption_url->encode($class_id));
        }

        // Verify payment_method was set correctly
        $created_payment = $this->Payment_model->get_payment($payment_id);
        if (!$created_payment || $created_payment->payment_method !== 'Midtrans') {
            log_message('error', 'Payment method not set correctly for payment ID: ' . $payment_id . ', fixing...');
            // Force update if not set correctly
            $this->db->where('id', $payment_id)->update('payments', ['payment_method' => 'Midtrans']);
        }

        // Create Midtrans transaction
        $transaction_details = [
            'order_id' => 'PAY-' . $payment_id . '-' . time(),
            'gross_amount' => (int) $amount,
        ];

        $customer_details = [
            'first_name' => $user->nama_lengkap,
            'email' => $user->email,
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

            // Update payment status to failed
            $this->db->where('id', $payment_id)->update('payments', [
                'status' => 'Failed',
                'notes' => 'Midtrans Error: ' . $error_message
            ]);

            $this->session->set_flashdata('error', 'Gagal membuat transaksi Midtrans. Silakan coba lagi.');
            redirect('payment/initiate/' . $this->encryption_url->encode($class_id));
        }

        curl_close($ch);

        $response_data = json_decode($response, true);

        if ($http_status == 201 && isset($response_data['token'])) {
            // Save Midtrans transaction data
            $midtrans_data = [
                'order_id' => $transaction_details['order_id'],
                'transaction_id' => $response_data['transaction_id'] ?? null, // Will be auto-generated in model if null
                'payment_type' => null,
                'transaction_status' => 'pending',
                'gross_amount' => $transaction_details['gross_amount'],
                'user_id' => $this->session->userdata('user_id'),
                'class_id' => $class_id,
                'customer_details' => json_encode($customer_details),
                'payment_data' => $response,
                'redirect_url' => $response_data['redirect_url'] ?? null,
            ];

            $this->Midtrans_model->save_transaction($midtrans_data);

            // Update payment with Midtrans order_id
            $this->db->where('id', $payment_id)->update('payments', [
                'payment_description' => 'Midtrans Order ID: ' . $transaction_details['order_id']
            ]);

            // Return JSON response for AJAX
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'token' => $response_data['token'],
                'redirect_url' => $response_data['redirect_url'],
                'order_id' => $transaction_details['order_id']
            ]);
            exit;
        } else {
            // Update payment status to failed
            $this->db->where('id', $payment_id)->update('payments', [
                'status' => 'Failed',
                'notes' => 'Midtrans Error: ' . ($response_data['status_message'] ?? 'Unknown error')
            ]);

            // Return JSON error response
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'error' => 'Gagal membuat transaksi Midtrans: ' . ($response_data['status_message'] ?? 'Unknown error')
            ]);
            exit;
        }
    }

}
