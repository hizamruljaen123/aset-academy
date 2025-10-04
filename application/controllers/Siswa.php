<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Siswa_model');
        $this->load->model('Kelas_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        
        // Cek apakah user sudah login, jika belum redirect ke login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        
        // Cek role user - allow admin and super_admin
        $allowed_roles = ['admin', 'super_admin'];
        if (!in_array($this->session->userdata('role'), $allowed_roles)) {
            redirect('dashboard');
        }
        
        // Load data kelas untuk dropdown
        $data['kelas_list'] = $this->Kelas_model->get_all_kelas();
    }

    // Menampilkan daftar siswa
    public function index()
    {
        $data['title'] = 'Data Siswa';
        $data['siswa'] = $this->Siswa_model->get_all_siswa();
        
        $this->load->view('templates/header', $data);
        $this->load->view('siswa/index', $data);
        $this->load->view('templates/footer');
    }

    // Menampilkan form tambah siswa
    public function create()
    {
        $data['title'] = 'Tambah Siswa';
        $data['kelas_list'] = $this->Kelas_model->get_all_kelas();
        
        $this->form_validation->set_rules('nis', 'NIS', 'required|trim|is_unique[siswa.nis]', [
            'required' => 'NIS harus diisi',
            'is_unique' => 'NIS sudah terdaftar'
        ]);
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[siswa.email]', [
            'required' => 'Email harus diisi',
            'valid_email' => 'Email tidak valid',
            'is_unique' => 'Email sudah terdaftar'
        ]);
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required|trim');
        $this->form_validation->set_rules('kelas', 'Kelas Programming', 'required|trim');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');

        // Konfigurasi upload file
        $config['upload_path'] = './uploads/siswa/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2048; // 2MB
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('siswa/create', $data);
            $this->load->view('templates/footer');
        } else {
            $new_siswa_data = [
                'nis' => $this->input->post('nis'),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'email' => $this->input->post('email'),
                'no_telepon' => $this->input->post('no_telepon'),
                'kelas' => $this->input->post('kelas'),
                'jurusan' => $this->input->post('jurusan'),
                'alamat' => $this->input->post('alamat'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'status' => $this->input->post('status'),
            ];

            // Cek apakah ada file yang diupload
            if (!empty($_FILES['foto_profil']['name'])) {
                if ($this->upload->do_upload('foto_profil')) {
                    $upload_data = $this->upload->data();
                    $new_siswa_data['foto_profil'] = $upload_data['file_name'];
                } else {
                    // Jika upload gagal, tampilkan error
                    $data['error_upload'] = $this->upload->display_errors();
                    $this->load->view('templates/header', $data);
                    $this->load->view('siswa/create', $data);
                    $this->load->view('templates/footer');
                    return; // Hentikan eksekusi
                }
            }

            $this->Siswa_model->insert_siswa($new_siswa_data);
            $this->session->set_flashdata('success', 'Data siswa berhasil ditambahkan');
            redirect('siswa');
        }
    }

    // Menampilkan form edit siswa
    public function edit($id)
    {
        $data['title'] = 'Edit Siswa';
        $data['siswa'] = $this->Siswa_model->get_siswa_by_id($id);
        $data['kelas_list'] = $this->Kelas_model->get_all_kelas();
        
        if (empty($data['siswa'])) {
            show_404();
        }

        $this->form_validation->set_rules('nis', 'NIS', 'required|trim', [
            'required' => 'NIS harus diisi'
        ]);
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Email harus diisi',
            'valid_email' => 'Email tidak valid'
        ]);
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required|trim');
        $this->form_validation->set_rules('kelas', 'Kelas Programming', 'required|trim');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('siswa/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $update_data = [
                'nis' => $this->input->post('nis'),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'email' => $this->input->post('email'),
                'no_telepon' => $this->input->post('no_telepon'),
                'kelas' => $this->input->post('kelas'),
                'jurusan' => $this->input->post('jurusan'),
                'alamat' => $this->input->post('alamat'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'status' => $this->input->post('status')
            ];

            $this->Siswa_model->update_siswa($id, $update_data);
            $this->session->set_flashdata('success', 'Data siswa berhasil diupdate');
            redirect('siswa');
        }
    }

    // Menghapus data siswa
    public function delete($id)
    {
        $siswa = $this->Siswa_model->get_siswa_by_id($id);

        if (empty($siswa)) {
            show_404();
        }

        $deleted = $this->Siswa_model->delete_siswa($id);

        if ($deleted > 0) {
            $this->session->set_flashdata('success', 'Data siswa berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Data siswa gagal dihapus.');
        }
        redirect('siswa');
    }

    // Menghapus banyak data siswa sekaligus
    public function bulk_delete()
    {
        $action = $this->input->post('bulk_action');
        $selected_ids = $this->input->post('selected_siswa');

        if ($action !== 'delete') {
            $this->session->set_flashdata('error', 'Pilih aksi yang valid.');
            redirect('siswa');
        }

        if (empty($selected_ids)) {
            $this->session->set_flashdata('error', 'Pilih minimal satu data siswa.');
            redirect('siswa');
        }

        $deleted = $this->Siswa_model->delete_many($selected_ids);

        if ($deleted > 0) {
            $this->session->set_flashdata('success', $deleted . ' data siswa berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Tidak ada data yang dihapus.');
        }

        redirect('siswa');
    }

    // Mencari siswa
    public function search()
    {
        $keyword = $this->input->post('keyword');
        $data['title'] = 'Hasil Pencarian Siswa';
        $data['keyword'] = $keyword;
        
        $this->load->view('templates/header', $data);
        $this->load->view('siswa/index', $data);
        $this->load->view('templates/footer');
    }

    // Menampilkan absensi siswa
    public function absensi()
    {
        $email = $this->session->userdata('email');
        $siswa = $this->Siswa_model->get_siswa_by_email($email);

        if (!$siswa) {
            show_error('Data siswa tidak ditemukan.', 404);
            return;
        }

        $kelas = $this->db->get_where('kelas_programming', ['nama_kelas' => $siswa->kelas])->row();

        if (!$kelas) {
            // Handle case where class might not be found
            $data['rekap'] = [];
        } else {
            $data['rekap'] = $this->Absensi_model->get_rekap_siswa($siswa->id, $kelas->id);
        }

        $data['title'] = 'Absensi Saya';
        $data['siswa'] = $siswa;

        $this->load->view('templates/header', $data);
        $this->load->view('siswa/absensi', $data);
        $this->load->view('templates/footer');
    }

    // Menampilkan detail siswa
    public function detail($id)
    {
        $data['title'] = 'Detail Siswa';
        $data['siswa'] = $this->Siswa_model->get_siswa_by_id($id);
        
        if (empty($data['siswa'])) {
            show_404();
        }

        $data['programming_classes'] = $this->Siswa_model->get_enrolled_programming_classes($id);
        $data['free_classes'] = $this->Siswa_model->get_enrolled_free_classes($id);

        $this->load->view('templates/header', $data);
        $this->load->view('siswa/detail', $data);
        $this->load->view('templates/footer');
    }
}
?>