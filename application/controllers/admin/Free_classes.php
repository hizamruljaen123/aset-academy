<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Free_classes extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Free_class_model');
        $this->load->model('Class_category_model', 'category_model');
        $this->load->model('Enrollment_model');
        $this->load->model('User_model');
        $this->load->library('Permission');
        $this->load->library('form_validation');
        $this->load->helper('file');
        
        // Check if user is logged in and has admin role
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        
        if (!$this->permission->is_admin()) {
            show_error('Access denied. Admin role required.', 403);
        }
    }

    public function index()
    {
        $data['free_classes'] = $this->Free_class_model->get_all_free_classes();
        $data['title'] = 'Kelola Kelas Gratis';
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/free_classes/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function detail($id)
    {
        // Get class details
        $data['free_class'] = $this->Free_class_model->get_free_class_by_id($id);
        
        if (!$data['free_class']) {
            show_404();
        }
        
        // Get class materials
        $data['materials'] = $this->Free_class_model->get_free_class_materials($id);
        
        // Get enrolled students
        $data['enrolled_students'] = $this->Enrollment_model->get_enrolled_students($id, 'free');
        $data['enrolled_count'] = count($data['enrolled_students']);
        
        $data['title'] = 'Detail Kelas: ' . $data['free_class']->title;
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/free_classes/detail', $data);
        $this->load->view('templates/footer');
    }
    
    public function create()
    {
        // Get all mentors (users with guru role)
        $this->db->where('role', 'guru');
        $data['mentors'] = $this->db->get('users')->result();

        // Get class categories (free)
        $data['categories'] = $this->category_model->get_all('free', true);
        
        $this->form_validation->set_rules('title', 'Judul Kelas', 'required|trim');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('level', 'Level', 'required');
        $this->form_validation->set_rules('category_id', 'Kategori', 'required');
        $this->form_validation->set_rules('duration', 'Durasi', 'required|numeric');
        $this->form_validation->set_rules('mentor_id', 'Mentor', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Tambah Kelas Gratis';
            
            $this->load->view('templates/header', $data);
            $this->load->view('admin/free_classes/create', $data);
            $this->load->view('templates/footer');
        } else {
            // Handle thumbnail upload via object storage
            $thumbnail = '';
            if (!empty($_FILES['thumbnail']['name'])) {
                $config = [
                    'upload_path' => sys_get_temp_dir(),
                    'allowed_types' => 'gif|jpg|jpeg|png',
                    'max_size' => 2048,
                    'encrypt_name' => TRUE,
                ];

                $this->load->library('upload');
                $this->upload->initialize($config);

                if ($this->upload->do_upload('thumbnail')) {
                    $upload_data = $this->upload->data();
                    $localPath = $upload_data['full_path'];

                    $this->load->library('ObjectStorage');
                    $remoteKey = 'free_classes/thumbnails/' . date('Y/m') . '/' . $upload_data['file_name'];
                    $url = $this->objectstorage->putFile($localPath, $remoteKey);

                    if ($url) {
                        $thumbnail = $url;
                        @unlink($localPath);
                    } else {
                        @unlink($localPath);
                        $this->session->set_flashdata('error', 'Gagal mengunggah thumbnail ke object storage');
                        redirect('admin/free_classes/create');
                        return;
                    }
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/free_classes/create');
                    return;
                }
            }
            
            $class_data = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'thumbnail' => $thumbnail,
                'level' => $this->input->post('level'),
                'category' => $this->get_category_name($this->input->post('category_id')),
                'category_id' => $this->input->post('category_id'),
                'duration' => $this->input->post('duration'),
                'mentor_id' => $this->input->post('mentor_id'),
                'max_students' => $this->input->post('max_students'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
                'status' => $this->input->post('status')
            ];

            // Temporarily disable foreign key checks
            $this->db->query('SET FOREIGN_KEY_CHECKS = 0');

            $class_id = $this->Free_class_model->create_free_class($class_data);

            // Re-enable foreign key checks
            $this->db->query('SET FOREIGN_KEY_CHECKS = 1');

            if ($class_id) {
                $this->session->set_flashdata('success', 'Kelas gratis berhasil ditambahkan');
                redirect('admin/free_classes/edit/' . $class_id);
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan kelas gratis');
                redirect('admin/free_classes/create');
            }
        }
    }
    
    public function edit($id)
    {
        $data['free_class'] = $this->Free_class_model->get_free_class_by_id($id);
        
        if (!$data['free_class']) {
            show_error('Kelas gratis tidak ditemukan', 404);
        }
        
        // Get all mentors (users with guru role)
        $this->db->where('role', 'guru');
        $data['mentors'] = $this->db->get('users')->result();
        
        // Get class categories (free)
        $data['categories'] = $this->category_model->get_all('free', true);
        
        // Get materials for this class
        $data['materials'] = $this->Free_class_model->get_free_class_materials($id);
        
        $this->form_validation->set_rules('title', 'Judul Kelas', 'required|trim');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('level', 'Level', 'required');
        $this->form_validation->set_rules('category_id', 'Kategori', 'required');
        $this->form_validation->set_rules('duration', 'Durasi', 'required|numeric');
        $this->form_validation->set_rules('mentor_id', 'Mentor', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Edit Kelas Gratis';
            
            $this->load->view('templates/header', $data);
            $this->load->view('admin/free_classes/edit', $data);
            $this->load->view('templates/footer');
        } else {
            // Handle thumbnail upload via object storage
            $thumbnail = $data['free_class']->thumbnail;
            if (!empty($_FILES['thumbnail']['name'])) {
                $config = [
                    'upload_path' => sys_get_temp_dir(),
                    'allowed_types' => 'gif|jpg|jpeg|png',
                    'max_size' => 2048,
                    'encrypt_name' => TRUE,
                ];

                $this->load->library('upload');
                $this->upload->initialize($config);

                if ($this->upload->do_upload('thumbnail')) {
                    $upload_data = $this->upload->data();
                    $localPath = $upload_data['full_path'];

                    $this->load->library('ObjectStorage');
                    $remoteKey = 'free_classes/thumbnails/' . date('Y/m') . '/' . $upload_data['file_name'];
                    $url = $this->objectstorage->putFile($localPath, $remoteKey);

                    if ($url) {
                        $thumbnail = $url;
                        @unlink($localPath);

                        // Delete old thumbnail if it was stored locally
                        if (!empty($data['free_class']->thumbnail)
                            && !filter_var($data['free_class']->thumbnail, FILTER_VALIDATE_URL)
                            && file_exists('./' . $data['free_class']->thumbnail)) {
                            unlink('./' . $data['free_class']->thumbnail);
                        }
                    } else {
                        @unlink($localPath);
                        $this->session->set_flashdata('error', 'Gagal mengunggah thumbnail ke object storage');
                        redirect('admin/free_classes/edit/' . $id);
                        return;
                    }
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/free_classes/edit/' . $id);
                    return;
                }
            }
            
            $class_data = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'thumbnail' => $thumbnail,
                'level' => $this->input->post('level'),
                'category' => $this->get_category_name($this->input->post('category_id')),
                'category_id' => $this->input->post('category_id'),
                'duration' => $this->input->post('duration'),
                'mentor_id' => $this->input->post('mentor_id'),
                'max_students' => $this->input->post('max_students'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
                'status' => $this->input->post('status')
            ];
            
            if ($this->Free_class_model->update_free_class($id, $class_data)) {
                $this->session->set_flashdata('success', 'Kelas gratis berhasil diperbarui');
                redirect('admin/free_classes/edit/' . $id);
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui kelas gratis');
                redirect('admin/free_classes/edit/' . $id);
            }
        }
    }
    
    public function delete($id)
    {
        $free_class = $this->Free_class_model->get_free_class_by_id($id);
        
        if (!$free_class) {
            show_error('Kelas gratis tidak ditemukan', 404);
        }
        
        // Delete thumbnail if exists
        if (!empty($free_class->thumbnail)
            && !filter_var($free_class->thumbnail, FILTER_VALIDATE_URL)
            && file_exists('./' . $free_class->thumbnail)) {
            unlink('./' . $free_class->thumbnail);
        }
        
        if ($this->Free_class_model->delete_free_class($id)) {
            $this->session->set_flashdata('success', 'Kelas gratis berhasil dihapus');
            redirect('admin/free_classes');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus kelas gratis');
            redirect('admin/free_classes');
        }
    }

    private function get_category_name($category_id)
    {
        $category = $this->category_model->get_by_id($category_id);
        return $category ? $category->name : '';
    }

    public function add_material($class_id)
    {
        $free_class = $this->Free_class_model->get_free_class_by_id($class_id);
        
        if (!$free_class) {
            show_error('Kelas gratis tidak ditemukan', 404);
        }
        
        $this->form_validation->set_rules('title', 'Judul Materi', 'required|trim');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('content_type', 'Tipe Konten', 'required');
        $this->form_validation->set_rules('content', 'Konten', 'required');
        $this->form_validation->set_rules('order', 'Urutan', 'required|numeric');
        
        if ($this->form_validation->run() === FALSE) {
            $data['free_class'] = $free_class;
            $data['title'] = 'Tambah Materi Kelas Gratis';
            
            $this->load->view('templates/header', $data);
            $this->load->view('admin/free_classes/add_material', $data);
            $this->load->view('templates/footer');
        } else {
            $material_data = [
                'class_id' => $class_id,
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'content_type' => $this->input->post('content_type'),
                'content' => $this->input->post('content'),
                'order' => $this->input->post('order')
            ];
            
            if ($this->Free_class_model->create_free_class_material($material_data)) {
                $this->session->set_flashdata('success', 'Materi berhasil ditambahkan');
                redirect('admin/free_classes/edit/' . $class_id);
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan materi');
                redirect('admin/free_classes/add_material/' . $class_id);
            }
        }
    }
    
    public function edit_material($material_id)
    {
        $material = $this->Free_class_model->get_free_class_material_by_id($material_id);
        
        if (!$material) {
            show_error('Materi tidak ditemukan', 404);
        }
        
        $free_class = $this->Free_class_model->get_free_class_by_id($material->class_id);
        
        $this->form_validation->set_rules('title', 'Judul Materi', 'required|trim');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('content_type', 'Tipe Konten', 'required');
        $this->form_validation->set_rules('content', 'Konten', 'required');
        $this->form_validation->set_rules('order', 'Urutan', 'required|numeric');
        
        if ($this->form_validation->run() === FALSE) {
            $data['material'] = $material;
            $data['free_class'] = $free_class;
            $data['title'] = 'Edit Materi Kelas Gratis';
            
            $this->load->view('templates/header', $data);
            $this->load->view('admin/free_classes/edit_material', $data);
            $this->load->view('templates/footer');
        } else {
            $material_data = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'content_type' => $this->input->post('content_type'),
                'content' => $this->input->post('content'),
                'order' => $this->input->post('order')
            ];
            
            if ($this->Free_class_model->update_free_class_material($material_id, $material_data)) {
                $this->session->set_flashdata('success', 'Materi berhasil diperbarui');
                redirect('admin/free_classes/edit/' . $material->class_id);
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui materi');
                redirect('admin/free_classes/edit_material/' . $material_id);
            }
        }
    }
    
    public function delete_material($material_id)
    {
        $material = $this->Free_class_model->get_free_class_material_by_id($material_id);
        
        if (!$material) {
            show_error('Materi tidak ditemukan', 404);
        }
        
        $class_id = $material->class_id;
        
        if ($this->Free_class_model->delete_free_class_material($material_id)) {
            $this->session->set_flashdata('success', 'Materi berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus materi');
        }
        
        redirect('admin/free_classes/edit/' . $class_id);
    }
    
    public function students($class_id)
    {
        $free_class = $this->Free_class_model->get_free_class_by_id($class_id);
        
        if (!$free_class) {
            show_error('Kelas gratis tidak ditemukan', 404);
        }
        
        $data['free_class'] = $free_class;
        $data['enrolled_students'] = $this->Enrollment_model->get_enrolled_students($class_id);
        $data['title'] = 'Siswa Terdaftar - ' . $free_class->title;
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/free_classes/students', $data);
        $this->load->view('templates/footer');
    }
    
    public function student_progress($enrollment_id)
    {
        $enrollment = $this->Enrollment_model->get_enrollment_details($enrollment_id);
        
        if (!$enrollment) {
            show_error('Data pendaftaran tidak ditemukan', 404);
        }
        
        $data['enrollment'] = $enrollment;
        $data['progress'] = $this->Enrollment_model->get_all_material_progress($enrollment_id);
        $data['title'] = 'Progress Siswa - ' . $enrollment->title;
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/free_classes/student_progress', $data);
        $this->load->view('templates/footer');
    }
    
    public function update_student_status($enrollment_id)
    {
        $enrollment = $this->Enrollment_model->get_enrollment_details($enrollment_id);
        
        if (!$enrollment) {
            show_error('Data pendaftaran tidak ditemukan', 404);
        }
        
        $status = $this->input->post('status');
        
        if ($this->Enrollment_model->update_enrollment_status($enrollment_id, $status)) {
            $this->session->set_flashdata('success', 'Status siswa berhasil diperbarui');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui status siswa');
        }
        
        redirect('admin/free_classes/students/' . $enrollment->class_id);
    }
}
