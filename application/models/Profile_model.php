<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profile_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Get student profile by user ID
     * 
     * @param int $user_id
     * @return object
     */
    public function get_student_profile_by_user_id($user_id)
    {
        $this->db->select('s.*, u.username, u.email as user_email, u.role, u.level, u.status as user_status, u.last_login');
        $this->db->from('users u');
        $this->db->join('siswa s', 's.email = u.email', 'left');
        $this->db->where('u.id', $user_id);
        return $this->db->get()->row();
    }
    
    /**
     * Get student profile by email
     * 
     * @param string $email
     * @return object
     */
    public function get_student_profile_by_email($email)
    {
        $this->db->where('email', $email);
        return $this->db->get('siswa')->row();
    }
    
    /**
     * Check if student profile exists
     * 
     * @param int $user_id
     * @return bool
     */
    public function student_profile_exists($user_id)
    {
        $this->db->select('u.id, s.id as siswa_id');
        $this->db->from('users u');
        $this->db->join('siswa s', 's.email = u.email', 'left');
        $this->db->where('u.id', $user_id);
        $result = $this->db->get()->row();
        
        return isset($result->siswa_id) && !is_null($result->siswa_id);
    }
    
    /**
     * Create student profile
     * 
     * @param array $data
     * @return bool
     */
    public function create_student_profile($data)
    {
        return $this->db->insert('siswa', $data);
    }
    
    /**
     * Update student profile
     * 
     * @param int $siswa_id
     * @param array $data
     * @return bool
     */
    public function update_student_profile($siswa_id, $data)
    {
        $this->db->where('id', $siswa_id);
        return $this->db->update('siswa', $data);
    }
    
    /**
     * Update student profile by email
     * 
     * @param string $email
     * @param array $data
     * @return bool
     */
    public function update_student_profile_by_email($email, $data)
    {
        $this->db->where('email', $email);
        return $this->db->update('siswa', $data);
    }
    
    /**
     * Get available classes
     * 
     * @return array
     */
    public function get_available_classes()
    {
        $this->db->where('status', 'Aktif');
        return $this->db->get('kelas_programming')->result();
    }
    
    /**
     * Get class by name
     * 
     * @param string $class_name
     * @return object
     */
    public function get_class_by_name($class_name)
    {
        $this->db->where('nama_kelas', $class_name);
        return $this->db->get('kelas_programming')->row();
    }
    
    /**
     * Get classmates
     * 
     * @param string $kelas
     * @param int $exclude_id
     * @param int $limit
     * @return array
     */
    public function get_classmates($kelas, $exclude_id = null, $limit = null)
    {
        $this->db->where('kelas', $kelas);
        $this->db->where('status', 'Aktif');
        
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        
        if ($limit) {
            $this->db->limit($limit);
        }
        
        return $this->db->get('siswa')->result();
    }
    
    /**
     * Count classmates
     * 
     * @param string $kelas
     * @return int
     */
    public function count_classmates($kelas)
    {
        $this->db->where('kelas', $kelas);
        $this->db->where('status', 'Aktif');
        return $this->db->count_all_results('siswa');
    }
    
    /**
     * Count classes assigned to a teacher
     * 
     * @param int $teacher_id
     * @return int
     */
    public function count_teacher_classes($teacher_id)
    {
        $this->db->where('guru_id', $teacher_id);
        $this->db->where('status', 'Aktif');
        return $this->db->count_all_results('guru_kelas');
    }
}
