<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Guru_model');
        $this->load->model('Siswa_model');
        $this->load->model('Materi_model');
        $this->load->model('Kelas_model');
        $this->load->model('Absensi_model');
        $this->load->library('Permission');
        $this->load->helper('text');
        
        // Check if user is logged in and has teacher role
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        
        if (!$this->permission->is_teacher()) {
            show_error('Access denied. Teacher role required.', 403);
        }
    }

    public function index()
    {
        $guru_id = $this->session->userdata('user_id');
        
        $data['stats'] = $this->Guru_model->get_guru_stats($guru_id);
        $data['kelas'] = $this->Guru_model->get_guru_kelas($guru_id);
        $data['recent_siswa'] = array_slice($this->Guru_model->get_guru_siswa($guru_id), 0, 5);
        $data['recent_materi'] = array_slice($this->Guru_model->get_guru_materi($guru_id), 0, 5);
        
        $data['title'] = 'Dashboard Guru';
        $this->load->view('templates/header', $data);
        $this->load->view('teacher/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function kelas()
    {
        $guru_id = $this->session->userdata('user_id');
        $data['kelas'] = $this->Guru_model->get_guru_kelas($guru_id);
        
        $data['title'] = 'Kelas Saya';
        $this->load->view('templates/header', $data);
        $this->load->view('teacher/kelas', $data);
        $this->load->view('templates/footer');
    }

    public function siswa()
    {
        $guru_id = $this->session->userdata('user_id');
        $data['siswa'] = $this->Guru_model->get_guru_siswa($guru_id);
        
        $data['title'] = 'Siswa Saya';
        $this->load->view('templates/header', $data);
        $this->load->view('teacher/siswa', $data);
        $this->load->view('templates/footer');
    }

    public function materi()
    {
        $guru_id = $this->session->userdata('user_id');
        $data['materi'] = $this->Guru_model->get_guru_materi($guru_id);
        $data['kelas'] = $this->Guru_model->get_guru_kelas($guru_id);
        
        $data['title'] = 'Materi Saya';
        $this->load->view('templates/header', $data);
        $this->load->view('teacher/materi', $data);
        $this->load->view('templates/footer');
    }

    public function manage_kelas($kelas_id)
    {
        $guru_id = $this->session->userdata('user_id');

        // Check if teacher has access to this class
        if (!$this->Guru_model->has_class_access($guru_id, $kelas_id)) {
            show_error('Anda tidak memiliki akses ke kelas ini.', 403);
        }

        $data['kelas'] = $this->Kelas_model->get_kelas_by_id($kelas_id);
        $data['siswa'] = $this->Siswa_model->get_siswa_by_kelas($kelas_id);
        $data['materi'] = $this->Materi_model->get_materi_by_kelas($kelas_id);
        $this->load->model('Jadwal_model');
        $data['jadwal'] = $this->Jadwal_model->get_jadwal_by_kelas($kelas_id);

        $data['title'] = 'Kelola Kelas - ' . $data['kelas']->nama_kelas;
        $this->load->view('templates/header', $data);
        $this->load->view('teacher/manage_kelas', $data);
        $this->load->view('templates/footer');
    }

    public function siswa_detail($siswa_id)
    {
        $guru_id = $this->session->userdata('user_id');
        $siswa = $this->Siswa_model->get_siswa_by_id($siswa_id);

        if (!$siswa) {
            show_404();
        }

        // Get class ID from student's class name
        $kelas = $this->db->get_where('kelas_programming', ['nama_kelas' => $siswa->kelas])->row();
        if (!$kelas || !$this->Guru_model->has_class_access($guru_id, $kelas->id)) {
            show_error('Anda tidak memiliki akses ke siswa ini.', 403);
        }

        $data['siswa'] = $siswa;
        $data['programming_classes'] = $this->Siswa_model->get_enrolled_programming_classes($siswa_id);
        $data['free_classes'] = $this->Siswa_model->get_enrolled_free_classes($siswa_id);
        $data['title'] = 'Detail Siswa - ' . $siswa->nama_lengkap;
        $this->load->view('templates/header', $data);
        $this->load->view('teacher/siswa_detail', $data);
        $this->load->view('templates/footer');
    }

    public function absensi($jadwal_id)
    {
        $this->load->model('Jadwal_model');
        $jadwal = $this->Jadwal_model->get_jadwal_by_id($jadwal_id);

        if (!$jadwal) {
            show_404();
        }

        $guru_id = $this->session->userdata('user_id');
        if (!$this->Guru_model->has_class_access($guru_id, $jadwal['kelas_id'])) {
            show_error('Anda tidak memiliki akses ke absensi ini.', 403);
        }

        $data['jadwal'] = $jadwal;
        $data['absensi'] = $this->Absensi_model->get_absensi($jadwal_id);
        $data['title'] = 'Detail Absensi - ' . $jadwal['judul_pertemuan'];

        $this->load->view('templates/header', $data);
        $this->load->view('teacher/absensi_detail', $data);
        $this->load->view('templates/footer');
    }

    public function simpan_absensi($kelas_id)
    {
        $guru_id = $this->session->userdata('user_id');
        if (!$this->Guru_model->has_class_access($guru_id, $kelas_id)) {
            show_error('Anda tidak memiliki akses ke kelas ini.', 403);
        }

        $absensi_data = $this->input->post('absensi');
        $tanggal = $this->input->post('tanggal_absensi');
        $jadwal_id = $this->input->post('jadwal_id');

        foreach ($absensi_data as $siswa_id => $status) {
            $data = [
                'jadwal_id' => $jadwal_id,
                'siswa_id' => $siswa_id,
                'status' => $status,
                'catatan' => $this->input->post('catatan')[$siswa_id]
            ];
            $this->Absensi_model->save_absensi($data);
        }

        // Record teacher attendance
        if ($jadwal_id) {
            $this->load->model('Guru_model');
            $this->Guru_model->save_absensi_guru([
                'jadwal_id' => $jadwal_id,
                'guru_id' => $guru_id,
                'status' => 'Hadir',
                'catatan' => 'Mengajar di kelas'
            ]);
        }

        $this->session->set_flashdata('success', 'Absensi berhasil disimpan.');
        redirect('teacher/manage_kelas/' . $kelas_id);
    }

    public function rekap_absensi($kelas_id)
    {
        $guru_id = $this->session->userdata('user_id');
        if (!$this->Guru_model->has_class_access($guru_id, $kelas_id)) {
            show_error('Anda tidak memiliki akses ke kelas ini.', 403);
        }

        $data['kelas'] = $this->Kelas_model->get_kelas_by_id($kelas_id);
        $data['rekap'] = $this->Absensi_model->get_rekap_kelas($kelas_id);

        $data['title'] = 'Rekap Absensi - ' . $data['kelas']->nama_kelas;
        $this->load->view('templates/header', $data);
        $this->load->view('teacher/rekap_absensi', $data);
        $this->load->view('templates/footer');
    }

    public function create_materi()
    {
        $guru_id = $this->session->userdata('user_id');
        $data['kelas_list'] = $this->Guru_model->get_guru_kelas($guru_id);
        $data['title'] = 'Buat Materi Baru';

        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('kelas_id', 'Kelas', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('teacher/create_materi', $data);
            $this->load->view('templates/footer');
        } else {
            $materi_data = [
                'judul' => $this->input->post('judul'),
                'deskripsi' => $this->input->post('deskripsi'),
                'kelas_id' => $this->input->post('kelas_id'),
            ];

            $materi_id = $this->Materi_model->insert_materi($materi_data);

            $parts = $this->input->post('parts');
            if (!empty($parts)) {
                foreach ($parts as $part) {
                    $part_data = [
                        'materi_id' => $materi_id,
                        'part_title' => $part['title'],
                        'part_content' => $part['content'],
                        'part_type' => $part['type'],
                        'part_order' => $part['order'],
                    ];
                    $this->Materi_model->insert_materi_part($part_data);
                }
            }

            $this->session->set_flashdata('success', 'Materi berhasil dibuat.');
            redirect('teacher/materi');
        }
    }

    public function materi_detail($id)
    {
        $guru_id = $this->session->userdata('user_id');
        
        // Check if teacher has access to this material
        $this->db->select('m.*, kp.nama_kelas');
        $this->db->from('materi m');
        $this->db->join('kelas_programming kp', 'm.kelas_id = kp.id');
        $this->db->join('guru_kelas gk', 'kp.id = gk.kelas_id');
        $this->db->where('m.id', $id);
        $this->db->where('gk.guru_id', $guru_id);
        $this->db->where('gk.status', 'Aktif');
        $materi = $this->db->get()->row();
        
        if (!$materi) {
            show_error('Materi tidak ditemukan atau Anda tidak memiliki akses.', 404);
        }
        
        // Get materi parts
        $this->db->where('materi_id', $id);
        $this->db->order_by('part_order', 'ASC');
        $data['parts'] = $this->db->get('materi_parts')->result();
        
        $data['materi'] = $materi;
        $data['title'] = 'Detail Materi - ' . $materi->judul;
        $this->load->view('templates/header', $data);
        $this->load->view('teacher/materi_detail', $data);
        $this->load->view('templates/footer');
    }
    
    public function assignments()
    {
        $teacher_id = $this->session->userdata('user_id');
        
        if (!$teacher_id) {
            redirect('auth/login');
        }
        
        // Load necessary models
        $this->load->model('Assignment_model', 'assignment');
        $this->load->model('Kelas_model', 'kelas');
        
        // Get classes assigned to this teacher
        $data['premium_classes'] = $this->kelas->get_premium_classes_by_teacher($teacher_id); 
        $data['gratis_classes'] = $this->kelas->get_gratis_classes_by_teacher($teacher_id);

        $data['title'] = 'Manajemen Tugas';
        $this->load->view('templates/header', $data);
        $this->load->view('teacher/assignments/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function assignment_view_class($class_id, $class_type)
    {
        // Load necessary models if they aren't already loaded
        if (!isset($this->assignment)) {
            $this->load->model('Assignment_model', 'assignment');
        }
        
        // Use kelas_programming table for both premium and gratis classes
        $data['class'] = $this->db->get_where('kelas_programming', ['id' => $class_id])->row();

        if (!$data['class']) {
            show_404();
        }

        $data['assignments'] = $this->assignment->get_assignments_by_class($class_id, $class_type);
        $data['class_type'] = $class_type;
        $data['title'] = 'Tugas untuk ' . $data['class']->nama_kelas;

        $this->load->view('templates/header', $data);
        $this->load->view('teacher/assignments/view_class', $data);
        $this->load->view('templates/footer');
    }
    
    public function assignment_create($class_id, $class_type)
    {
        // Load necessary models if they aren't already loaded
        if (!isset($this->assignment)) {
            $this->load->model('Assignment_model', 'assignment');
        }
        
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', 'Judul', 'required|trim');
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim');
        $this->form_validation->set_rules('due_date', 'Batas Waktu', 'trim');

        // Use kelas_programming table for both premium and gratis classes
        $data['class'] = $this->db->get_where('kelas_programming', ['id' => $class_id])->row();
        
        if (!$data['class']) {
            show_404();
        }
        
        $data['class_type'] = $class_type;
        $data['title'] = 'Buat Tugas Baru';

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('teacher/assignments/create', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'class_id' => $class_id,
                'class_type' => $class_type,
                'teacher_id' => $this->session->userdata('user_id'),
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'due_date' => $this->input->post('due_date') ? $this->input->post('due_date') : NULL
            ];

            $this->assignment->create_assignment($data);
            $this->session->set_flashdata('success', 'Tugas berhasil dibuat.');
            redirect('teacher/assignment_view_class/' . $class_id . '/' . $class_type);
        }
    }
    
    public function assignment_edit($assignment_id)
    {
        // Load necessary models if they aren't already loaded
        if (!isset($this->assignment)) {
            $this->load->model('Assignment_model', 'assignment');
        }
        
        $this->load->library('form_validation');

        $data['assignment'] = $this->assignment->get_assignment($assignment_id);
        if (!$data['assignment']) {
            show_404();
        }

        // Use kelas_programming table for both premium and gratis classes
        $data['class'] = $this->db->get_where('kelas_programming', ['id' => $data['assignment']->class_id])->row();

        $data['class_type'] = $data['assignment']->class_type;
        $data['title'] = 'Edit Tugas: ' . $data['assignment']->title;

        $this->form_validation->set_rules('title', 'Judul', 'required|trim');
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim');
        $this->form_validation->set_rules('due_date', 'Batas Waktu', 'trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('teacher/assignments/create', $data);
            $this->load->view('templates/footer');
        } else {
            $update_data = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'due_date' => $this->input->post('due_date') ? $this->input->post('due_date') : NULL
            ];

            $this->assignment->update_assignment($assignment_id, $update_data);
            $this->session->set_flashdata('success', 'Tugas berhasil diperbarui.');
            redirect('teacher/assignment_view_class/' . $data['assignment']->class_id . '/' . $data['assignment']->class_type);
        }
    }
    
    public function assignment_delete($assignment_id)
    {
        // Load necessary models if they aren't already loaded
        if (!isset($this->assignment)) {
            $this->load->model('Assignment_model', 'assignment');
        }
        
        $assignment = $this->assignment->get_assignment($assignment_id);
        if (!$assignment) {
            show_404();
        }

        $this->assignment->delete_assignment($assignment_id);
        $this->session->set_flashdata('success', 'Tugas berhasil dihapus.');
        redirect('teacher/assignment_view_class/' . $assignment->class_id . '/' . $assignment->class_type);
    }
    
    public function assignment_submissions($assignment_id)
    {
        // Load necessary models if they aren't already loaded
        if (!isset($this->assignment)) {
            $this->load->model('Assignment_model', 'assignment');
        }
        
        $data['assignment'] = $this->assignment->get_assignment($assignment_id);
        if (!$data['assignment']) {
            show_404();
        }

        $data['submissions'] = $this->assignment->get_submissions_by_assignment($assignment_id);
        $data['title'] = 'Pengumpulan untuk ' . $data['assignment']->title;

        $this->load->view('templates/header', $data);
        $this->load->view('teacher/assignments/submissions', $data);
        $this->load->view('templates/footer');
    }
    
    public function assignment_grade($submission_id)
    {
        // Load necessary models if they aren't already loaded
        if (!isset($this->assignment)) {
            $this->load->model('Assignment_model', 'assignment');
        }
        
        $this->load->library('form_validation');
        $data['submission'] = $this->db->select('ss.*, u.nama_lengkap')
                                    ->from('student_submissions ss')
                                    ->join('users u', 'ss.student_id = u.id')
                                    ->where('ss.id', $submission_id)
                                    ->get()->row();

        if (!$data['submission']) {
            show_404();
        }

        $data['assignment'] = $this->assignment->get_assignment($data['submission']->assignment_id);
        $data['title'] = 'Beri Nilai untuk ' . $data['submission']->nama_lengkap;

        $this->form_validation->set_rules('grade', 'Nilai', 'required|trim|numeric');
        $this->form_validation->set_rules('feedback', 'Feedback', 'trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('teacher/assignments/grade', $data);
            $this->load->view('templates/footer');
        } else {
            $grade_data = [
                'grade' => $this->input->post('grade'),
                'feedback' => $this->input->post('feedback'),
                'status' => 'graded'
            ];

            $this->assignment->grade_submission($submission_id, $grade_data);
            $this->session->set_flashdata('success', 'Nilai berhasil disimpan.');
            redirect('teacher/assignment_submissions/' . $data['submission']->assignment_id);
        }
    }
}
