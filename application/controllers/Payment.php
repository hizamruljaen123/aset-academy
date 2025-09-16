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

        $class = $this->Kelas_programming_model->get_kelas($class_id);
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

        $class = $this->Kelas_programming_model->get_kelas($class_id);
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

    // Process payment submission
    public function process($class_id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        // Get payment data from session
        $payment_data = $this->session->userdata('payment_confirmation');
        if (!$payment_data || $payment_data['class_id'] != $class_id) {
            redirect('payment/initiate/' . $class_id);
        }

        $is_ajax = $this->input->is_ajax_request();
        
        // Additional manual validation for Transfer method
        if ($payment_data['payment_method'] === 'Transfer') {
            if (!$payment_data['bank_name'] || !$payment_data['account_number']) {
                $manual_error = 'Nama Bank dan Nomor Rekening wajib diisi untuk metode Transfer.';
                if ($is_ajax) {
                    echo json_encode(['success' => false, 'message' => $manual_error]);
                    return;
                }
                $this->session->set_flashdata('error', $manual_error);
                $this->initiate($class_id);
                return;
            }
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

        $payment_proof = '';
        if ($this->upload->do_upload('payment_proof')) {
            $payment_proof = $this->upload->data('file_name');
        } else if ($payment_data['payment_method'] == 'Transfer') {
            $this->session->set_flashdata('error', 'Bukti pembayaran wajib diunggah untuk metode transfer');
            $this->initiate($class_id);
            return;
        }

        // Generate invoice number
        $invoice_number = 'INV-' . date('Ymd') . '-' . str_pad($this->session->userdata('user_id'), 4, '0', STR_PAD_LEFT) . '-' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

        $final_payment_data = [
            'user_id' => $this->session->userdata('user_id'),
            'class_id' => $class_id,
            'amount' => $payment_data['amount'],
            'payment_method' => $payment_data['payment_method'],
            'bank_name' => $payment_data['bank_name'],
            'account_number' => $payment_data['account_number'],
            'bank_account_id' => $payment_data['bank_account_id'],
            'payment_description' => $payment_data['payment_description'],
            'user_bank_name' => $payment_data['user_bank_name'],
            'user_account_holder' => $payment_data['user_account_holder'],
            'invoice_number' => $invoice_number,
            'invoice_generated_at' => date('Y-m-d H:i:s'),
            'payment_proof' => $payment_proof,
            'status' => 'Pending',
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('payments', $final_payment_data);
        $payment_id = $this->db->insert_id();

        if ($is_ajax) {
            echo json_encode(['success' => true, 'redirect' => site_url('payment/status/' . $payment_id)]);
            return;
        }
        // Clear session data
        $this->session->unset_userdata('payment_confirmation');
        
        $this->session->set_flashdata('message', 'Pembayaran berhasil diajukan. Mohon tunggu verifikasi admin.');
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

        $class = $this->Kelas_programming_model->get_kelas($payment->class_id);

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
        $class = $this->Kelas_programming_model->get_kelas($class_id);
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

    // Generate and download invoice
    public function invoice($payment_id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        $payment = $this->Payment_model->get_payment_with_details($payment_id);
        if (!$payment || $payment->user_id != $this->session->userdata('user_id')) {
            show_404();
        }

        $class = $this->Kelas_programming_model->get_kelas($payment->class_id);
        $user = $this->db->where('id', $payment->user_id)->get('users')->row();

        $data = [
            'payment' => $payment,
            'class' => $class,
            'user' => $user
        ];

        $this->load->view('payment/invoice', $data);
    }
}
