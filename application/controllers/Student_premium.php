<?php
class Student_premium extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Kelas_programming_model');
        $this->load->model('Payment_model');
        
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        
        if ($this->session->userdata('role') != 'siswa') {
            // If not a student, redirect to their respective dashboard or show an error
            if ($this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'super_admin') {
                redirect('dashboard');
            } else {
                show_error('Access denied. You must be a student to view this page.', 403);
            }
        }
    }

    public function index() {
        $student_id = $this->session->userdata('user_id');
        
        // Get paid classes with active enrollment
        $this->load->model('Premium_enrollment_model');
        $data['paid_classes'] = $this->Premium_enrollment_model->get_student_enrollments($student_id);
        
        // Get available premium classes
        $data['premium_classes'] = $this->Kelas_programming_model->get_premium_classes($student_id);

        // Pesanan kelas (semua pembayaran)
        $this->load->model('Payment_model');
        $data['orders'] = $this->Payment_model->get_user_payments($student_id);
        
        $data['title'] = 'Kelas Premium';
        $this->load->view('templates/header', $data);
        $this->load->view('student/premium', $data);
        $this->load->view('templates/footer');
    }
    
    public function detail($class_id) {
        $data['class'] = $this->Kelas_programming_model->get_kelas_by_id($class_id);
        if (!$data['class']) show_404();
        
        $data['title'] = 'Detail Kelas - ' . $data['class']->nama_kelas;
        $this->load->view('templates/header', $data);
        $this->load->view('student/premium_detail', $data);
        $this->load->view('templates/footer');
    }
    
    public function learn($enrollment_id)
    {
        $student_id = $this->session->userdata('user_id');

        $this->load->model('Premium_enrollment_model');
        $enrollment = $this->Premium_enrollment_model->get_enrollment_details_by_id($enrollment_id);

        if (!$enrollment || (int) $enrollment->student_id !== (int) $student_id) {
            show_error('Data pendaftaran premium tidak ditemukan.', 404);
        }

        if (!in_array($enrollment->status, ['Active', 'Completed'])) {
            $this->session->set_flashdata('error', 'Akses kelas premium ini belum aktif. Silakan hubungi admin.');
            redirect('student/premium');
            return;
        }

        $this->load->model('Materi_model');
        $this->load->model('Jadwal_model');

        $materials = $this->Materi_model->get_materi_by_kelas($enrollment->class_id);
        $jadwal = $this->Jadwal_model->get_jadwal_by_kelas($enrollment->class_id, 'premium');

        // Load timezone library
        $this->load->library('timezone_lib');

        // Check attendance status for each schedule
        $data['attendance_status'] = [];
        $data['can_attend_now'] = false;

        foreach ($jadwal as $schedule) {
            $attendance_record = $this->timezone_lib->get_student_attendance($schedule->id, $student_id);

            if ($attendance_record) {
                $data['attendance_status'][$schedule->id] = [
                    'status' => $attendance_record->status,
                    'catatan' => $attendance_record->catatan,
                    'waktu_absen' => $attendance_record->created_at
                ];
            } else {
                // Check if can attend now
                $can_attend = $this->timezone_lib->can_attend_schedule($schedule, $student_id);
                $attendance_status = $this->timezone_lib->get_attendance_status($schedule, $student_id);

                $data['attendance_status'][$schedule->id] = [
                    'status' => 'not_attended',
                    'can_attend' => $can_attend,
                    'attendance_status' => $attendance_status
                ];

                if ($can_attend) {
                    $data['can_attend_now'] = true;
                    $data['current_schedule'] = $schedule;
                }
            }
        }

        // Get material progress
        $data['progress'] = $this->Premium_enrollment_model->get_all_material_progress($enrollment_id);

        // Get discussions
        $data['discussions'] = $this->Premium_enrollment_model->get_class_discussions($enrollment->class_id);

        $upcoming_schedule = null;
        $now = time();
        foreach ($jadwal as $schedule) {
            $startTimestamp = strtotime($schedule->tanggal_pertemuan . ' ' . $schedule->waktu_mulai);
            if ($startTimestamp !== false && $startTimestamp >= $now) {
                $upcoming_schedule = $schedule;
                break;
            }
        }

        $mentor_name = null;
        if (!empty($jadwal) && isset($jadwal[0]->guru_id)) {
            $mentor = $this->db->select('nama_lengkap')->from('users')->where('id', $jadwal[0]->guru_id)->get()->row();
            if ($mentor) {
                $mentor_name = $mentor->nama_lengkap;
            }
        }

        $data = [
            'title' => 'Belajar Premium - ' . $enrollment->nama_kelas,
            'enrollment' => $enrollment,
            'materials' => $materials,
            'jadwal' => $jadwal,
            'upcoming_schedule' => $upcoming_schedule,
            'mentor_name' => $mentor_name,
            'attendance_status' => $data['attendance_status'],
            'can_attend_now' => $data['can_attend_now'],
            'current_schedule' => $data['current_schedule'] ?? null,
            'progress' => $data['progress'],
            'discussions' => $data['discussions']
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('student/premium_learn', $data);
        $this->load->view('templates/footer');
    }
    
    public function submit_attendance()
    {
        $student_id = $this->session->userdata('user_id');
        $jadwal_id = $this->input->post('jadwal_id');
        $enrollment_id = $this->input->post('enrollment_id');

        if (!$student_id || !$jadwal_id) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Data tidak lengkap'
            ]));
            return;
        }

        // Validasi enrollment
        $this->load->model('Premium_enrollment_model');
        $enrollment = $this->Premium_enrollment_model->get_enrollment_details_by_id($enrollment_id);
        if (!$enrollment || $enrollment->student_id != $student_id) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Data pendaftaran tidak valid'
            ]));
            return;
        }

        // Load timezone library
        $this->load->library('timezone_lib');

        // Check if already attended
        if ($this->timezone_lib->has_student_attended($jadwal_id, $student_id)) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Anda sudah mengisi absensi untuk jadwal ini'
            ]));
            return;
        }

        // Get jadwal details
        $jadwal = $this->db->get_where('jadwal_kelas_view', ['id' => $jadwal_id])->row();
        if (!$jadwal) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Jadwal tidak ditemukan'
            ]));
            return;
        }

        // Check if within attendance window
        if (!$this->timezone_lib->can_attend_schedule($jadwal, $student_id)) {
            $status = $this->timezone_lib->get_attendance_status($jadwal, $student_id);
            $message = ($status === 'late') ? 'Waktu absensi sudah terlewat' : 'Belum waktunya absensi';
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => $message
            ]));
            return;
        }

        // Insert attendance record
        $attendance_data = [
            'jadwal_id' => $jadwal_id,
            'siswa_id' => $student_id,
            'status' => 'Hadir',
            'catatan' => 'Absensi otomatis via sistem',
            'created_at' => date('Y-m-d H:i:s')
        ];

        $result = $this->db->insert('absensi', $attendance_data);

        if ($result) {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => true,
                'message' => 'Absensi berhasil dicatat',
                'attendance_time' => date('d M Y H:i:s')
            ]));
        } else {
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Gagal mencatat absensi'
            ]));
        }
    }

    public function post_discussion()
    {
        $student_id = $this->session->userdata('user_id');
        $enrollment_id = $this->input->post('enrollment_id');
        $parent_id = $this->input->post('parent_id');
        $message = $this->input->post('message');

        if (empty($message)) {
            $this->session->set_flashdata('error', 'Pesan tidak boleh kosong');
            redirect('student/premium/learn/' . $enrollment_id);
        }

        // Get enrollment to get class_id
        $this->load->model('Premium_enrollment_model');
        $enrollment = $this->Premium_enrollment_model->get_enrollment_details_by_id($enrollment_id);
        if (!$enrollment || $enrollment->student_id != $student_id) {
            show_error('Data pendaftaran tidak ditemukan', 404);
        }

        $discussion_data = [
            'class_id' => $enrollment->class_id,
            'user_id' => $student_id,
            'parent_id' => $parent_id ? $parent_id : null,
            'message' => $message
        ];

        if ($this->Premium_enrollment_model->create_discussion($discussion_data)) {
            $this->session->set_flashdata('success', 'Diskusi berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan diskusi');
        }

        redirect('student/premium/learn/' . $enrollment_id);
    }
    
    public function material($enrollment_id, $material_id)
    {
        $student_id = $this->session->userdata('user_id');
        $enrollment = $this->Premium_enrollment_model->get_enrollment_details_by_id($enrollment_id);

        if (!$enrollment || (int) $enrollment->student_id !== (int) $student_id) {
            show_error('Data pendaftaran premium tidak ditemukan.', 404);
        }

        $this->load->model('Materi_model');
        $material = $this->Materi_model->get_materi_by_id($material_id);

        if (!$material || $material->kelas_id != $enrollment->class_id) {
            show_error('Materi tidak ditemukan', 404);
        }

        // Get material progress
        $progress = $this->Premium_enrollment_model->get_material_progress($enrollment_id, $material_id);

        // Update last accessed time if not completed
        if ($progress && $progress->status != 'Completed') {
            $this->Premium_enrollment_model->update_material_progress($enrollment_id, $material_id, 'In Progress');
        }

        // Get all materials for navigation
        $this->load->model('Materi_model');
        $data['all_materials'] = $this->Materi_model->get_materi_by_kelas($enrollment->class_id);

        // Find next and previous materials
        $data['next_material'] = null;
        $data['prev_material'] = null;

        foreach ($data['all_materials'] as $index => $m) {
            if ($m->id == $material_id) {
                if ($index > 0) {
                    $data['prev_material'] = $data['all_materials'][$index - 1];
                }
                if ($index < count($data['all_materials']) - 1) {
                    $data['next_material'] = $data['all_materials'][$index + 1];
                }
                break;
            }
        }

        $data['enrollment'] = $enrollment;
        $data['material'] = $material;
        $data['progress'] = $progress;
        $data['title'] = $material->judul;

        $this->load->view('templates/header', $data);
        $this->load->view('student/premium/material', $data);
        $this->load->view('templates/footer');
    }

    public function complete_material($enrollment_id, $material_id)
    {
        $student_id = $this->session->userdata('user_id');
        $enrollment = $this->Premium_enrollment_model->get_enrollment_details_by_id($enrollment_id);

        if (!$enrollment || (int) $enrollment->student_id !== (int) $student_id) {
            show_error('Data pendaftaran premium tidak ditemukan.', 404);
        }

        $this->load->model('Materi_model');
        $material = $this->Materi_model->get_materi_by_id($material_id);

        if (!$material || $material->kelas_id != $enrollment->class_id) {
            show_error('Materi tidak ditemukan', 404);
        }

        // Mark material as completed
        $this->Premium_enrollment_model->update_material_progress($enrollment_id, $material_id, 'Completed');

        // Find next material
        $next_material = null;
        $materials = $this->Materi_model->get_materi_by_kelas($enrollment->class_id);

        foreach ($materials as $index => $m) {
            if ($m->id == $material_id && $index < count($materials) - 1) {
                $next_material = $materials[$index + 1];
                break;
            }
        }

        $this->session->set_flashdata('success', 'Materi berhasil diselesaikan');

        if ($next_material) {
            redirect('student/premium/material/' . $enrollment_id . '/' . $next_material->id);
        } else {
            redirect('student/premium/learn/' . $enrollment_id);
        }
    }
    
}
