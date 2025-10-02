<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistics extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // TODO: Add security check to ensure only admins can access this page
        // if ($this->session->userdata('level') > 2) { 
        //     redirect('auth');
        // }
        $this->load->model('Statistics_model');
    }

    public function index()
    {
        $data['title'] = 'Platform Statistics & Analysis';
        $data['description'] = 'An in-depth and comprehensive look at platform-wide statistics, growth, and user engagement.';

        // Load data from the model
        $data['total_users'] = $this->Statistics_model->get_total_users();
        $data['total_revenue'] = $this->Statistics_model->get_total_revenue();
        $data['total_premium_enrollments'] = $this->Statistics_model->get_total_premium_enrollments();
        $data['total_free_enrollments'] = $this->Statistics_model->get_total_free_enrollments();

        // Get user growth data for the chart
        $user_growth = $this->Statistics_model->get_user_growth_data(30);
        $data['chart_labels'] = json_encode(array_column($user_growth, 'date'));
        $data['chart_data'] = json_encode(array_column($user_growth, 'count'));

        // Revenue trend (last 30 days)
        $rev_rows = $this->Statistics_model->get_revenue_trend(30);
        $data['rev_labels'] = json_encode(array_column($rev_rows, 'date'));
        $data['rev_values'] = json_encode(array_map('floatval', array_column($rev_rows, 'total')));

        // Enrollments trend (premium vs free) aligned by date
        $prem_rows = $this->Statistics_model->get_premium_enrollments_trend(30);
        $free_rows = $this->Statistics_model->get_free_enrollments_trend(30);

        // Build unified date set
        $dates = [];
        foreach ($prem_rows as $r) { $dates[$r['date']] = true; }
        foreach ($free_rows as $r) { $dates[$r['date']] = true; }
        $dates = array_keys($dates);
        sort($dates);

        $prem_map = [];
        foreach ($prem_rows as $r) { $prem_map[$r['date']] = (int)$r['count']; }
        $free_map = [];
        foreach ($free_rows as $r) { $free_map[$r['date']] = (int)$r['count']; }

        $prem_vals = [];
        $free_vals = [];
        foreach ($dates as $d) {
            $prem_vals[] = isset($prem_map[$d]) ? $prem_map[$d] : 0;
            $free_vals[] = isset($free_map[$d]) ? $free_map[$d] : 0;
        }

        $data['enroll_labels'] = json_encode($dates);
        $data['enroll_premium'] = json_encode($prem_vals);
        $data['enroll_free'] = json_encode($free_vals);

        // Payment status distribution
        $status_rows = $this->Statistics_model->get_payment_status_distribution();
        $status_labels = array_column($status_rows, 'status');
        $status_values = array_map('intval', array_column($status_rows, 'count'));
        $data['pay_status_labels'] = json_encode($status_labels);
        $data['pay_status_values'] = json_encode($status_values);

        // Additional statistics data
        $data['jurusan_dist'] = $this->Statistics_model->get_student_jurusan_distribution();
        $data['attendance_stats'] = $this->Statistics_model->get_attendance_statistics();
        $data['revenue_by_method'] = $this->Statistics_model->get_revenue_by_payment_method();
        $data['class_levels'] = $this->Statistics_model->get_class_level_distribution();
        $data['workshop_stats'] = $this->Statistics_model->get_workshop_statistics();
        $data['assignment_stats'] = $this->Statistics_model->get_assignment_statistics();
        $data['forum_stats'] = $this->Statistics_model->get_forum_statistics();
        $data['user_roles'] = $this->Statistics_model->get_user_role_distribution();
        $data['top_classes'] = $this->Statistics_model->get_top_classes_by_enrollment();
        $data['monthly_revenue'] = $this->Statistics_model->get_monthly_revenue_comparison();
        $data['teacher_workload'] = $this->Statistics_model->get_teacher_workload();
        $data['enrollment_comparison'] = $this->Statistics_model->get_enrollment_comparison();
        $data['daily_activity'] = $this->Statistics_model->get_daily_activity_stats();

        $this->load->view('admin/statistics/index', $data);
    }
}
