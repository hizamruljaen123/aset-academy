<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Session_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get all unique IP addresses from ci_sessions table
     */
    public function get_unique_ips() {
        $this->db->select('ip_address, COUNT(*) as session_count, MAX(timestamp) as last_activity');
        $this->db->from('ci_sessions');
        $this->db->group_by('ip_address');
        $this->db->order_by('last_activity', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Get total number of unique IPs
     */
    public function get_unique_ip_count() {
        $this->db->select('COUNT(DISTINCT ip_address) as total_unique_ips');
        $query = $this->db->get('ci_sessions');
        $result = $query->row();
        return $result->total_unique_ips;
    }

    /**
     * Get total number of sessions
     */
    public function get_total_sessions() {
        $this->db->select('COUNT(*) as total_sessions');
        $query = $this->db->get('ci_sessions');
        $result = $query->row();
        return $result->total_sessions;
    }

    /**
     * Delete all sessions from ci_sessions table
     */
    public function delete_all_sessions() {
        $this->db->empty_table('ci_sessions');
        return $this->db->affected_rows();
    }

    /**
     * Delete sessions for a specific IP address
     */
    public function delete_sessions_by_ip($ip_address) {
        $this->db->where('ip_address', $ip_address);
        $this->db->delete('ci_sessions');
        return $this->db->affected_rows();
    }

    /**
     * Get session details for a specific IP
     */
    public function get_sessions_by_ip($ip_address) {
        $this->db->select('*');
        $this->db->from('ci_sessions');
        $this->db->where('ip_address', $ip_address);
        $this->db->order_by('timestamp', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Clean up expired sessions (older than specified hours)
     */
    public function cleanup_expired_sessions($hours = 24) {
        $expiry_time = time() - ($hours * 3600);
        $this->db->where('timestamp <', $expiry_time);
        $this->db->delete('ci_sessions');
        return $this->db->affected_rows();
    }
}
