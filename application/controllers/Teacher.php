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
        $all_kelas = $this->Guru_model->get_guru_kelas($guru_id);

        // Separate classes by type and check for schedules
        $premium_kelas = [];
        $gratis_kelas = [];

        foreach ($all_kelas as $k) {
            // Check if this class has any schedules
            $this->load->model('Jadwal_model');
            $jadwal = $this->Jadwal_model->get_jadwal_by_kelas($k->id, $k->class_type);
            $k->has_schedules = !empty($jadwal);

            if ($k->class_type === 'premium') {
                $premium_kelas[] = $k;
            } else {
                $gratis_kelas[] = $k;
            }
        }

        $data['premium_kelas'] = $premium_kelas;
        $data['gratis_kelas'] = $gratis_kelas;

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

        // Check if teacher has access to this class (both premium and free)
        $has_premium_access = $this->Guru_model->has_class_access($guru_id, $kelas_id);
        $has_free_access = $this->Guru_model->has_free_class_access($guru_id, $kelas_id);

        

        if (!$has_premium_access && !$has_free_access) {
            show_error('Anda tidak memiliki akses ke kelas ini.', 403);
        }

        // Determine class type and get appropriate data
        $data['class_type'] = null;

        if ($has_premium_access) {
            $premium_class = $this->Kelas_model->get_kelas_by_id($kelas_id);
            if ($premium_class) {
                $data['kelas'] = $premium_class;
                $data['siswa'] = $this->Siswa_model->get_siswa_by_kelas($kelas_id);
                $data['materi'] = $this->Materi_model->get_materi_by_kelas($kelas_id);
                $data['class_type'] = 'premium';
            }
        }

        if ($data['class_type'] === null) {
            if ($has_free_access) {
                $this->load->model('Free_class_model');
                $free_class = $this->Free_class_model->get_free_class_by_id($kelas_id);
                if ($free_class) {
                    $data['kelas'] = $free_class;
                    $data['siswa'] = $this->Free_class_model->get_enrolled_students($kelas_id);
                    $data['materi'] = $this->Free_class_model->get_free_class_materials($kelas_id);
                    $data['class_type'] = 'gratis';
                }
            }
        }

        if ($data['class_type'] === null) {
            show_404();
        }

        $this->load->model('Jadwal_model');
        $data['jadwal'] = $this->Jadwal_model->get_jadwal_by_kelas($kelas_id, $data['class_type']);

        // Check if there are any schedules for this class
        $has_schedules = !empty($data['jadwal']);

        $data['title'] = 'Kelola Kelas - ' . ($data['kelas']->nama_kelas ?? $data['kelas']->title);
        $data['has_schedules'] = $has_schedules;

        $this->load->view('templates/header', $data);
        $this->load->view('teacher/manage_kelas', $data);
        $this->load->view('templates/footer');
    }

    public function siswa_detail($siswa_id)
    {
        $guru_id = $this->session->userdata('user_id');
        
        // Check if teacher has access to this student using the view
        $this->db->select('student_id, student_name, student_email, class_name, class_type, enrollment_status, progress_percentage');
        $this->db->from('v_guru_kelas_detail');
        $this->db->where('guru_id', $guru_id);
        $this->db->where('student_id', $siswa_id);
        $this->db->group_by('student_id, class_id');
        $access_check = $this->db->get()->result();
        
        if (empty($access_check)) {
            show_error('Anda tidak memiliki akses ke siswa ini.', 403);
        }
        
        // Try to get student from siswa table first (for old data)
        $siswa = $this->Siswa_model->get_siswa_by_id($siswa_id);
        
        // If not found in siswa table, get from users table
        if (!$siswa) {
            $this->db->select('id, username, nama_lengkap, email, foto_profil, role, status, created_at');
            $this->db->from('users');
            $this->db->where('id', $siswa_id);
            $siswa = $this->db->get()->row();
            
            if (!$siswa) {
                show_404();
            }
            
            // Add empty fields for compatibility with view
            $siswa->nis = '-';
            $siswa->kelas = '-';
            $siswa->jurusan = '-';
            $siswa->alamat = '-';
            $siswa->no_telepon = '-';
            $siswa->tanggal_lahir = null;
            $siswa->jenis_kelamin = null;
        }
        
        // Get enrolled classes for this student
        $data['siswa'] = $siswa;
        $data['programming_classes'] = $this->Siswa_model->get_enrolled_programming_classes($siswa_id);
        $data['free_classes'] = $this->Siswa_model->get_enrolled_free_classes($siswa_id);
        $data['enrollment_data'] = $access_check; // Data enrollment dari guru
        $data['title'] = 'Detail Siswa - ' . $siswa->nama_lengkap;
        
        $this->load->view('templates/header', $data);
        $this->load->view('teacher/siswa_detail', $data);
        $this->load->view('templates/footer');
    }

    public function absensi($jadwal_id)
    {
        $this->load->model('Jadwal_model');
        $jadwal = $this->Jadwal_model->get_jadwal_by_id_with_status($jadwal_id);

        if (!$jadwal) {
            show_404();
        }

        $guru_id = $this->session->userdata('user_id');

        // Check access for both premium and free classes
        $has_premium_access = $this->Guru_model->has_class_access($guru_id, $jadwal->kelas_id);
        $has_free_access = $this->Guru_model->has_free_class_access($guru_id, $jadwal->kelas_id);

        if (!$has_premium_access && !$has_free_access) {
            show_error('Anda tidak memiliki akses ke absensi ini.', 403);
        }

        $data['jadwal'] = $jadwal;
        $data['absensi'] = $this->Absensi_model->get_absensi($jadwal_id);
        $data['title'] = 'Detail Absensi - ' . $jadwal->judul_pertemuan;

        $this->load->view('templates/header', $data);
        $this->load->view('teacher/absensi_detail', $data);
        $this->load->view('templates/footer');
    }

    public function simpan_absensi($kelas_id)
    {
        $guru_id = $this->session->userdata('user_id');

        // Check access for both premium and free classes
        $has_premium_access = $this->Guru_model->has_class_access($guru_id, $kelas_id);
        $has_free_access = $this->Guru_model->has_free_class_access($guru_id, $kelas_id);

        if (!$has_premium_access && !$has_free_access) {
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

        // Check access for both premium and free classes
        $has_premium_access = $this->Guru_model->has_class_access($guru_id, $kelas_id);
        $has_free_access = $this->Guru_model->has_free_class_access($guru_id, $kelas_id);

        if (!$has_premium_access && !$has_free_access) {
            show_error('Anda tidak memiliki akses ke kelas ini.', 403);
        }

        $data['kelas'] = $this->Kelas_model->get_kelas_by_id($kelas_id);
        $data['rekap'] = $this->Absensi_model->get_rekap_kelas($kelas_id);

        // Handle class name for title (both premium and free classes)
        $class_name = '';
        if ($data['kelas']) {
            if (isset($data['kelas']->nama_kelas)) {
                $class_name = $data['kelas']->nama_kelas;
            } elseif (isset($data['kelas']->title)) {
                $class_name = $data['kelas']->title;
            }
        }
        $data['title'] = 'Rekap Absensi - ' . $class_name;
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
        $this->db->select('m.*, kp.nama_kelas, kp.id as kelas_id');
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

    public function edit_materi($id)
    {
        $guru_id = $this->session->userdata('user_id');
        
        // Check if teacher has access to this material
        $this->db->select('m.*, kp.nama_kelas, kp.id as kelas_id');
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
        $this->load->model('Materi_part_model');
        $data['parts'] = $this->Materi_part_model->get_parts_by_materi_id($id);
        
        $data['materi'] = $materi;
        $data['title'] = 'Edit Materi - ' . $materi->judul;
        $this->load->view('templates/header', $data);
        $this->load->view('teacher/edit_materi', $data);
        $this->load->view('templates/footer');
    }

    public function update_materi($id)
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
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Materi tidak ditemukan atau Anda tidak memiliki akses.'
            ]));
            return;
        }
        
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');
        
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Validasi gagal: ' . validation_errors()
            ]));
            return;
        }
        
        $update_data = [
            'judul' => $this->input->post('judul'),
            'deskripsi' => $this->input->post('deskripsi')
        ];
        
        $this->Materi_model->update_materi($id, $update_data);
        
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode([
            'success' => true,
            'message' => 'Materi berhasil diperbarui!'
        ]));
    }

    public function delete_materi($id)
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
            $this->session->set_flashdata('error', 'Materi tidak ditemukan atau Anda tidak memiliki akses.');
            redirect('teacher/materi');
            return;
        }
        
        $this->Materi_model->delete_materi($id);
        $this->session->set_flashdata('success', 'Materi berhasil dihapus!');
        redirect('teacher/materi');
    }

    public function add_materi_part($materi_id)
    {
        $guru_id = $this->session->userdata('user_id');
        
        // Check access
        $this->db->select('m.*');
        $this->db->from('materi m');
        $this->db->join('kelas_programming kp', 'm.kelas_id = kp.id');
        $this->db->join('guru_kelas gk', 'kp.id = gk.kelas_id');
        $this->db->where('m.id', $materi_id);
        $this->db->where('gk.guru_id', $guru_id);
        $this->db->where('gk.status', 'Aktif');
        $materi = $this->db->get()->row();
        
        if (!$materi) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Akses ditolak.'
            ]));
            return;
        }
        
        $this->form_validation->set_rules('part_title', 'Judul Bagian', 'required|trim');
        $this->form_validation->set_rules('part_content', 'Konten', 'required|trim');
        $this->form_validation->set_rules('part_type', 'Tipe', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Validasi gagal: ' . validation_errors()
            ]));
            return;
        }
        
        // Get last order
        $this->load->model('Materi_part_model');
        $last_order = $this->Materi_part_model->get_last_part_order($materi_id);
        
        $part_data = [
            'materi_id' => $materi_id,
            'part_title' => $this->input->post('part_title'),
            'part_content' => $this->input->post('part_content'),
            'part_type' => $this->input->post('part_type'),
            'part_order' => $last_order + 1
        ];
        
        $this->Materi_part_model->insert_part($part_data);
        
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode([
            'success' => true,
            'message' => 'Bagian materi berhasil ditambahkan!'
        ]));
    }

    public function update_materi_part($part_id)
    {
        $guru_id = $this->session->userdata('user_id');
        
        // Check access through materi
        $this->load->model('Materi_part_model');
        $part = $this->Materi_part_model->get_part_by_id($part_id);
        
        if (!$part) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Bagian tidak ditemukan.'
            ]));
            return;
        }
        
        $this->db->select('m.*');
        $this->db->from('materi m');
        $this->db->join('kelas_programming kp', 'm.kelas_id = kp.id');
        $this->db->join('guru_kelas gk', 'kp.id = gk.kelas_id');
        $this->db->where('m.id', $part->materi_id);
        $this->db->where('gk.guru_id', $guru_id);
        $this->db->where('gk.status', 'Aktif');
        $materi = $this->db->get()->row();
        
        if (!$materi) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Akses ditolak.'
            ]));
            return;
        }
        
        $this->form_validation->set_rules('part_title', 'Judul Bagian', 'required|trim');
        $this->form_validation->set_rules('part_content', 'Konten', 'required|trim');
        $this->form_validation->set_rules('part_type', 'Tipe', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Validasi gagal: ' . validation_errors()
            ]));
            return;
        }
        
        $update_data = [
            'part_title' => $this->input->post('part_title'),
            'part_content' => $this->input->post('part_content'),
            'part_type' => $this->input->post('part_type')
        ];
        
        $this->Materi_part_model->update_part($part_id, $update_data);
        
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode([
            'success' => true,
            'message' => 'Bagian materi berhasil diperbarui!'
        ]));
    }

    public function delete_materi_part($part_id)
    {
        $guru_id = $this->session->userdata('user_id');
        
        // Check access through materi
        $this->load->model('Materi_part_model');
        $part = $this->Materi_part_model->get_part_by_id($part_id);
        
        if (!$part) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Bagian tidak ditemukan.'
            ]));
            return;
        }
        
        $this->db->select('m.*');
        $this->db->from('materi m');
        $this->db->join('kelas_programming kp', 'm.kelas_id = kp.id');
        $this->db->join('guru_kelas gk', 'kp.id = gk.kelas_id');
        $this->db->where('m.id', $part->materi_id);
        $this->db->where('gk.guru_id', $guru_id);
        $this->db->where('gk.status', 'Aktif');
        $materi = $this->db->get()->row();
        
        if (!$materi) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Akses ditolak.'
            ]));
            return;
        }
        
        $this->Materi_part_model->delete_part($part_id);
        
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode([
            'success' => true,
            'message' => 'Bagian materi berhasil dihapus!'
        ]));
    }

    public function reorder_materi_parts()
    {
        $guru_id = $this->session->userdata('user_id');
        $materi_id = $this->input->post('materi_id');
        $orders_json = $this->input->post('orders');
        $orders = json_decode($orders_json, true);
        
        // Check access
        $this->db->select('m.*');
        $this->db->from('materi m');
        $this->db->join('kelas_programming kp', 'm.kelas_id = kp.id');
        $this->db->join('guru_kelas gk', 'kp.id = gk.kelas_id');
        $this->db->where('m.id', $materi_id);
        $this->db->where('gk.guru_id', $guru_id);
        $this->db->where('gk.status', 'Aktif');
        $materi = $this->db->get()->row();
        
        if (!$materi) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Akses ditolak.'
            ]));
            return;
        }
        
        if (empty($orders) || !is_array($orders)) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Data urutan tidak valid.'
            ]));
            return;
        }
        
        $this->load->model('Materi_part_model');
        
        foreach ($orders as $part_id => $order) {
            $this->Materi_part_model->update_part($part_id, ['part_order' => $order]);
        }
        
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode([
            'success' => true,
            'message' => 'Urutan berhasil diperbarui!'
        ]));
    }

    public function get_part($part_id)
    {
        $guru_id = $this->session->userdata('user_id');
        
        // Check access through materi
        $this->load->model('Materi_part_model');
        $part = $this->Materi_part_model->get_part_by_id($part_id);
        
        if (!$part) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'error' => 'Bagian tidak ditemukan.'
            ]));
            return;
        }
        
        $this->db->select('m.*');
        $this->db->from('materi m');
        $this->db->join('kelas_programming kp', 'm.kelas_id = kp.id');
        $this->db->join('guru_kelas gk', 'kp.id = gk.kelas_id');
        $this->db->where('m.id', $part->materi_id);
        $this->db->where('gk.guru_id', $guru_id);
        $this->db->where('gk.status', 'Aktif');
        $materi = $this->db->get()->row();
        
        if (!$materi) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'error' => 'Akses ditolak.'
            ]));
            return;
        }
        
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($part));
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
        
        // Get class from appropriate table based on class_type
        if ($class_type == 'premium') {
            $data['class'] = $this->db->get_where('kelas_programming', ['id' => $class_id])->row();
        } else {
            $data['class'] = $this->db->get_where('free_classes', ['id' => $class_id])->row();
        }

        if (!$data['class']) {
            show_404();
        }

        $data['assignments'] = $this->assignment->get_assignments_by_class($class_id, $class_type);
        $data['class_type'] = $class_type;
        $data['title'] = 'Tugas untuk ' . ($data['class']->nama_kelas ?? $data['class']->title);

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

        // Get class from appropriate table based on class_type
        if ($class_type == 'premium') {
            $data['class'] = $this->db->get_where('kelas_programming', ['id' => $class_id])->row();
        } else {
            $data['class'] = $this->db->get_where('free_classes', ['id' => $class_id])->row();
        }
        
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

        // Get class from appropriate table based on assignment class_type
        if ($data['assignment']->class_type == 'premium') {
            $data['class'] = $this->db->get_where('kelas_programming', ['id' => $data['assignment']->class_id])->row();
        } else {
            $data['class'] = $this->db->get_where('free_classes', ['id' => $data['assignment']->class_id])->row();
        }

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

    public function akhiri_pertemuan()
    {
        $jadwal_id = $this->input->post('jadwal_id');
        $kelas_id = $this->input->post('kelas_id');
        $class_type = $this->input->post('class_type');

        if (!$jadwal_id || !$kelas_id || !$class_type) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Data tidak lengkap'
            ]));
            return;
        }

        $guru_id = $this->session->userdata('user_id');

        // Validasi akses guru ke kelas
        $has_premium_access = $this->Guru_model->has_class_access($guru_id, $kelas_id);
        $has_free_access = $this->Guru_model->has_free_class_access($guru_id, $kelas_id);

        if (!$has_premium_access && !$has_free_access) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Anda tidak memiliki akses ke kelas ini'
            ]));
            return;
        }

        // Update jadwal status to 'Selesai'
        $this->db->where('id', $jadwal_id);
        $this->db->update('jadwal_kelas', ['status' => 'Selesai']);

        // Get all enrolled students for this class
        $enrolled_students = [];
        if ($class_type == 'premium') {
            // Get students enrolled in premium class
            $this->db->select('u.id, u.nama_lengkap, "" as nis');
            $this->db->from('premium_class_enrollments pce');
            $this->db->join('users u', 'pce.student_id = u.id');
            $this->db->where('pce.class_id', $kelas_id);
            $this->db->where('pce.status', 'Active');
            $enrolled_students = $this->db->get()->result_array();
        } elseif ($class_type == 'gratis') {
            // Get students enrolled in free class
            $this->db->select('u.id, u.nama_lengkap, "" as nis');
            $this->db->from('free_class_enrollments fce');
            $this->db->join('users u', 'fce.student_id = u.id');
            $this->db->where('fce.class_id', $kelas_id);
            $this->db->where('fce.status', 'Enrolled');
            $enrolled_students = $this->db->get()->result_array();
        }

        if (empty($enrolled_students)) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Tidak ada siswa yang terdaftar di kelas ini'
            ]));
            return;
        }

        // Get existing attendance records
        $existing_attendance = $this->Absensi_model->get_absensi($jadwal_id);
        $existing_student_ids = array_column($existing_attendance, 'siswa_id');

        // Process each enrolled student
        $absent_students = [];
        $present_students = [];

        foreach ($enrolled_students as $student) {
            if (!in_array($student['id'], $existing_student_ids)) {
                // Student hasn't attended, mark as "Tidak Hadir"
                $attendance_data = [
                    'jadwal_id' => $jadwal_id,
                    'siswa_id' => $student['id'],
                    'status' => 'Alpa',
                    'catatan' => 'Otomatis ditandai tidak hadir (pertemuan diakhiri)',
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $this->Absensi_model->save_absensi($attendance_data);
                $absent_students[] = $student;
            } else {
                // Student has attendance record
                $present_students[] = $student;
            }
        }

        // Prepare response summary
        $summary = [
            'total_students' => count($enrolled_students),
            'present_count' => count($present_students),
            'absent_count' => count($absent_students),
            'present_students' => $present_students,
            'absent_students' => $absent_students
        ];

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode([
            'success' => true,
            'message' => 'Pertemuan berhasil diakhiri. ' . count($absent_students) . ' siswa ditandai tidak hadir.',
            'summary' => $summary
        ]));
    }
}
