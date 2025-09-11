<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }
    
    public function form() {
        $data['title'] = 'Test Form Input Styles';
        $this->load->view('test_form', $data);
    }
}
