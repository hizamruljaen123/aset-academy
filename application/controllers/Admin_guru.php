<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_guru extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->model('Guru_model');
        $this->load->model('Kelas_model');
        $this->load->library('Permission');
        
        // Check if user is logged in and has admin access
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        
        if (!$this->permission->is_admin()) {
            show_error('Access denied. Admin role required.', 403);
        }
    }

    public function index()
    {
        // Get all teachers
        $this->db->where('role', 'guru');
        $this->db->order_by('nama_lengkap', 'ASC');
        $data['teachers'] = $this->db->get('users')->result();
        
        // Get teacher stats
        foreach($data['teachers'] as $teacher) {
            $teacher->stats = $this->Guru_model->get_guru_stats($teacher->id);
            $teacher->kelas_count = $teacher->stats['total_kelas'];
            $teacher->siswa_count = $teacher->stats['total_siswa'];
        }
        
        $data['title'] = 'Kelola Guru';
        $this->load->view('templates/header', $data);
        $this->load->view('admin/guru/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Guru';
            $this->load->view('templates/header', $data);
            $this->load->view('admin/guru/create', $data);
            $this->load->view('templates/footer');
        } else {
            $teacher_data = [
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'email' => $this->input->post('email'),
                'role' => 'guru',
                'status' => 'Aktif'
            ];

            $teacher_id = $this->Users_model->insert_user($teacher_data);
            
            if ($teacher_id) {
                $this->session->set_flashdata('success', 'Guru berhasil ditambahkan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan guru');
            }
            
            redirect('admin_guru');
        }
    }

    public function edit($id)
    {
        $teacher = $this->Users_model->get_user_by_id($id);
        if (!$teacher || $teacher->role !== 'guru') {
            show_404();
        }

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $data['teacher'] = $teacher;
            $data['title'] = 'Edit Guru';
            $this->load->view('templates/header', $data);
            $this->load->view('admin/guru/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $update_data = [
                'username' => $this->input->post('username'),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'email' => $this->input->post('email'),
                'status' => $this->input->post('status')
            ];

            if ($this->input->post('password')) {
                $update_data['password'] = $this->input->post('password');
            }

            if ($this->Users_model->update_user($id, $update_data)) {
                $this->session->set_flashdata('success', 'Data guru berhasil diupdate');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupdate data guru');
            }
            
            redirect('admin_guru');
        }
    }

    public function delete($id)
    {
        $teacher = $this->Users_model->get_user_by_id($id);
        if (!$teacher || $teacher->role !== 'guru') {
            show_404();
        }

        // Remove all class assignments first
        $this->db->where('guru_id', $id);
        $this->db->delete('guru_kelas');

        // Delete teacher
        if ($this->Users_model->delete_user($id)) {
            $this->session->set_flashdata('success', 'Guru berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus guru');
        }
        
        redirect('admin_guru');
    }

    public function assign($teacher_id)
    {
        $teacher = $this->Users_model->get_user_by_id($teacher_id);
        if (!$teacher || $teacher->role !== 'guru') {
            show_404();
        }

        $data['all_premium_kelas'] = $this->Kelas_model->get_all_kelas();
        
        // Get all free classes
        $this->load->model('Free_class_model');
        $data['all_free_kelas'] = $this->Free_class_model->get_all_free_classes();

        // Get assigned classes (both premium and free)
        $assigned_classes = $this->Guru_model->get_guru_kelas($teacher_id);

        // Separate assigned classes by type
        $data['assigned_premium_kelas'] = array_filter($assigned_classes, function($kelas) {
            return $kelas->class_type === 'premium';
        });

        $data['assigned_free_kelas'] = array_filter($assigned_classes, function($kelas) {
            return $kelas->class_type === 'gratis';
        });

        // Map premium classes already assigned to teachers
        $active_assignments = $this->Guru_model->get_active_premium_assignments_with_teacher();
        $taken_premium_ids_by_other = [];
        $premium_assignment_map = [];
        foreach ($active_assignments as $assignment) {
            $premium_assignment_map[$assignment->kelas_id] = $assignment;
            if ((int)$assignment->guru_id !== (int)$teacher_id) {
                $taken_premium_ids_by_other[] = (int)$assignment->kelas_id;
            }
        }
        $data['premium_assignment_map'] = $premium_assignment_map;
        $data['taken_premium_ids_by_other'] = $taken_premium_ids_by_other;

        $data['teacher'] = $teacher;
        $data['title'] = 'Kelola Penugasan - ' . $teacher->nama_lengkap;
        $this->load->view('templates/header', $data);
        $this->load->view('admin/guru/assign', $data);
        $this->load->view('templates/footer');
    }

    public function assign_class()
    {
        $teacher_id = $this->input->post('teacher_id');
        $class_id = $this->input->post('class_id');
        $class_type = $this->input->post('class_type'); // 'premium' or 'gratis'
        
        $success = false;
        if ($class_type == 'premium') {
            $existing_active = $this->Guru_model->get_active_assignment_by_class($class_id);
            if ($existing_active) {
                if ((int)$existing_active->guru_id === (int)$teacher_id) {
                    // Already assigned to this teacher, no action needed
                    $this->session->set_flashdata('info', 'Guru ini sudah ditugaskan ke kelas tersebut.');
                    redirect('admin_guru/assign/' . $teacher_id);
                }

                $assigned_teacher = $this->Users_model->get_user_by_id($existing_active->guru_id);
                $teacher_name = $assigned_teacher ? $assigned_teacher->nama_lengkap : 'guru lain';
                $this->session->set_flashdata('error', 'Kelas ini sudah ditugaskan kepada ' . $teacher_name . '. Harap hapus penugasan tersebut terlebih dahulu.');
                redirect('admin_guru/assign/' . $teacher_id);
            }

            $existing_record = $this->Guru_model->get_assignment_record($class_id, $teacher_id);
            if ($existing_record) {
                $success = $this->Guru_model->update_assignment_status($existing_record->id, 'Aktif');
            } else {
                $success = $this->Guru_model->assign_guru_kelas($teacher_id, $class_id);
            }
        } else {
            $success = $this->Guru_model->assign_guru_free_class($teacher_id, $class_id);
        }
        
        if ($success) {
            $this->session->set_flashdata('success', 'Kelas berhasil ditugaskan');
        } else {
            $this->session->set_flashdata('error', 'Gagal menugaskan kelas');
        }
        
        redirect('admin_guru/assign/' . $teacher_id);
    }

    public function remove_class()
    {
        $teacher_id = $this->input->post('teacher_id');
        $class_id = $this->input->post('class_id');
        $class_type = $this->input->post('class_type'); // 'premium' or 'gratis'
        
        $success = false;
        if ($class_type == 'premium') {
            $success = $this->Guru_model->remove_guru_kelas($teacher_id, $class_id);
        } else {
            $success = $this->Guru_model->remove_guru_free_class($teacher_id, $class_id);
        }
        
        if ($success) {
            $this->session->set_flashdata('success', 'Penugasan kelas berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus penugasan kelas');
        }
        
        redirect('admin_guru/assign/' . $teacher_id);
    }
}
