<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jadwal_model');
        $this->load->model('Kelas_model');
        $this->load->library('session');

        // Cek apakah user sudah login dan memiliki role admin
        if (!$this->session->userdata('logged_in') || !in_array($this->session->userdata('role'), ['admin', 'super_admin'])) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['title'] = 'Kelola Jadwal Kelas';
        $data['jadwal'] = $this->Jadwal_model->get_all_jadwal_with_workshops();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/jadwal/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Tambah Jadwal Kelas';

        // Get premium classes
        $data['premium_kelas'] = $this->Kelas_model->get_all_kelas();

        // Get free classes
        $this->load->model('Free_class_model');
        $data['gratis_kelas'] = $this->Free_class_model->get_all_free_classes();

        $this->load->model('Guru_model');
        $data['guru'] = $this->Guru_model->get_all_gurus();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/jadwal/create', $data);
        $this->load->view('templates/footer');
    }

    public function get_events()
    {
        $events = $this->Jadwal_model->get_all_jadwal_with_workshops();
        $data = [];
        foreach ($events as $event) {
            // Get class name based on class_type
            $class_name = isset($event->nama_kelas) ? $event->nama_kelas : 'Unknown Class';

            if ($event->class_type == 'workshop') {
                // Handle workshop events
                $data[] = [
                    'id' => 'workshop_' . $event->id,
                    'title' => $event->judul_pertemuan . ' (' . $event->pertemuan_ke . ' - ' . $class_name . ')',
                    'start' => $event->tanggal_pertemuan . 'T' . $event->waktu_mulai,
                    'end' => $event->tanggal_pertemuan . 'T' . $event->waktu_selesai,
                    'allDay' => false,
                    'backgroundColor' => '#10B981', // Green for workshops
                    'borderColor' => '#059669',
                    'extendedProps' => [
                        'classId' => $event->id,
                        'className' => $class_name,
                        'classType' => $event->class_type,
                        'type' => $event->pertemuan_ke,
                        'location' => isset($event->location) ? $event->location : '',
                        'onlineMeet' => isset($event->online_meet) ? $event->online_meet : ''
                    ]
                ];
            } else {
                // Handle class schedule events
                $data[] = [
                    'id' => $event->id,
                    'title' => $event->judul_pertemuan . ' (' . $class_name . ')',
                    'start' => $event->tanggal_pertemuan . 'T' . $event->waktu_mulai,
                    'end' => $event->tanggal_pertemuan . 'T' . $event->waktu_selesai,
                    'allDay' => false,
                    'extendedProps' => [
                        'classId' => $event->kelas_id,
                        'className' => $class_name,
                        'classType' => $event->class_type,
                        'guruId' => isset($event->guru_id) ? $event->guru_id : null,
                        'pertemuanKe' => isset($event->pertemuan_ke) ? $event->pertemuan_ke : null
                    ]
                ];
            }
        }
        echo json_encode($data);
    }

    public function update_event_timing()
    {
        if ($this->input->method() !== 'post') {
            show_error('Invalid request method', 405);
            return;
        }

        $id = $this->input->post('id');
        $start = $this->input->post('start');
        $end = $this->input->post('end');

        if (empty($id) || empty($start)) {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode(['status' => 'error', 'message' => 'Data tidak lengkap.']));
            return;
        }

        try {
            $startDate = new DateTime($start);
            $endDate = $end ? new DateTime($end) : clone $startDate;

            // Jika end tidak diset, gunakan start + 1 jam sebagai default
            if (!$end) {
                $endDate->modify('+1 hour');
            }

            $tanggal = $startDate->format('Y-m-d');
            $waktuMulai = $startDate->format('H:i:s');
            $waktuSelesai = $endDate->format('H:i:s');

            if (strpos($id, 'workshop_') === 0) {
                $workshopId = (int)str_replace('workshop_', '', $id);
                $updated = $this->Jadwal_model->update_workshop_timing(
                    $workshopId,
                    $startDate->format('Y-m-d H:i:s'),
                    $endDate->format('Y-m-d H:i:s')
                );
            } else {
                $updated = $this->Jadwal_model->update_jadwal_timing($id, $tanggal, $waktuMulai, $waktuSelesai);
            }

            if ($updated) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['status' => 'success']));
            } else {
                throw new Exception('Gagal memperbarui jadwal.');
            }
        } catch (Exception $e) {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]));
        }
    }

    public function get_classes_by_teacher()
    {
        $teacher_id = $this->input->get('teacher_id');

        if (!$teacher_id) {
            echo json_encode(['error' => 'Teacher ID is required']);
            return;
        }

        $classes = $this->Jadwal_model->get_classes_by_teacher($teacher_id);

        // Format untuk dropdown options
        $options = '<option value="">Pilih Kelas</option>';

        // Group by class type
        $premium_classes = array_filter($classes, function($c) {
            return $c->class_type === 'premium';
        });

        $gratis_classes = array_filter($classes, function($c) {
            return $c->class_type === 'gratis';
        });

        if (!empty($premium_classes)) {
            $options .= '<optgroup label="🏆 Kelas Premium">';
            foreach ($premium_classes as $class) {
                $options .= '<option value="premium_' . $class->id . '">' . $class->nama_kelas . ' (Premium)</option>';
            }
            $options .= '</optgroup>';
        }

        if (!empty($gratis_classes)) {
            $options .= '<optgroup label="🎁 Kelas Gratis">';
            foreach ($gratis_classes as $class) {
                $options .= '<option value="gratis_' . $class->id . '">' . $class->title . ' (Gratis)</option>';
            }
            $options .= '</optgroup>';
        }

        echo json_encode(['options' => $options]);
    }

    public function store()
    {
        $kelas_input = $this->input->post('kelas_id');

        // Parse class type and ID from the combined value
        if (strpos($kelas_input, 'premium_') === 0) {
            $kelas_id = str_replace('premium_', '', $kelas_input);
            $class_type = 'premium';
        } elseif (strpos($kelas_input, 'gratis_') === 0) {
            $kelas_id = str_replace('gratis_', '', $kelas_input);
            $class_type = 'gratis';
        } else {
            $kelas_id = $kelas_input;
            $class_type = 'premium'; // fallback
        }

        // Validasi data
        $guru_id = $this->input->post('guru_id');
        if (empty($class_type) || empty($guru_id)) {
            $this->session->set_flashdata('error', 'Class type dan guru harus diisi.');
            redirect('admin/jadwal/create');
        }

        $data = [
            'kelas_id' => $kelas_id,
            'class_type' => $class_type,
            'guru_id' => $guru_id,
            'pertemuan_ke' => $this->input->post('pertemuan_ke'),
            'judul_pertemuan' => $this->input->post('judul_pertemuan'),
            'tanggal_pertemuan' => $this->input->post('tanggal_pertemuan'),
            'waktu_mulai' => $this->input->post('waktu_mulai'),
            'waktu_selesai' => $this->input->post('waktu_selesai'),
        ];

        // Disable foreign key checks temporarily
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');
        
        try {
            $result = $this->Jadwal_model->insert_jadwal($data);
            
            // Re-enable foreign key checks
            $this->db->query('SET FOREIGN_KEY_CHECKS=1');
            
            if ($result) {
                $this->session->set_flashdata('success', 'Jadwal berhasil ditambahkan.');
            } else {
                throw new Exception('Gagal menambahkan jadwal.');
            }
        } catch (Exception $e) {
            // Make sure to re-enable foreign key checks even if there's an error
            $this->db->query('SET FOREIGN_KEY_CHECKS=1');
            $this->session->set_flashdata('error', $e->getMessage());
        }
        
        redirect('admin/jadwal');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Jadwal Kelas';
        $data['jadwal'] = $this->Jadwal_model->get_jadwal_by_id($id);

        // Get premium classes
        $data['premium_kelas'] = $this->Kelas_model->get_all_kelas();

        // Get free classes
        $this->load->model('Free_class_model');
        $data['gratis_kelas'] = $this->Free_class_model->get_all_free_classes();

        $this->load->model('Guru_model');
        $data['guru'] = $this->Guru_model->get_all_gurus();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/jadwal/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update($id)
    {
        $kelas_input = $this->input->post('kelas_id');

        // Parse class type and ID from the combined value
        if (strpos($kelas_input, 'premium_') === 0) {
            $kelas_id = str_replace('premium_', '', $kelas_input);
            $class_type = 'premium';
        } elseif (strpos($kelas_input, 'gratis_') === 0) {
            $kelas_id = str_replace('gratis_', '', $kelas_input);
            $class_type = 'gratis';
        } else {
            $kelas_id = $kelas_input;
            $class_type = 'premium'; // fallback
        }

        // Validasi data
        $guru_id = $this->input->post('guru_id');
        if (empty($class_type) || empty($guru_id)) {
            $this->session->set_flashdata('error', 'Class type dan guru harus diisi.');
            redirect('admin/jadwal/edit/' . $id);
        }

        $data = [
            'kelas_id' => $kelas_id,
            'class_type' => $class_type,
            'guru_id' => $guru_id,
            'pertemuan_ke' => $this->input->post('pertemuan_ke'),
            'judul_pertemuan' => $this->input->post('judul_pertemuan'),
            'tanggal_pertemuan' => $this->input->post('tanggal_pertemuan'),
            'waktu_mulai' => $this->input->post('waktu_mulai'),
            'waktu_selesai' => $this->input->post('waktu_selesai'),
        ];

        $result = $this->Jadwal_model->update_jadwal($id, $data);
        if ($result) {
            $this->session->set_flashdata('success', 'Jadwal berhasil diupdate.');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengupdate jadwal. Pastikan semua data lengkap.');
        }
        redirect('admin/jadwal');
    }

    public function delete($id)
    {
        $this->Jadwal_model->delete_jadwal($id);
        $this->session->set_flashdata('success', 'Jadwal berhasil dihapus.');
        redirect('admin/jadwal');
    }
}
