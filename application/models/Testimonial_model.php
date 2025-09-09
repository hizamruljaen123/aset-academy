<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonial_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_testimonials()
    {
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get('testimonials');
        return $query->result();
    }

    public function get_featured_testimonials($limit = 5)
    {
        $this->db->order_by('rating', 'DESC');
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get('testimonials');
        return $query->result();
    }
}
