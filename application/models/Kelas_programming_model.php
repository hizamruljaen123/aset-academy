<?php
class Kelas_programming_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_premium_classes($student_id) {
        $this->db->select('kp.*');
        $this->db->from('kelas_programming kp');
        $this->db->where('kp.harga >', 0);
        $this->db->where_in('kp.status', ['Aktif', 'Coming Soon']);

        // Exclude already purchased classes
        $this->db->join('payments p', "kp.id = p.class_id AND p.user_id = $student_id AND p.status = 'Verified'", 'left');
        $this->db->where('p.id IS NULL');

        return $this->db->get()->result();
    }

    public function get_kelas_by_id($id) {
        return $this->db->where('id', $id)->get('kelas_programming')->row();
    }

    public function count_siswa($id) {
        return $this->db->where('class_id', $id)->from('payments')->where('status', 'Verified')->count_all_results();
    }

    public function get_average_rating($id)
    {
        // Karena tabel testimonials tidak terkait dengan kelas, kembalikan nilai default
        return 4.5; // Nilai default atau bisa diambil dari cache/config
    }

    public function get_all_premium_classes() {
        $this->db->select('kp.*');
        $this->db->from('kelas_programming kp');
        $this->db->where('kp.harga >', 0);
        $this->db->where_in('kp.status', ['Aktif', 'Coming Soon']);
        $this->db->order_by('kp.created_at', 'DESC');
        return $this->db->get()->result();
    }
}
