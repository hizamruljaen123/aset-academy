<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistics_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_total_users()
    {
        return $this->db->count_all('users');
    }

    public function get_total_revenue()
    {
        $this->db->select_sum('amount');
        $query = $this->db->get('payments');
        return $query->row()->amount ?? 0;
    }

    public function get_total_premium_enrollments()
    {
        return $this->db->count_all('premium_class_enrollments');
    }

    public function get_total_free_enrollments()
    {
        return $this->db->count_all('free_class_enrollments');
    }

    public function get_user_growth_data($days = 30)
    {
        $this->db->select('DATE(created_at) as date, COUNT(id) as count');
        $this->db->from('users');
        $this->db->where('created_at >=', date('Y-m-d', strtotime("-$days days")));
        $this->db->group_by('DATE(created_at)');
        $this->db->order_by('date', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_revenue_trend($days = 30)
    {
        $this->db->select('DATE(created_at) as date, SUM(amount) as total');
        $this->db->from('payments');
        $this->db->where('created_at >=', date('Y-m-d', strtotime("-$days days")));
        $this->db->where('status', 'Verified');
        $this->db->group_by('DATE(created_at)');
        $this->db->order_by('date', 'ASC');
        return $this->db->get()->result_array();
    }

    public function get_premium_enrollments_trend($days = 30)
    {
        $this->db->select('DATE(enrollment_date) as date, COUNT(id) as count');
        $this->db->from('premium_class_enrollments');
        $this->db->where('enrollment_date >=', date('Y-m-d', strtotime("-$days days")));
        $this->db->group_by('DATE(enrollment_date)');
        $this->db->order_by('date', 'ASC');
        return $this->db->get()->result_array();
    }

    public function get_free_enrollments_trend($days = 30)
    {
        $this->db->select('DATE(enrollment_date) as date, COUNT(id) as count');
        $this->db->from('free_class_enrollments');
        $this->db->where('enrollment_date >=', date('Y-m-d', strtotime("-$days days")));
        $this->db->group_by('DATE(enrollment_date)');
        $this->db->order_by('date', 'ASC');
        return $this->db->get()->result_array();
    }

    public function get_payment_status_distribution()
    {
        $this->db->select('status, COUNT(*) as count');
        $this->db->from('payments');
        $this->db->group_by('status');
        $rows = $this->db->get()->result_array();
        return $rows;
    }

}
