<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_jadwal_by_kelas($kelas_id, $class_type = null)
    {
        $this->db->where('kelas_id', $kelas_id);

        // Jika class_type dispesifikkan, filter berdasarkan class_type
        if ($class_type !== null) {
            $this->db->where('class_type', $class_type);
        }

        $this->db->order_by('tanggal_pertemuan', 'ASC');
        $this->db->order_by('waktu_mulai', 'ASC');
        return $this->db->get('jadwal_kelas')->result();
    }

    // Method khusus untuk mendapatkan jadwal free classes berdasarkan class_id
    public function get_free_class_jadwal($class_id)
    {
        // Query dengan join untuk memastikan hanya jadwal yang valid untuk free classes
        $this->db->select('jk.*');
        $this->db->from('jadwal_kelas jk');
        $this->db->join('free_classes fc', 'jk.kelas_id = fc.id', 'inner');
        $this->db->where('jk.kelas_id', $class_id);
        $this->db->where('jk.class_type IS NOT NULL');
        $this->db->where('jk.class_type', 'gratis');
        $this->db->where('jk.guru_id IS NOT NULL');
        $this->db->where('fc.status', 'Published'); // Pastikan free class masih published
        $this->db->order_by('jk.tanggal_pertemuan', 'ASC');
        $this->db->order_by('jk.waktu_mulai', 'ASC');

        return $this->db->get()->result();
    }
    public function get_jadwal_by_id($id)
    {
        return $this->db->get_where('jadwal_kelas_view', ['id' => $id])->row();
    }

    public function insert_jadwal($data)
    {
        // Validasi data sebelum insert
        if (empty($data['class_type']) || empty($data['guru_id'])) {
            return false; // Tidak boleh null
        }

        $this->db->insert('jadwal_kelas', $data);
        return $this->db->insert_id();
    }

    public function update_jadwal($id, $data)
    {
        // Validasi data sebelum update
        if (isset($data['class_type']) && empty($data['class_type'])) {
            return false; // class_type tidak boleh kosong jika diset
        }
        if (isset($data['guru_id']) && empty($data['guru_id'])) {
            return false; // guru_id tidak boleh kosong jika diset
        }

        $this->db->where('id', $id);
        return $this->db->update('jadwal_kelas', $data);
    }

    public function get_all_jadwal()
    {
        return $this->db->get('jadwal_kelas_view')->result();
    }

    public function get_classes_by_teacher($teacher_id)
    {
        $classes = [];
        
        // Get premium classes
        $premium_classes = $this->db->get_where('kelas_programming', ['status' => 'Aktif'])->result();
        foreach ($premium_classes as $class) {
            $class->class_type = 'premium';
            $classes[] = $class;
        }
        
        // Get free classes
        $free_classes = $this->db->get_where('free_classes', ['status' => 'Published'])->result();
        foreach ($free_classes as $class) {
            $class->class_type = 'gratis';
            $classes[] = $class;
        }
        
        return $classes;
    }

}

/* End of file Jadwal_model.php */
