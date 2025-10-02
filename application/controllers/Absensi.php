<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Absensi_model');
        $this->load->library('session');

        // Cek apakah user sudah login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['title'] = 'Data Absensi';
        $role = $this->session->userdata('role');
        $user_id = $this->session->userdata('id');
        
        // Initialize data arrays
        $data['absensi_guru'] = [];
        $data['absensi_siswa'] = [];
        $data['absensi_comprehensive'] = [];
        $data['total_jam_mengajar'] = 0;
        $data['stats'] = [
            'total_absensi' => 0,
            'total_hadir' => 0,
            'total_tidak_hadir' => 0,
            'total_izin' => 0,
            'total_sakit' => 0,
            'total_guru_hadir' => 0,
            'total_guru_tidak_hadir' => 0
        ];

        if ($role == 'super_admin' || $role == 'admin') {
            // Load required models
            $this->load->model('Jadwal_model');
            $this->load->model('Guru_model');
            $this->load->model('Siswa_model');

            try {
                // Load all necessary data first
                $data['absensi_comprehensive'] = $this->get_comprehensive_absensi_data();
                $data['absensi_siswa'] = $this->Absensi_model->get_all_absensi();
                $data['absensi_guru'] = $this->Guru_model->get_all_absensi_guru();
                
                // Debug: Log teacher attendance data
                log_message('debug', 'Teacher attendance data loaded: ' . print_r($data['absensi_guru'], true));
                
                // Calculate total teaching hours
                $total_jam = 0;
                if (!empty($data['absensi_guru'])) {
                    foreach ($data['absensi_guru'] as $absen) {
                        if (!empty($absen['waktu_mulai']) && !empty($absen['waktu_selesai'])) {
                            try {
                                $start = new DateTime($absen['waktu_mulai']);
                                $end = new DateTime($absen['waktu_selesai']);
                                $diff = $start->diff($end);
                                $total_jam += $diff->h + ($diff->i / 60); // Convert minutes to hours
                            } catch (Exception $e) {
                                log_message('error', 'Error calculating teaching hours: ' . $e->getMessage());
                            }
                        }
                    }
                }
                $data['total_jam_mengajar'] = number_format($total_jam, 1);
                
                // Get statistics
                $data['stats'] = [
                    'total_absensi' => $this->Absensi_model->count_total_absensi(),
                    'total_hadir' => $this->Absensi_model->count_absensi_by_status('Hadir'),
                    'total_tidak_hadir' => $this->Absensi_model->count_absensi_by_status('Alpa'),
                    'total_izin' => $this->Absensi_model->count_absensi_by_status('Izin'),
                    'total_sakit' => $this->Absensi_model->count_absensi_by_status('Sakit'),
                    'total_guru_hadir' => $this->Guru_model->count_total_absensi_guru('Hadir'),
                    'total_guru_tidak_hadir' => $this->Guru_model->count_total_absensi_guru() - $this->Guru_model->count_total_absensi_guru('Hadir'),
                ];
                
                log_message('debug', 'Stats data: ' . print_r($data['stats'], true));
                
            } catch (Exception $e) {
                log_message('error', 'Error in Absensi controller: ' . $e->getMessage());
                $this->session->set_flashdata('error', 'Terjadi kesalahan saat memuat data absensi.');
            }

        } elseif ($role == 'guru') {
            $data['absensi'] = $this->Absensi_model->get_absensi_for_user($user_id, $role);
        } elseif ($role == 'siswa') {
            $this->load->model('Siswa_model');
            $email = $this->session->userdata('email');
            $siswa = $this->Siswa_model->get_siswa_by_email($email);
            if ($siswa) {
                $data['absensi'] = $this->Absensi_model->get_absensi_for_user($siswa->id, $role);
            } else {
                $data['absensi'] = []; // No student data found for this user
            }
        } else {
            $data['absensi'] = []; // No role matched
        }

        $this->load->view('templates/header', $data);
        if ($role == 'siswa') {
            $this->load->view('siswa/absensi_calendar', $data);
        } else {
            // Use the index view for all admin/teacher roles which includes the teacher attendance tab
            $this->load->view('admin/absensi/index', $data);
        }
        $this->load->view('templates/footer');
    }

    private function get_comprehensive_absensi_data()
    {
        // Get all attendance records with comprehensive information
        $this->db->select('
            a.*,
            jk.judul_pertemuan,
            jk.tanggal_pertemuan,
            jk.waktu_mulai,
            jk.waktu_selesai,
            jk.class_type,
            s.nama_lengkap as nama_siswa,
            s.nis,
            s.kelas,
            s.jurusan,
            u.nama_lengkap as nama_guru
        ');
        $this->db->from('absensi a');
        $this->db->join('jadwal_kelas jk', 'a.jadwal_id = jk.id', 'left');
        $this->db->join('siswa s', 'a.siswa_id = s.id', 'left');
        $this->db->join('users u', 'jk.guru_id = u.id', 'left');
        $this->db->order_by('jk.tanggal_pertemuan', 'DESC');
        $this->db->order_by('jk.waktu_mulai', 'DESC');

        $student_absensi = $this->db->get()->result();

        // Get teacher attendance for these schedules
        $jadwal_ids = array_unique(array_column($student_absensi, 'jadwal_id'));
        $teacher_absensi = $this->Guru_model->get_absensi_guru_by_jadwal_ids($jadwal_ids);

        // Group by class and date for better organization
        $grouped_data = [];
        foreach ($student_absensi as $record) {
            $key = $record->judul_pertemuan . '_' . $record->tanggal_pertemuan;
            if (!isset($grouped_data[$key])) {
                $grouped_data[$key] = [
                    'jadwal_info' => [
                        'judul' => $record->judul_pertemuan,
                        'tanggal' => $record->tanggal_pertemuan,
                        'waktu_mulai' => $record->waktu_mulai,
                        'waktu_selesai' => $record->waktu_selesai,
                        'class_type' => $record->class_type,
                        'nama_guru' => $record->nama_guru
                    ],
                    'absensi_siswa' => [],
                    'absensi_guru' => isset($teacher_absensi[$record->jadwal_id]) ? $teacher_absensi[$record->jadwal_id] : null
                ];
            }
            $grouped_data[$key]['absensi_siswa'][] = $record;
        }

        return $grouped_data;
    }
}
