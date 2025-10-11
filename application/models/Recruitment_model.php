<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recruitment_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * JOB POSITIONS
     */
    public function get_job_positions($filters = [], $limit = null, $offset = null)
    {
        if (!empty($filters['status'])) {
            $this->db->where('status', $filters['status']);
        }

        if (!empty($filters['department'])) {
            $this->db->where('department', $filters['department']);
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $this->db->group_start()
                ->like('title', $search)
                ->or_like('department', $search)
                ->or_like('location', $search)
                ->group_end();
        }

        if (!empty($filters['is_featured'])) {
            $this->db->where('is_featured', (int) $filters['is_featured']);
        }

        if (isset($filters['status_in']) && is_array($filters['status_in'])) {
            $this->db->where_in('status', $filters['status_in']);
        }

        if (!empty($filters['order_by']) && !empty($filters['order_dir'])) {
            $this->db->order_by($filters['order_by'], $filters['order_dir']);
        } else {
            $this->db->order_by('is_featured DESC', '', false);
            $this->db->order_by('CASE WHEN application_deadline IS NULL THEN 1 ELSE 0 END ASC', '', false);
            $this->db->order_by('application_deadline ASC', '', false);
            $this->db->order_by('created_at DESC', '', false);
        }

        if ($limit !== null) {
            $this->db->limit($limit, $offset);
        }

        return $this->db->get('job_positions')->result();
    }

    public function count_job_positions($filters = [])
    {
        if (!empty($filters['status'])) {
            $this->db->where('status', $filters['status']);
        }

        if (!empty($filters['department'])) {
            $this->db->where('department', $filters['department']);
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $this->db->group_start()
                ->like('title', $search)
                ->or_like('department', $search)
                ->or_like('location', $search)
                ->group_end();
        }

        if (!empty($filters['is_featured'])) {
            $this->db->where('is_featured', (int) $filters['is_featured']);
        }

        if (isset($filters['status_in']) && is_array($filters['status_in'])) {
            $this->db->where_in('status', $filters['status_in']);
        }

        return $this->db->count_all_results('job_positions');
    }

    public function get_job_position($id)
    {
        return $this->db->get_where('job_positions', ['id' => $id])->row();
    }

    public function get_job_position_by_slug($slug, $allowedStatuses = [])
    {
        $this->db->where('slug', $slug);

        if (!empty($allowedStatuses)) {
            $this->db->where_in('status', $allowedStatuses);
        } else {
            $this->db->where_in('status', ['Draft', 'Published', 'Closed', 'Archived']);
        }

        return $this->db->get('job_positions')->row();
    }

    public function create_job_position($data)
    {
        $this->db->insert('job_positions', $data);
        return $this->db->insert_id();
    }

    public function update_job_position($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('job_positions', $data);
    }

    public function delete_job_position($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('job_positions');
    }

    /**
     * JOB APPLICATIONS
     */
    public function get_job_applications($filters = [], $limit = null, $offset = null)
    {
        $this->db->select('ja.*, jp.title as job_title, jp.department as job_department, jp.employment_type, jp.application_deadline');
        $this->db->from('job_applications ja');
        $this->db->join('job_positions jp', 'jp.id = ja.job_position_id', 'left');

        if (!empty($filters['job_position_id'])) {
            $this->db->where('ja.job_position_id', $filters['job_position_id']);
        }

        if (!empty($filters['status'])) {
            $this->db->where('ja.status', $filters['status']);
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $this->db->group_start()
                ->like('ja.applicant_name', $search)
                ->or_like('ja.applicant_email', $search)
                ->or_like('ja.applicant_phone', $search)
                ->or_like('jp.title', $search)
                ->group_end();
        }

        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(ja.submitted_at) >=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(ja.submitted_at) <=', $filters['date_to']);
        }

        if (!empty($filters['order_by']) && !empty($filters['order_dir'])) {
            $this->db->order_by($filters['order_by'], $filters['order_dir']);
        } else {
            $this->db->order_by('ja.submitted_at', 'DESC');
        }

        if ($limit !== null) {
            $this->db->limit($limit, $offset);
        }

        return $this->db->get()->result();
    }

    public function count_job_applications($filters = [])
    {
        $this->db->from('job_applications');

        if (!empty($filters['job_position_id'])) {
            $this->db->where('job_position_id', $filters['job_position_id']);
        }

        if (!empty($filters['status'])) {
            $this->db->where('status', $filters['status']);
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $this->db->group_start()
                ->like('applicant_name', $search)
                ->or_like('applicant_email', $search)
                ->or_like('applicant_phone', $search)
                ->group_end();
        }

        if (!empty($filters['date_from'])) {
            $this->db->where('DATE(submitted_at) >=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $this->db->where('DATE(submitted_at) <=', $filters['date_to']);
        }

        return $this->db->count_all_results();
    }

    public function get_job_application($id)
    {
        $this->db->select('ja.*, jp.title as job_title, jp.department as job_department, jp.location as job_location, jp.employment_type, jp.salary_range, jp.description as job_description, jp.requirements as job_requirements, jp.responsibilities as job_responsibilities, jp.benefits as job_benefits');
        $this->db->from('job_applications ja');
        $this->db->join('job_positions jp', 'jp.id = ja.job_position_id', 'left');
        $this->db->where('ja.id', $id);
        return $this->db->get()->row();
    }

    public function get_job_application_by_email($job_position_id, $email)
    {
        return $this->db->get_where('job_applications', [
            'job_position_id' => $job_position_id,
            'applicant_email' => $email
        ])->row();
    }

    public function create_job_application($data)
    {
        $this->db->insert('job_applications', $data);
        return $this->db->insert_id();
    }

    public function update_job_application($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('job_applications', $data);
    }

    public function delete_job_application($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('job_applications');
    }

    /**
     * ATTACHMENTS
     */
    public function add_attachment($application_id, $data)
    {
        $data['application_id'] = $application_id;
        $this->db->insert('job_application_attachments', $data);
        return $this->db->insert_id();
    }

    public function get_attachments($application_id)
    {
        return $this->db->get_where('job_application_attachments', ['application_id' => $application_id])->result();
    }

    public function get_attachment($attachment_id)
    {
        return $this->db->get_where('job_application_attachments', ['id' => $attachment_id])->row();
    }

    public function delete_attachment($attachment_id)
    {
        $this->db->where('id', $attachment_id);
        return $this->db->delete('job_application_attachments');
    }

    /**
     * STATISTICS & HELPERS
     */
    public function get_recruitment_stats()
    {
        $stats = [];

        $stats['total_positions'] = $this->db->count_all('job_positions');

        $this->db->where('status', 'Published');
        $this->db->from('job_positions');
        $stats['published_positions'] = $this->db->count_all_results();

        $this->db->where('status', 'Closed');
        $this->db->from('job_positions');
        $stats['closed_positions'] = $this->db->count_all_results();

        $stats['total_applications'] = $this->db->count_all('job_applications');

        $this->db->where_in('status', ['Under Review', 'Interview Scheduled']);
        $this->db->from('job_applications');
        $stats['active_applications'] = $this->db->count_all_results();

        $this->db->order_by('submitted_at', 'DESC');
        $this->db->limit(6);
        $stats['recent_applications'] = $this->db->get('job_applications')->result();

        return $stats;
    }

    public function get_departments()
    {
        $this->db->select('DISTINCT(department) as department');
        $this->db->from('job_positions');
        $this->db->where('department !=', '');
        $this->db->order_by('department', 'ASC');
        $results = $this->db->get()->result();

        return array_map(function ($row) {
            return $row->department;
        }, $results);
    }

    public function get_job_positions_with_stats($filters = [], $limit = null, $offset = null)
    {
        $this->db->from('job_positions_view');

        if (!empty($filters['status'])) {
            $this->db->where('status', $filters['status']);
        }

        if (!empty($filters['status_in']) && is_array($filters['status_in'])) {
            $this->db->where_in('status', $filters['status_in']);
        }

        if (!empty($filters['department'])) {
            $this->db->where('department', $filters['department']);
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $this->db->group_start()
                ->like('title', $search)
                ->or_like('department', $search)
                ->or_like('location', $search)
                ->group_end();
        }

        if (!empty($filters['location'])) {
            $this->db->like('location', $filters['location']);
        }

        if (!empty($filters['employment_type'])) {
            $this->db->where('employment_type', $filters['employment_type']);
        }

        if (!empty($filters['experience_level'])) {
            $this->db->where('experience_level', $filters['experience_level']);
        }

        if (!empty($filters['is_featured'])) {
            $this->db->where('is_featured', (int) $filters['is_featured']);
        }

        if (!empty($filters['order_by']) && !empty($filters['order_dir'])) {
            $this->db->order_by($filters['order_by'], $filters['order_dir']);
        } else {
            $this->db->order_by('is_featured DESC', '', false);
            $this->db->order_by('CASE WHEN application_deadline IS NULL THEN 1 ELSE 0 END ASC', '', false);
            $this->db->order_by('application_deadline ASC', '', false);
            $this->db->order_by('created_at DESC', '', false);
        }

        if ($limit !== null) {
            $this->db->limit($limit, $offset);
        }

        return $this->db->get()->result();
    }

    public function get_provinces()
    {
        return $this->db->order_by('name', 'ASC')->get('reg_provinces')->result();
    }

    public function get_regencies($province_id)
    {
        if (!$province_id) {
            return [];
        }

        return $this->db->order_by('name', 'ASC')->get_where('reg_regencies', ['province_id' => $province_id])->result();
    }

    public function get_districts($regency_id)
    {
        if (!$regency_id) {
            return [];
        }

        return $this->db->order_by('name', 'ASC')->get_where('reg_districts', ['regency_id' => $regency_id])->result();
    }

    public function get_villages($district_id)
    {
        if (!$district_id) {
            return [];
        }

        return $this->db->order_by('name', 'ASC')->get_where('reg_villages', ['district_id' => $district_id])->result();
    }

    public function get_job_position_by_id($id)
    {
        return $this->db->get_where('job_positions', ['id' => $id])->row();
    }
}
