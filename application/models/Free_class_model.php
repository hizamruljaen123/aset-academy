<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Free_class_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Get all free classes
     * 
     * @param string $status Filter by status (optional)
     * @return array
     */
    public function get_all_free_classes($status = null)
    {
        $this->db->select('fc.*, u.nama_lengkap as mentor_name');
        $this->db->from('free_classes fc');
        $this->db->join('users u', 'fc.mentor_id = u.id', 'left');
        
        if ($status) {
            $this->db->where('fc.status', $status);
        }
        
        $this->db->order_by('fc.created_at', 'DESC');
        return $this->db->get()->result();
    }
    
    /**
     * Get free class by ID
     * 
     * @param int $id
     * @return object
     */
    public function get_free_class_by_id($id)
    {
        $this->db->select('fc.*, u.nama_lengkap as mentor_name');
        $this->db->from('free_classes fc');
        $this->db->join('users u', 'fc.mentor_id = u.id', 'left');
        $this->db->where('fc.id', $id);
        return $this->db->get()->row();
    }
    
    /**
     * Create new free class
     * 
     * @param array $data
     * @return int Inserted ID
     */
    public function create_free_class($data)
    {
        $this->db->insert('free_classes', $data);
        return $this->db->insert_id();
    }
    
    /**
     * Update free class
     * 
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update_free_class($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('free_classes', $data);
    }
    
    /**
     * Delete free class
     * 
     * @param int $id
     * @return bool
     */
    public function delete_free_class($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('free_classes');
    }
    
    /**
     * Get free classes by mentor ID
     * 
     * @param int $mentor_id
     * @param string $status Filter by status (optional)
     * @return array
     */
    public function get_free_classes_by_mentor($mentor_id, $status = null)
    {
        $this->db->select('fc.*, u.nama_lengkap as mentor_name');
        $this->db->from('free_classes fc');
        $this->db->join('users u', 'fc.mentor_id = u.id', 'left');
        $this->db->where('fc.mentor_id', $mentor_id);
        
        if ($status) {
            $this->db->where('fc.status', $status);
        }
        
        $this->db->order_by('fc.created_at', 'DESC');
        return $this->db->get()->result();
    }
    
    /**
     * Get free class materials
     * 
     * @param int $class_id
     * @return array
     */
    public function get_free_class_materials($class_id)
    {
        $this->db->where('class_id', $class_id);
        $this->db->order_by('order', 'ASC');
        return $this->db->get('free_class_materials')->result();
    }
    
    /**
     * Get free class material by ID
     * 
     * @param int $material_id
     * @return object
     */
    public function get_free_class_material_by_id($material_id)
    {
        $this->db->where('id', $material_id);
        return $this->db->get('free_class_materials')->row();
    }
    
    /**
     * Create free class material
     * 
     * @param array $data
     * @return int Inserted ID
     */
    public function create_free_class_material($data)
    {
        $this->db->insert('free_class_materials', $data);
        return $this->db->insert_id();
    }
    
    /**
     * Update free class material
     * 
     * @param int $material_id
     * @param array $data
     * @return bool
     */
    public function update_free_class_material($material_id, $data)
    {
        $this->db->where('id', $material_id);
        return $this->db->update('free_class_materials', $data);
    }
    
    /**
     * Delete free class material
     * 
     * @param int $material_id
     * @return bool
     */
    public function delete_free_class_material($material_id)
    {
        $this->db->where('id', $material_id);
        return $this->db->delete('free_class_materials');
    }
    
    /**
     * Count enrolled students in a free class
     * 
     * @param int $class_id
     * @return int
     */
    public function count_enrolled_students($class_id)
    {
        $this->db->where('class_id', $class_id);
        $this->db->where('status', 'Enrolled');
        return $this->db->count_all_results('free_class_enrollments');
    }
    
    /**
     * Get free class discussions
     * 
     * @param int $class_id
     * @param int $parent_id Parent discussion ID (null for top-level discussions)
     * @return array
     */
    public function get_free_class_discussions($class_id, $parent_id = null)
    {
        $this->db->select('d.*, u.nama_lengkap, u.role');
        $this->db->from('free_class_discussions d');
        $this->db->join('users u', 'd.user_id = u.id', 'left');
        $this->db->where('d.class_id', $class_id);
        
        if ($parent_id === null) {
            $this->db->where('d.parent_id IS NULL');
        } else {
            $this->db->where('d.parent_id', $parent_id);
        }
        
        $this->db->order_by('d.created_at', 'ASC');
        return $this->db->get()->result();
    }
    
    /**
     * Create free class discussion
     * 
     * @param array $data
     * @return int Inserted ID
     */
    public function create_free_class_discussion($data)
    {
        $this->db->insert('free_class_discussions', $data);
        return $this->db->insert_id();
    }
    
    /**
     * Get popular free classes
     * 
     * @param int $limit
     * @return array
     */
    public function get_popular_free_classes($limit = 5)
    {
        $this->db->select('fc.*, u.nama_lengkap as mentor_name, COUNT(fce.id) as enrollment_count');
        $this->db->from('free_classes fc');
        $this->db->join('users u', 'fc.mentor_id = u.id', 'left');
        $this->db->join('free_class_enrollments fce', 'fc.id = fce.class_id', 'left');
        $this->db->where('fc.status', 'Published');
        $this->db->group_by('fc.id');
        $this->db->order_by('enrollment_count', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
    
    /**
     * Get recent free classes
     * 
     * @param int $limit
     * @return array
     */
    public function get_recent_free_classes($limit = 5)
    {
        $this->db->select('fc.*, u.nama_lengkap as mentor_name');
        $this->db->from('free_classes fc');
        $this->db->join('users u', 'fc.mentor_id = u.id', 'left');
        $this->db->where('fc.status', 'Published');
        $this->db->order_by('fc.created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
    
    /**
     * Search free classes
     * 
     * @param string $keyword
     * @param string $category
     * @param string $level
     * @return array
     */
    public function search_free_classes($keyword = null, $category = null, $level = null)
    {
        $this->db->select('fc.*, u.nama_lengkap as mentor_name');
        $this->db->from('free_classes fc');
        $this->db->join('users u', 'fc.mentor_id = u.id', 'left');
        $this->db->where('fc.status', 'Published');
        
        if ($keyword) {
            $this->db->group_start();
            $this->db->like('fc.title', $keyword);
            $this->db->or_like('fc.description', $keyword);
            $this->db->group_end();
        }
        
        if ($category) {
            $this->db->where('fc.category', $category);
        }
        
        if ($level) {
            $this->db->where('fc.level', $level);
        }
        
        $this->db->order_by('fc.created_at', 'DESC');
        return $this->db->get()->result();
    }
    
    /**
     * Get available categories
     * 
     * @return array
     */
    public function get_categories()
    {
        $this->db->distinct();
        $this->db->select('category');
        $this->db->from('free_classes');
        $this->db->where('status', 'Published');
        $this->db->order_by('category', 'ASC');
        
        $result = $this->db->get()->result();
        $categories = [];
        
        foreach ($result as $row) {
            $categories[] = $row->category;
        }
        
        return $categories;
    }
}
