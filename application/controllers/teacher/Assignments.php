<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher_Assignments extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // Redirect all requests to the main Teacher controller
        redirect('teacher/assignments');
    }
    
    public function index() {
        redirect('teacher/assignments');
    }
}
