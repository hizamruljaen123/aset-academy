<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assignment_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    //======================================================================
    // ASSIGNMENT METHODS (for Teachers/Admins)
    //======================================================================

    public function create_assignment($data)
    {
        $this->db->insert('assignments', $data);
        return $this->db->insert_id();
    }

    public function get_assignments_by_class($class_id, $class_type)
    {
        return $this->db->get_where('assignments', ['class_id' => $class_id, 'class_type' => $class_type])->result();
    }

    public function get_assignment($assignment_id)
    {
        $assignment = $this->db->get_where('assignments', ['id' => $assignment_id])->row();
        
        if ($assignment) {
            if ($assignment->class_type == 'premium') {
                $class = $this->db->select('nama_kelas')->get_where('kelas_programming', ['id' => $assignment->class_id])->row();
            } else {
                $class = $this->db->select('title as nama_kelas')->get_where('free_classes', ['id' => $assignment->class_id])->row();
            }
            $assignment->class_name = $class ? $class->nama_kelas : 'Kelas Dihapus';
            $assignment->teacher_name = $this->db->select('nama_lengkap')->get_where('users', ['id' => $assignment->teacher_id])->row()->nama_lengkap ?? 'Guru Tidak Diketahui';
        }
        
        return $assignment;
    }

    public function update_assignment($assignment_id, $data)
    {
        $this->db->where('id', $assignment_id);
        return $this->db->update('assignments', $data);
    }

    public function delete_assignment($assignment_id)
    {
        return $this->db->delete('assignments', ['id' => $assignment_id]);
    }

    public function publish_grades($assignment_id)
    {
        $this->db->where('id', $assignment_id);
        return $this->db->update('assignments', ['grades_published' => 1]);
    }

    //======================================================================
    // SUBMISSION METHODS (for Students/Teachers)
    //======================================================================

    public function create_submission($data)
    {
        $this->db->insert('student_submissions', $data);
        return $this->db->insert_id();
    }

    public function get_submissions_by_assignment($assignment_id)
    {
        $this->db->select('ss.*, u.nama_lengkap, u.username');
        $this->db->from('student_submissions ss');
        $this->db->join('users u', 'ss.student_id = u.id');
        $this->db->where('ss.assignment_id', $assignment_id);
        return $this->db->get()->result();
    }

    public function get_submission($student_id, $assignment_id)
    {
        return $this->db->get_where('student_submissions', ['student_id' => $student_id, 'assignment_id' => $assignment_id])->row();
    }

    public function grade_submission($submission_id, $data)
    {
        $this->db->where('id', $submission_id);
        return $this->db->update('student_submissions', $data);
    }
    
    public function get_student_grades($student_id)
    {
        $this->db->select('ss.grade, ss.feedback, a.title as assignment_title, a.grades_published');
        $this->db->from('student_submissions ss');
        $this->db->join('assignments a', 'ss.assignment_id = a.id');
        $this->db->where('ss.student_id', $student_id);
        $this->db->where('a.grades_published', 1);
        return $this->db->get()->result();
    }

    //======================================================================
    // ADMIN METHODS
    //======================================================================

    public function get_all_assignments()
    {
        $this->db->select('a.*, t.nama_lengkap as teacher_name');
        $this->db->from('assignments a');
        $this->db->join('users t', 'a.teacher_id = t.id');
        $this->db->order_by('a.created_at', 'DESC');
        $query = $this->db->get();
        $assignments = $query->result();

        // Manually fetch class names since they are in different tables
        foreach ($assignments as $assignment) {
            if ($assignment->class_type == 'premium') {
                $class = $this->db->select('nama_kelas')->get_where('kelas_programming', ['id' => $assignment->class_id])->row();
            } else {
                $class = $this->db->select('title as nama_kelas')->get_where('free_classes', ['id' => $assignment->class_id])->row();
            }
            $assignment->class_name = $class ? $class->nama_kelas : 'Kelas Dihapus';
        }

        return $assignments;
    }

    public function get_all_teachers()
    {
        $this->db->select('id, nama_lengkap');
        $this->db->from('users');
        $this->db->where('role', 'guru');
        $this->db->where('status', 'Aktif');
        $this->db->order_by('nama_lengkap', 'ASC');
        return $this->db->get()->result();
    }

    public function get_submissions($assignment_id)
    {
        $this->db->select('ss.*, u.nama_lengkap as student_name, u.email as student_email, ss.submission_file as file_name, ss.submission_content as content, ss.status as submission_status');
        $this->db->from('student_submissions ss');
        $this->db->join('users u', 'ss.student_id = u.id');
        $this->db->where('ss.assignment_id', $assignment_id);
        $this->db->order_by('ss.submitted_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_class_student_count($class_id, $class_type)
    {
        if ($class_type == 'premium') {
            // Count students enrolled in premium class
            $this->db->from('premium_class_enrollments');
            $this->db->where('class_id', $class_id);
            $this->db->where_in('status', ['Active', 'Pending']);
            return $this->db->count_all_results();
        } else {
            // Count students enrolled in free class
            $this->db->from('free_class_enrollments');
            $this->db->where('class_id', $class_id);
            $this->db->where_in('status', ['Enrolled', 'Completed']);
            return $this->db->count_all_results();
        }
    }
}
