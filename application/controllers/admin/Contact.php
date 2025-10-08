<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Contact_model', 'contact');
        $this->load->library(['session', 'pagination']);

        if (!$this->session->userdata('logged_in') || !in_array($this->session->userdata('role'), ['admin', 'super_admin'])) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $filters = [
            'status' => $this->input->get('status', true),
            'message_type' => $this->input->get('message_type', true)
        ];

        $page = (int) $this->input->get('page');
        $page = max($page, 1);
        $perPage = 20;
        $offset = ($page - 1) * $perPage;

        $totalRows = $this->contact->count_all($filters);
        $messages = $this->contact->get_all($perPage, $offset, $filters);

        $config['base_url'] = site_url('admin/contact/index');
        $config['reuse_query_string'] = true;
        $config['total_rows'] = $totalRows;
        $config['per_page'] = $perPage;

        $this->pagination->initialize($config);

        $data['title'] = 'Kotak Masuk Kontak';
        $data['messages'] = $messages;
        $data['filters'] = $filters;
        $data['pagination_links'] = $this->pagination->create_links();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/contact/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($id)
    {
        $message = $this->contact->get($id);

        if (!$message) {
            show_404();
        }

        if ($message->status === 'baru') {
            $this->contact->update($id, ['status' => 'diproses']);
            $message->status = 'diproses';
        }

        $data['title'] = 'Detail Pesan Kontak';
        $data['message'] = $message;

        $this->load->view('templates/header', $data);
        $this->load->view('admin/contact/view', $data);
        $this->load->view('templates/footer');
    }

    public function update_status($id)
    {
        $message = $this->contact->get($id);
        if (!$message) {
            show_404();
        }

        $newStatus = $this->input->post('status', true);
        if (!in_array($newStatus, ['baru', 'diproses', 'selesai'], true)) {
            $this->session->set_flashdata('error', 'Status tidak valid.');
            redirect('admin/contact/view/' . $id);
        }

        $this->contact->update($id, ['status' => $newStatus]);
        $this->session->set_flashdata('success', 'Status pesan berhasil diperbarui.');
        redirect('admin/contact/view/' . $id);
    }

    public function delete($id)
    {
        $message = $this->contact->get($id);
        if (!$message) {
            show_404();
        }

        $this->contact->delete($id);
        $this->session->set_flashdata('success', 'Pesan kontak berhasil dihapus.');
        redirect('admin/contact');
    }
}
