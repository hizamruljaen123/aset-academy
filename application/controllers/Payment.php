<?php
class Payment extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Kelas_programming_model');
        $this->load->model('Payment_model');
        $this->load->model('Company_bank_model');
        $this->load->library('form_validation');
    }

    // Initiate payment for a class
    public function initiate($class_id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        $class = $this->Kelas_programming_model->get_kelas_by_id($class_id);
        if (!$class) {
            show_404();
        }

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

        // Get active bank accounts
        $bank_accounts = $this->Company_bank_model->get_active_bank_accounts();

        $data = [
            'title' => 'Pembayaran Kelas',
            'class' => $class,
            'user' => $this->db->where('id', $this->session->userdata('user_id'))->get('users')->row(),
            'bank_accounts' => $bank_accounts
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

            $this->load->view('templates/header', $data);
            $this->load->view('payment/confirm', $data);
            $this->load->view('templates/footer');
        }
    }

    // Process payment creation (without proof initially)
    public function process_payment($class_id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        // Only allow POST submissions to prevent CSRF token errors on direct URL access
        if (strtoupper($this->input->server('REQUEST_METHOD')) !== 'POST') {
            redirect('payment/initiate/' . $class_id);
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

        // Additional validation for Transfer method
        if ($this->input->post('payment_method') === 'Transfer') {
            $this->form_validation->set_rules('bank_account_id', 'Bank Tujuan', 'required');
            $this->form_validation->set_rules('user_bank_name', 'Nama Bank Pengirim', 'required');
            $this->form_validation->set_rules('user_account_holder', 'Nama Pemilik Rekening', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->initiate($class_id);
            return;
        }

        // Generate invoice number
        $invoice_number = 'INV-' . date('Ymd') . '-' . str_pad($this->session->userdata('user_id'), 4, '0', STR_PAD_LEFT) . '-' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

        $payment_method = $this->input->post('payment_method');

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
        $payment_id = $this->db->insert_id();

        $this->session->set_flashdata('success', 'Pesanan pembayaran berhasil dibuat. Silakan lakukan pembayaran dan upload bukti pembayaran.');
        redirect('payment/status/' . $payment_id);
    }

    // View payment status
    public function status($payment_id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        $payment = $this->Payment_model->get_payment_with_details($payment_id);
        if (!$payment || $payment->user_id != $this->session->userdata('user_id')) {
            show_404();
        }

        if (!$payment) {
            show_404();
        }

        $class = $this->Kelas_programming_model->get_kelas_by_id($payment->class_id);

        $data = [
            'title' => 'Status Pembayaran',
            'payment' => $payment,
            'class' => $class
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
            redirect('payment/initiate/' . $class_id);
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
                'status' => 'Pending'
            ];
            $this->Premium_enrollment_model->create_enrollment($enrollment_data);
            
            $this->session->set_flashdata('success', 'Pembayaran berhasil diverifikasi. Enrollment dibuat dan menunggu aktivasi.');
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
    public function process_payment_proof_upload($payment_id) {
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
}
