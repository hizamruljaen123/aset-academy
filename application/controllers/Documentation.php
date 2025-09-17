<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documentation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index() {
        $data['title'] = 'Dokumentasi - Dasar-dasar Teknologi untuk Pemula';
        $data['description'] = 'Panduan lengkap dasar-dasar teknologi dan ilmu komputer untuk pemula';
        $data['keywords'] = 'dokumentasi, tutorial, pemrograman, dasar komputer, teknologi, pemula';
        
        $this->load->view('home/templates/_header', $data);
        $this->load->view('documentation/index', $data);
        $this->load->view('home/templates/_footer');
    }

    // Chapter 1: Pengenalan Komputer dan Sistem Operasi
    public function chapter1() {
        $data['title'] = 'Bab 1: Pengenalan Komputer dan Sistem Operasi';
        $data['description'] = 'Memahami komponen dasar komputer dan sistem operasi';
        $data['keywords'] = 'komputer, sistem operasi, hardware, software, windows, linux';
        
        $this->load->view('home/templates/_header', $data);
        $this->load->view('documentation/chapter1', $data);
        $this->load->view('home/templates/_footer');
    }

    // Chapter 2: Dasar-dasar Jaringan Komputer
    public function chapter2() {
        $data['title'] = 'Bab 2: Dasar-dasar Jaringan Komputer';
        $data['description'] = 'Memahami konsep jaringan komputer dan internet';
        $data['keywords'] = 'jaringan, internet, IP, DNS, HTTP, HTTPS, protokol';
        
        $this->load->view('home/templates/_header', $data);
        $this->load->view('documentation/chapter2', $data);
        $this->load->view('home/templates/_footer');
    }

    // Chapter 3: Pengenalan Pemrograman
    public function chapter3() {
        $data['title'] = 'Bab 3: Pengenalan Pemrograman';
        $data['description'] = 'Konsep dasar pemrograman dan algoritma';
        $data['keywords'] = 'pemrograman, algoritma, flowchart, pseudocode, logika';
        
        $this->load->view('home/templates/_header', $data);
        $this->load->view('documentation/chapter3', $data);
        $this->load->view('home/templates/_footer');
    }

    // Chapter 4: Bahasa Pemrograman Dasar
    public function chapter4() {
        $data['title'] = 'Bab 4: Bahasa Pemrograman Dasar';
        $data['description'] = 'Mengenal berbagai bahasa pemrograman dan sintaks dasar';
        $data['keywords'] = 'bahasa pemrograman, python, javascript, java, php, sintaks';
        
        $this->load->view('home/templates/_header', $data);
        $this->load->view('documentation/chapter4', $data);
        $this->load->view('home/templates/_footer');
    }

    // Chapter 5: Struktur Data Dasar
    public function chapter5() {
        $data['title'] = 'Bab 5: Struktur Data Dasar';
        $data['description'] = 'Memahami array, list, dan struktur data dasar lainnya';
        $data['keywords'] = 'struktur data, array, list, stack, queue, dictionary';
        
        $this->load->view('home/templates/_header', $data);
        $this->load->view('documentation/chapter5', $data);
        $this->load->view('home/templates/_footer');
    }

    // Chapter 6: Database dan SQL
    public function chapter6() {
        $data['title'] = 'Bab 6: Database dan SQL';
        $data['description'] = 'Pengenalan database dan query SQL dasar';
        $data['keywords'] = 'database, SQL, MySQL, PostgreSQL, query, tabel';
        
        $this->load->view('home/templates/_header', $data);
        $this->load->view('documentation/chapter6', $data);
        $this->load->view('home/templates/_footer');
    }

    // Chapter 7: Web Development Dasar
    public function chapter7() {
        $data['title'] = 'Bab 7: Web Development Dasar';
        $data['description'] = 'HTML, CSS, dan JavaScript untuk pemula';
        $data['keywords'] = 'web development, HTML, CSS, JavaScript, frontend, website';
        
        $this->load->view('home/templates/_header', $data);
        $this->load->view('documentation/chapter7', $data);
        $this->load->view('home/templates/_footer');
    }

    // Chapter 8: Version Control dengan Git
    public function chapter8() {
        $data['title'] = 'Bab 8: Version Control dengan Git';
        $data['description'] = 'Mengelola kode dengan Git dan GitHub';
        $data['keywords'] = 'git, github, version control, repository, commit, branch';
        
        $this->load->view('home/templates/_header', $data);
        $this->load->view('documentation/chapter8', $data);
        $this->load->view('home/templates/_footer');
    }

    // Chapter 9: Security dan Best Practices
    public function chapter9() {
        $data['title'] = 'Bab 9: Security dan Best Practices';
        $data['description'] = 'Keamanan dasar dan praktik terbaik dalam programming';
        $data['keywords'] = 'security, keamanan, best practices, validasi, enkripsi';
        
        $this->load->view('home/templates/_header', $data);
        $this->load->view('documentation/chapter9', $data);
        $this->load->view('home/templates/_footer');
    }

    // Chapter 10: Karier dan Pengembangan Diri
    public function chapter10() {
        $data['title'] = 'Bab 10: Karier dan Pengembangan Diri';
        $data['description'] = 'Membangun karier di bidang teknologi dan pengembangan diri';
        $data['keywords'] = 'karier teknologi, portfolio, interview, skill development';
        
        $this->load->view('home/templates/_header', $data);
        $this->load->view('documentation/chapter10', $data);
        $this->load->view('home/templates/_footer');
    }
}