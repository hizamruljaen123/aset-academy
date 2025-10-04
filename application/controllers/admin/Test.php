<?php
/**
 * Test script untuk memverifikasi class_categories CRUD
 * Jalankan dengan mengakses URL ini setelah login sebagai admin:
 * http://localhost/aset-academy/admin/class_categories/test
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Class_category_model', 'category_model');

        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        if (!$this->permission->is_admin()) {
            show_error('Access denied. Admin role required.', 403);
        }
    }

    public function index()
    {
        $data['title'] = 'Test Class Categories CRUD';

        // Test 1: Get all categories
        $data['all_categories'] = $this->category_model->get_all();
        $data['premium_categories'] = $this->category_model->get_all('premium');
        $data['free_categories'] = $this->category_model->get_all('free');
        $data['active_categories'] = $this->category_model->get_all(null, true);

        // Test 2: Test create if no categories exist
        if (empty($data['all_categories'])) {
            $test_data = [
                'name' => 'Test Category',
                'slug' => 'test-category',
                'class_type' => 'premium',
                'description' => 'This is a test category',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->category_model->create($test_data);
            $data['test_created'] = true;
        }

        $this->load->view('templates/header', $data);
        $this->load->view('admin/class_categories/test', $data);
        $this->load->view('templates/footer');
    }
}
