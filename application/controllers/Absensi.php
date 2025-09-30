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
        $data['title'] = 'Data Absensi Siswa';
        $role = $this->session->userdata('role');
        $user_id = $this->session->userdata('id');

        if ($role == 'super_admin' || $role == 'admin') {
            // Get comprehensive attendance data for admin
            $this->load->model('Jadwal_model');
            $this->load->model('Guru_model');
            $this->load->model('Siswa_model');

            // Get all attendance records with detailed information
            $data['absensi_comprehensive'] = $this->get_comprehensive_absensi_data();

            // Get statistics
            $data['stats'] = [
                'total_absensi' => $this->Absensi_model->count_total_absensi(),
                'total_hadir' => $this->Absensi_model->count_absensi_by_status('Hadir'),
                'total_tidak_hadir' => $this->Absensi_model->count_absensi_by_status('Alpa'),
                'total_izin' => $this->Absensi_model->count_absensi_by_status('Izin'),
                'total_sakit' => $this->Absensi_model->count_absensi_by_status('Sakit'),
                'total_guru_hadir' => $this->Guru_model->count_total_absensi_guru(),
            ];

            // Legacy data for backward compatibility
            $data['absensi_siswa'] = $this->Absensi_model->get_all_absensi();
            $data['absensi_guru'] = $this->Guru_model->get_all_absensi_guru();

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
        } elseif ($role == 'super_admin' || $role == 'admin') {
            $this->load->view('admin/absensi/comprehensive', $data);
        } else {
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

        $results = $this->db->get()->result();

        // Group by class and date for better organization
        $grouped_data = [];
        foreach ($results as $record) {
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
                    'absensi' => []
                ];
            }
            $grouped_data[$key]['absensi'][] = $record;
        }

        return $grouped_data;
    }
}
