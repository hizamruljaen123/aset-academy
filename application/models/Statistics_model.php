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

    public function get_class_distribution()
    {
        $distribution = [];

        $premiumStatuses = $this->db->select('status, COUNT(*) as total')
            ->from('kelas_programming')
            ->group_by('status')
            ->get()
            ->result_array();

        foreach ($premiumStatuses as $row) {
            $distribution[] = [
                'label' => 'Premium - ' . ($row['status'] ?? 'Unknown'),
                'value' => (int) ($row['total'] ?? 0)
            ];
        }

        $freeStatuses = $this->db->select('status, COUNT(*) as total')
            ->from('free_classes')
            ->group_by('status')
            ->get()
            ->result_array();

        foreach ($freeStatuses as $row) {
            $distribution[] = [
                'label' => 'Gratis - ' . ($row['status'] ?? 'Unknown'),
                'value' => (int) ($row['total'] ?? 0)
            ];
        }

        if (empty($distribution)) {
            $distribution[] = [
                'label' => 'Tidak ada data',
                'value' => 0
            ];
        }

        return $distribution;
    }

    // New statistics methods
    public function get_student_jurusan_distribution()
    {
        $this->db->select('jurusan, COUNT(*) as total');
        $this->db->from('siswa');
        $this->db->where('status', 'Aktif');
        $this->db->group_by('jurusan');
        $this->db->order_by('total', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_attendance_statistics()
    {
        $this->db->select('status, COUNT(*) as total');
        $this->db->from('absensi');
        $this->db->group_by('status');
        return $this->db->get()->result_array();
    }

    public function get_revenue_by_payment_method()
    {
        $this->db->select('payment_method, SUM(amount) as total, COUNT(*) as count');
        $this->db->from('payments');
        $this->db->where('status', 'Verified');
        $this->db->group_by('payment_method');
        return $this->db->get()->result_array();
    }

    public function get_class_level_distribution()
    {
        $distribution = [];
        
        // Premium classes
        $premium = $this->db->select('level, COUNT(*) as total')
            ->from('kelas_programming')
            ->where('status', 'Aktif')
            ->group_by('level')
            ->get()
            ->result_array();
        
        foreach ($premium as $row) {
            $key = 'Premium - ' . $row['level'];
            $distribution[$key] = isset($distribution[$key]) ? $distribution[$key] + (int)$row['total'] : (int)$row['total'];
        }
        
        // Free classes
        $free = $this->db->select('level, COUNT(*) as total')
            ->from('free_classes')
            ->where('status', 'Published')
            ->group_by('level')
            ->get()
            ->result_array();
        
        foreach ($free as $row) {
            $key = 'Gratis - ' . $row['level'];
            $distribution[$key] = isset($distribution[$key]) ? $distribution[$key] + (int)$row['total'] : (int)$row['total'];
        }
        
        return $distribution;
    }

    public function get_workshop_statistics()
    {
        $stats = [];
        
        $stats['total_workshops'] = $this->db->count_all('workshops');
        $stats['published'] = $this->db->where('status', 'published')->count_all_results('workshops');
        $stats['completed'] = $this->db->where('status', 'completed')->count_all_results('workshops');
        $stats['total_participants'] = $this->db->count_all('workshop_participants');
        $stats['total_guests'] = $this->db->count_all('workshop_guests');
        
        return $stats;
    }

    public function get_assignment_statistics()
    {
        $stats = [];
        
        $stats['total_assignments'] = $this->db->count_all('assignments');
        $stats['total_submissions'] = $this->db->count_all('student_submissions');
        $stats['graded'] = $this->db->where('status', 'graded')->count_all_results('student_submissions');
        $stats['pending'] = $this->db->where('status', 'submitted')->count_all_results('student_submissions');
        
        // Calculate submission rate
        if ($stats['total_assignments'] > 0) {
            $stats['submission_rate'] = round(($stats['total_submissions'] / $stats['total_assignments']) * 100, 2);
        } else {
            $stats['submission_rate'] = 0;
        }
        
        return $stats;
    }

    public function get_forum_statistics()
    {
        $stats = [];
        
        $stats['total_threads'] = $this->db->count_all('forum_threads');
        $stats['total_posts'] = $this->db->count_all('forum_posts');
        $stats['total_likes'] = $this->db->count_all('forum_likes');
        $stats['pinned_threads'] = $this->db->where('is_pinned', 1)->count_all_results('forum_threads');
        
        // Get total views
        $this->db->select_sum('views');
        $query = $this->db->get('forum_threads');
        $stats['total_views'] = $query->row()->views ?? 0;
        
        return $stats;
    }

    public function get_user_role_distribution()
    {
        $this->db->select('role, COUNT(*) as total');
        $this->db->from('users');
        $this->db->where('status', 'Aktif');
        $this->db->group_by('role');
        return $this->db->get()->result_array();
    }

    public function get_top_classes_by_enrollment()
    {
        // Premium classes
        $this->db->select('kp.nama_kelas as class_name, COUNT(pce.id) as enrollments, "Premium" as type');
        $this->db->from('kelas_programming kp');
        $this->db->join('premium_class_enrollments pce', 'pce.class_id = kp.id', 'left');
        $this->db->group_by('kp.id');
        $this->db->order_by('enrollments', 'DESC');
        $this->db->limit(5);
        $premium = $this->db->get()->result_array();
        
        // Free classes
        $this->db->select('fc.title as class_name, COUNT(fce.id) as enrollments, "Gratis" as type');
        $this->db->from('free_classes fc');
        $this->db->join('free_class_enrollments fce', 'fce.class_id = fc.id', 'left');
        $this->db->group_by('fc.id');
        $this->db->order_by('enrollments', 'DESC');
        $this->db->limit(5);
        $free = $this->db->get()->result_array();
        
        return array_merge($premium, $free);
    }

    public function get_monthly_revenue_comparison($months = 6)
    {
        $this->db->select('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(amount) as total');
        $this->db->from('payments');
        $this->db->where('status', 'Verified');
        $this->db->where('created_at >=', date('Y-m-d', strtotime("-$months months")));
        $this->db->group_by('month');
        $this->db->order_by('month', 'ASC');
        return $this->db->get()->result_array();
    }

    public function get_teacher_workload()
    {
        $this->db->select('u.nama_lengkap as teacher_name, COUNT(DISTINCT gk.kelas_id) as total_classes, COUNT(jk.id) as total_schedules');
        $this->db->from('users u');
        $this->db->join('guru_kelas gk', 'gk.guru_id = u.id', 'left');
        $this->db->join('jadwal_kelas jk', 'jk.guru_id = u.id', 'left');
        $this->db->where('u.role', 'guru');
        $this->db->where('u.status', 'Aktif');
        $this->db->group_by('u.id');
        $this->db->order_by('total_classes', 'DESC');
        $this->db->limit(10);
        return $this->db->get()->result_array();
    }

    public function get_enrollment_comparison()
    {
        $data = [];
        
        // Premium enrollments by status
        $this->db->select('status, COUNT(*) as total');
        $this->db->from('premium_class_enrollments');
        $this->db->group_by('status');
        $premium = $this->db->get()->result_array();
        
        foreach ($premium as $row) {
            $data[] = [
                'type' => 'Premium',
                'status' => $row['status'],
                'total' => (int)$row['total']
            ];
        }
        
        // Free enrollments by status
        $this->db->select('status, COUNT(*) as total');
        $this->db->from('free_class_enrollments');
        $this->db->group_by('status');
        $free = $this->db->get()->result_array();
        
        foreach ($free as $row) {
            $data[] = [
                'type' => 'Gratis',
                'status' => $row['status'],
                'total' => (int)$row['total']
            ];
        }
        
        return $data;
    }

    public function get_daily_activity_stats($days = 7)
    {
        $stats = [];
        
        // New users per day
        $this->db->select('DATE(created_at) as date, COUNT(*) as count');
        $this->db->from('users');
        $this->db->where('created_at >=', date('Y-m-d', strtotime("-$days days")));
        $this->db->group_by('DATE(created_at)');
        $this->db->order_by('date', 'DESC');
        $stats['users'] = $this->db->get()->result_array();
        
        // New enrollments per day
        $this->db->select('DATE(enrollment_date) as date, COUNT(*) as count');
        $this->db->from('premium_class_enrollments');
        $this->db->where('enrollment_date >=', date('Y-m-d', strtotime("-$days days")));
        $this->db->group_by('DATE(enrollment_date)');
        $this->db->order_by('date', 'DESC');
        $stats['enrollments'] = $this->db->get()->result_array();
        
        return $stats;
    }

}
