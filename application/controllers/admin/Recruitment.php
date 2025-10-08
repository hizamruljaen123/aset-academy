<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recruitment extends MY_Controller
{
    private $attachmentsPath;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Recruitment_model', 'recruitment');
        $this->load->library(['session', 'form_validation']);
        $this->load->helper(['url', 'form', 'security', 'download']);

        if (!$this->session->userdata('logged_in') || !in_array($this->session->userdata('role'), ['admin', 'super_admin'])) {
            redirect('auth/login');
        }

        $this->attachmentsPath = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'recruitment' . DIRECTORY_SEPARATOR;
        $this->ensureDirectory($this->attachmentsPath);
    }

    public function index()
    {
        $filters = [
            'status' => $this->input->get('status', true),
            'department' => $this->input->get('department', true),
            'search' => $this->input->get('q', true)
        ];
        $filters = array_filter($filters, static function ($value) {
            return $value !== null && $value !== '';
        });

        $data['title'] = 'Kelola Lowongan Kerja';
        $data['departments'] = $this->recruitment->get_departments();
        $data['positions'] = $this->recruitment->get_job_positions_with_stats($filters);
        $data['stats'] = $this->recruitment->get_recruitment_stats();
        $data['filters'] = $filters;

        $this->load->view('templates/header', $data);
        $this->load->view('admin/recruitment/index', $data);
        $this->load->view('templates/footer');
    }

    public function store()
    {
        $this->validate_position_form();

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/recruitment');
        }

        $payload = $this->build_position_payload();
        $payload['created_by'] = $this->session->userdata('user_id');

        $positionId = $this->recruitment->create_job_position($payload);
        $this->session->set_flashdata('success', 'Lowongan kerja berhasil dibuat.');

        redirect('admin/recruitment/edit/' . $this->encrypt_id($positionId));
    }

    public function edit($encrypted_id)
    {
        $id = $this->decrypt_id($encrypted_id, 'Job Position ID');
        $position = $this->recruitment->get_job_position($id);

        if (!$position) {
            show_404();
        }

        $data['title'] = 'Edit Lowongan Kerja';
        $data['position'] = $position;
        $data['departments'] = $this->recruitment->get_departments();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/recruitment/form', $data);
        $this->load->view('templates/footer');
    }

    public function update($encrypted_id)
    {
        $id = $this->decrypt_id($encrypted_id, 'Job Position ID');
        $position = $this->recruitment->get_job_position($id);

        if (!$position) {
            show_404();
        }

        $this->validate_position_form();

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/recruitment/edit/' . $encrypted_id);
        }

        $payload = $this->build_position_payload($id);
        $payload['updated_at'] = date('Y-m-d H:i:s');

        $this->recruitment->update_job_position($id, $payload);
        $this->session->set_flashdata('success', 'Lowongan kerja berhasil diperbarui.');

        redirect('admin/recruitment/edit/' . $encrypted_id);
    }

    public function delete($encrypted_id)
    {
        $id = $this->decrypt_id($encrypted_id, 'Job Position ID');

        if ($this->recruitment->delete_job_position($id)) {
            $this->session->set_flashdata('success', 'Lowongan kerja berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus lowongan kerja.');
        }

        redirect('admin/recruitment');
    }

    public function applications($encrypted_position_id)
    {
        $positionId = $this->decrypt_id($encrypted_position_id, 'Job Position ID');
        $position = $this->recruitment->get_job_position($positionId);

        if (!$position) {
            show_404();
        }

        $filters = [
            'job_position_id' => $positionId,
            'status' => $this->input->get('status', true),
            'search' => $this->input->get('q', true),
            'date_from' => $this->input->get('date_from', true),
            'date_to' => $this->input->get('date_to', true)
        ];
        $filters = array_filter($filters, static function ($value) {
            return $value !== null && $value !== '';
        });

        $data['title'] = 'Lamaran untuk: ' . $position->title;
        $data['position'] = $position;
        $data['applications'] = $this->recruitment->get_job_applications($filters);
        $data['filters'] = $filters;

        $this->load->view('templates/header', $data);
        $this->load->view('admin/recruitment/applications', $data);
        $this->load->view('templates/footer');
    }

    public function application_detail($encrypted_application_id)
    {
        $applicationId = $this->decrypt_id($encrypted_application_id, 'Application ID');
        $application = $this->recruitment->get_job_application($applicationId);

        if (!$application) {
            show_404();
        }

        $attachments = $this->recruitment->get_attachments($applicationId);
        $data['title'] = 'Detail Lamaran';
        $data['application'] = $application;
        $data['attachments'] = $attachments;
        $data['status_options'] = ['Submitted', 'Under Review', 'Interview Scheduled', 'Accepted', 'Rejected', 'Withdrawn'];

        $this->load->view('templates/header', $data);
        $this->load->view('admin/recruitment/application_detail', $data);
        $this->load->view('templates/footer');
    }

    public function update_application_status()
    {
        $encryptedId = $this->input->post('application_id');
        $applicationId = $this->decrypt_id($encryptedId, 'Application ID');
        $application = $this->recruitment->get_job_application($applicationId);

        if (!$application) {
            show_404();
        }

        $this->form_validation->set_rules('status', 'Status', 'required|in_list[Submitted,Under Review,Interview Scheduled,Accepted,Rejected,Withdrawn]');
        $this->form_validation->set_rules('interview_date', 'Jadwal Interview', 'trim');
        $this->form_validation->set_rules('review_notes', 'Catatan Review', 'trim');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/recruitment/application_detail/' . $encryptedId);
        }

        $payload = [
            'status' => $this->input->post('status', true),
            'review_notes' => $this->input->post('review_notes'),
            'interview_date' => $this->input->post('interview_date') ?: null,
            'reviewed_by' => $this->session->userdata('user_id'),
            'reviewed_at' => date('Y-m-d H:i:s')
        ];

        $this->recruitment->update_job_application($applicationId, $payload);
        $this->session->set_flashdata('success', 'Status lamaran berhasil diperbarui.');

        redirect('admin/recruitment/application_detail/' . $encryptedId);
    }

    public function download_attachment($encrypted_attachment_id)
    {
        $attachmentId = $this->decrypt_id($encrypted_attachment_id, 'Attachment ID');
        $attachment = $this->recruitment->get_attachment($attachmentId);

        if (!$attachment) {
            show_404();
        }

        $filePath = $attachment->file_path;
        if (!is_file($filePath)) {
            show_error('File lampiran tidak ditemukan.', 404);
        }

        force_download($attachment->file_path, null);
    }

    public function delete_attachment($encrypted_attachment_id)
    {
        $attachmentId = $this->decrypt_id($encrypted_attachment_id, 'Attachment ID');
        $attachment = $this->recruitment->get_attachment($attachmentId);

        if (!$attachment) {
            show_404();
        }

        if (is_file($attachment->file_path)) {
            @unlink($attachment->file_path);
        }

        $this->recruitment->delete_attachment($attachmentId);
        $this->session->set_flashdata('success', 'Lampiran berhasil dihapus.');

        redirect('admin/recruitment/application_detail/' . $this->encrypt_id($attachment->application_id));
    }

    public function export_applications($encrypted_position_id)
    {
        $positionId = $this->decrypt_id($encrypted_position_id, 'Job Position ID');
        $position = $this->recruitment->get_job_position($positionId);

        if (!$position) {
            show_404();
        }

        $applications = $this->recruitment->get_job_applications(['job_position_id' => $positionId]);

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=lamaran_' . url_title($position->title) . '.csv');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['Nama Pelamar', 'Email', 'Telepon', 'Status', 'Tanggal Lamar', 'Pengalaman (tahun)', 'Ekspektasi Gaji']);

        foreach ($applications as $application) {
            fputcsv($output, [
                $application->applicant_name,
                $application->applicant_email,
                $application->applicant_phone,
                $application->status,
                $application->submitted_at,
                $application->work_experience_years,
                $application->expected_salary
            ]);
        }

        fclose($output);
        exit;
    }

    private function validate_position_form(): void
    {
        $this->form_validation->set_rules('title', 'Judul Pekerjaan', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('department', 'Departemen', 'required|trim');
        $this->form_validation->set_rules('location', 'Lokasi', 'required|trim');
        $this->form_validation->set_rules('employment_type', 'Jenis Pekerjaan', 'required|in_list[Full-time,Part-time,Contract,Internship,Freelance]');
        $this->form_validation->set_rules('experience_level', 'Level Pengalaman', 'required|in_list[Entry Level,Junior,Mid Level,Senior,Expert]');
        $this->form_validation->set_rules('salary_range', 'Rentang Gaji', 'trim|max_length[120]');
        $this->form_validation->set_rules('application_deadline', 'Deadline', 'trim');
        $this->form_validation->set_rules('max_applications', 'Maksimal Pelamar', 'trim|numeric');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[Draft,Published,Closed,Archived]');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required');
        $this->form_validation->set_rules('requirements', 'Persyaratan', 'required');
    }

    private function build_position_payload($existingId = null): array
    {
        $title = $this->input->post('title', true);
        $slug = url_title($title, '-', true);
        $slug = $this->ensureUniqueSlug($slug, $existingId);

        $deadline = $this->input->post('application_deadline');
        $deadline = $deadline ? $deadline : null;

        $maxApplications = $this->input->post('max_applications');
        $maxApplications = $maxApplications === '' ? null : (int) $maxApplications;

        return [
            'title' => $title,
            'slug' => $slug,
            'department' => $this->input->post('department', true),
            'location' => $this->input->post('location', true),
            'employment_type' => $this->input->post('employment_type', true),
            'experience_level' => $this->input->post('experience_level', true),
            'salary_range' => $this->input->post('salary_range', true),
            'description' => $this->input->post('description'),
            'requirements' => $this->input->post('requirements'),
            'responsibilities' => $this->input->post('responsibilities'),
            'benefits' => $this->input->post('benefits'),
            'application_deadline' => $deadline,
            'status' => $this->input->post('status', true),
            'is_featured' => $this->input->post('is_featured') ? 1 : 0,
            'max_applications' => $maxApplications
        ];
    }

    private function ensureDirectory($path): void
    {
        if (!is_dir($path)) {
            @mkdir($path, 0755, true);
        }
    }

    private function ensureUniqueSlug($slug, $existingId = null): string
    {
        $baseSlug = $slug;
        $counter = 1;

        while ($this->isSlugTaken($slug, $existingId)) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    private function isSlugTaken($slug, $existingId = null): bool
    {
        $this->db->where('slug', $slug);
        if ($existingId) {
            $this->db->where('id !=', $existingId);
        }
        return $this->db->get('job_positions')->row() !== null;
    }
}
