<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Session_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Create or update session tracking when user logs in
     * 
     * @param string $session_id CI Session ID
     * @param int $user_id User ID
     * @param string $ip_address IP Address
     * @param string $user_agent User Agent
     * @return bool
     */
    public function track_user_session($session_id, $user_id, $ip_address, $user_agent) {
        $data = [
            'user_id' => $user_id,
            'user_agent' => $user_agent,
            'login_time' => date('Y-m-d H:i:s'),
            'last_activity_time' => date('Y-m-d H:i:s'),
            'is_active' => 1
        ];
        
        $this->db->where('id', $session_id);
        $this->db->update('ci_sessions', $data);
        
        return $this->db->affected_rows() > 0;
    }

    /**
     * Update session activity time
     * 
     * @param string $session_id CI Session ID
     * @return bool
     */
    public function update_session_activity($session_id) {
        $this->db->where('id', $session_id);
        $this->db->update('ci_sessions', [
            'last_activity_time' => date('Y-m-d H:i:s')
        ]);
        
        return $this->db->affected_rows() > 0;
    }

    /**
     * Log session to history when user logs out
     * 
     * @param string $session_id CI Session ID
     * @param string $logout_type Type of logout (manual, timeout, admin_force, system)
     * @return bool
     */
    public function log_session_logout($session_id, $logout_type = 'manual') {
        // Get session data
        $session = $this->db->get_where('ci_sessions', ['id' => $session_id])->row();
        
        if ($session && $session->user_id) {
            $duration = null;
            if ($session->login_time) {
                $login = strtotime($session->login_time);
                $logout = time();
                $duration = $logout - $login;
            }
            
            $log_data = [
                'session_id' => $session_id,
                'user_id' => $session->user_id,
                'ip_address' => $session->ip_address,
                'user_agent' => $session->user_agent,
                'login_time' => $session->login_time,
                'logout_time' => date('Y-m-d H:i:s'),
                'session_duration' => $duration,
                'logout_type' => $logout_type
            ];
            
            return $this->db->insert('session_logs', $log_data);
        }
        
        return false;
    }

    /**
     * Get all active sessions with user information
     * 
     * @return array
     */
    public function get_active_sessions() {
        $this->db->select('
            s.id as session_id,
            s.ip_address,
            s.timestamp as last_activity,
            s.user_id,
            s.user_agent,
            s.login_time,
            s.last_activity_time,
            s.is_active,
            u.username,
            u.nama_lengkap,
            u.email,
            u.role,
            u.foto_profil,
            CASE 
                WHEN TIMESTAMPDIFF(MINUTE, FROM_UNIXTIME(s.timestamp), NOW()) < 5 THEN "Active"
                WHEN TIMESTAMPDIFF(MINUTE, FROM_UNIXTIME(s.timestamp), NOW()) < 30 THEN "Idle"
                ELSE "Inactive"
            END as session_status,
            COALESCE(TIMESTAMPDIFF(MINUTE, s.login_time, NOW()), TIMESTAMPDIFF(MINUTE, FROM_UNIXTIME(s.timestamp), NOW())) as session_duration_minutes,
            FROM_UNIXTIME(s.timestamp) as last_activity_formatted,
            CASE
                WHEN COALESCE(s.user_agent, "") LIKE "%Mobile%" OR COALESCE(s.user_agent, "") LIKE "%Android%" OR COALESCE(s.user_agent, "") LIKE "%iPhone%" THEN "Mobile"
                ELSE "Desktop"
            END as platform,
            CASE
                WHEN COALESCE(s.user_agent, "") LIKE "%Windows%" THEN "Windows"
                WHEN COALESCE(s.user_agent, "") LIKE "%Mac%" THEN "Mac OS"
                WHEN COALESCE(s.user_agent, "") LIKE "%Linux%" THEN "Linux"
                WHEN COALESCE(s.user_agent, "") LIKE "%Android%" THEN "Android"
                WHEN COALESCE(s.user_agent, "") LIKE "%iPhone%" OR COALESCE(s.user_agent, "") LIKE "%iPad%" THEN "iOS"
                ELSE "Unknown"
            END as os,
            CASE
                WHEN COALESCE(s.user_agent, "") LIKE "%Chrome%" AND COALESCE(s.user_agent, "") NOT LIKE "%Edg%" THEN "Chrome"
                WHEN COALESCE(s.user_agent, "") LIKE "%Firefox%" THEN "Firefox"
                WHEN COALESCE(s.user_agent, "") LIKE "%Safari%" AND COALESCE(s.user_agent, "") NOT LIKE "%Chrome%" THEN "Safari"
                WHEN COALESCE(s.user_agent, "") LIKE "%Edg%" THEN "Edge"
                WHEN COALESCE(s.user_agent, "") LIKE "%Opera%" OR COALESCE(s.user_agent, "") LIKE "%OPR%" THEN "Opera"
                ELSE "Unknown"
            END as browser
        ');
        $this->db->from('ci_sessions s');
        $this->db->join('users u', 's.user_id = u.id', 'left');
        $this->db->where('s.is_active', 1);
        $this->db->order_by('s.timestamp', 'DESC');
        
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Get active sessions count by user
     * 
     * @return array
     */
    public function get_sessions_by_user() {
        $this->db->select('u.id as user_id, u.username, u.nama_lengkap, u.role, u.foto_profil, COUNT(s.id) as session_count, MAX(s.timestamp) as last_activity');
        $this->db->from('ci_sessions s');
        $this->db->join('users u', 's.user_id = u.id', 'left');
        $this->db->where('s.is_active', 1);
        $this->db->where('s.user_id IS NOT NULL');
        $this->db->group_by('s.user_id');
        $this->db->order_by('last_activity', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Get all unique IP addresses from ci_sessions table
     */
    public function get_unique_ips() {
        $this->db->select('s.ip_address, u.username, u.nama_lengkap, u.role, COUNT(*) as session_count, MAX(s.timestamp) as last_activity');
        $this->db->from('ci_sessions s');
        $this->db->join('users u', 's.user_id = u.id', 'left');
        $this->db->where('s.is_active', 1);
        $this->db->group_by('s.ip_address');
        $this->db->order_by('last_activity', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Get total number of unique IPs
     */
    public function get_unique_ip_count() {
        $this->db->select('COUNT(DISTINCT ip_address) as total_unique_ips');
        $this->db->where('is_active', 1);
        $query = $this->db->get('ci_sessions');
        $result = $query->row();
        return $result->total_unique_ips;
    }

    /**
     * Get total number of active sessions
     */
    public function get_total_sessions() {
        $this->db->select('COUNT(*) as total_sessions');
        $this->db->where('is_active', 1);
        $query = $this->db->get('ci_sessions');
        $result = $query->row();
        return $result->total_sessions;
    }

    /**
     * Get total logged in users
     */
    public function get_logged_in_users_count() {
        $this->db->select('COUNT(DISTINCT user_id) as total_users');
        $this->db->where('is_active', 1);
        $this->db->where('user_id IS NOT NULL');
        $query = $this->db->get('ci_sessions');
        $result = $query->row();
        return $result->total_users;
    }

    /**
     * Get total guest sessions (no user_id)
     */
    public function get_guest_sessions_count() {
        $this->db->select('COUNT(*) as total_guests');
        $this->db->where('is_active', 1);
        $this->db->where('user_id IS NULL');
        $query = $this->db->get('ci_sessions');
        $result = $query->row();
        return $result->total_guests;
    }

    /**
     * Delete all sessions from ci_sessions table
     */
    public function delete_all_sessions() {
        // Log all active sessions before deleting
        $this->db->query("
            INSERT INTO session_logs (session_id, user_id, ip_address, user_agent, login_time, logout_time, session_duration, logout_type)
            SELECT 
                id, user_id, ip_address, user_agent, login_time, NOW(), 
                TIMESTAMPDIFF(SECOND, login_time, NOW()), 'admin_force'
            FROM ci_sessions
            WHERE user_id IS NOT NULL AND login_time IS NOT NULL
        ");
        
        $this->db->empty_table('ci_sessions');
        return $this->db->affected_rows();
    }

    /**
     * Delete sessions for a specific IP address
     */
    public function delete_sessions_by_ip($ip_address) {
        // Log sessions before deleting
        $sessions = $this->db->get_where('ci_sessions', ['ip_address' => $ip_address])->result();
        foreach ($sessions as $session) {
            $this->log_session_logout($session->id, 'admin_force');
        }
        
        $this->db->where('ip_address', $ip_address);
        $this->db->delete('ci_sessions');
        return $this->db->affected_rows();
    }

    /**
     * Delete sessions for a specific user
     * 
     * @param int $user_id User ID
     * @return int Number of affected rows
     */
    public function delete_sessions_by_user($user_id) {
        // Log sessions before deleting
        $sessions = $this->db->get_where('ci_sessions', ['user_id' => $user_id])->result();
        foreach ($sessions as $session) {
            $this->log_session_logout($session->id, 'admin_force');
        }
        
        $this->db->where('user_id', $user_id);
        $this->db->delete('ci_sessions');
        return $this->db->affected_rows();
    }

    /**
     * Delete specific session by session ID
     * 
     * @param string $session_id Session ID
     * @return int Number of affected rows
     */
    public function delete_session_by_id($session_id) {
        // Log session before deleting
        $this->log_session_logout($session_id, 'admin_force');
        
        $this->db->where('id', $session_id);
        $this->db->delete('ci_sessions');
        return $this->db->affected_rows();
    }

    /**
     * Get session details for a specific IP
     */
    public function get_sessions_by_ip($ip_address) {
        $this->db->select('s.*, u.username, u.nama_lengkap, u.email, u.role, u.foto_profil');
        $this->db->from('ci_sessions s');
        $this->db->join('users u', 's.user_id = u.id', 'left');
        $this->db->where('s.ip_address', $ip_address);
        $this->db->where('s.is_active', 1);
        $this->db->order_by('s.timestamp', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Get session details for a specific user
     * 
     * @param int $user_id User ID
     * @return array
     */
    public function get_sessions_by_user_id($user_id) {
        $this->db->select('s.*, u.username, u.nama_lengkap, u.email, u.role');
        $this->db->from('ci_sessions s');
        $this->db->join('users u', 's.user_id = u.id', 'left');
        $this->db->where('s.user_id', $user_id);
        $this->db->where('s.is_active', 1);
        $this->db->order_by('s.timestamp', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Clean up expired sessions (older than specified hours)
     */
    public function cleanup_expired_sessions($hours = 24) {
        $expiry_time = time() - ($hours * 3600);
        
        // Log sessions before deleting
        $this->db->query("
            INSERT INTO session_logs (session_id, user_id, ip_address, user_agent, login_time, logout_time, session_duration, logout_type)
            SELECT 
                id, user_id, ip_address, user_agent, login_time, NOW(), 
                TIMESTAMPDIFF(SECOND, login_time, NOW()), 'timeout'
            FROM ci_sessions
            WHERE timestamp < ? AND user_id IS NOT NULL AND login_time IS NOT NULL
        ", [$expiry_time]);
        
        $this->db->where('timestamp <', $expiry_time);
        $this->db->delete('ci_sessions');
        return $this->db->affected_rows();
    }

    /**
     * Get session history logs
     * 
     * @param array $filters Filters for query
     * @param int $limit Limit
     * @param int $offset Offset
     * @return array
     */
    public function get_session_logs($filters = [], $limit = 50, $offset = 0) {
        $this->db->select('sl.*, u.username, u.nama_lengkap, u.email, u.role, u.foto_profil');
        $this->db->from('session_logs sl');
        $this->db->join('users u', 'sl.user_id = u.id', 'left');
        
        if (!empty($filters['user_id'])) {
            $this->db->where('sl.user_id', $filters['user_id']);
        }
        
        if (!empty($filters['ip_address'])) {
            $this->db->where('sl.ip_address', $filters['ip_address']);
        }
        
        if (!empty($filters['logout_type'])) {
            $this->db->where('sl.logout_type', $filters['logout_type']);
        }
        
        if (!empty($filters['date_from'])) {
            $this->db->where('sl.login_time >=', $filters['date_from']);
        }
        
        if (!empty($filters['date_to'])) {
            $this->db->where('sl.login_time <=', $filters['date_to']);
        }
        
        $this->db->order_by('sl.login_time', 'DESC');
        $this->db->limit($limit, $offset);
        
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Get unique IP statistics for regions
     * 
     * @return array
     */
    public function get_unique_ip_statistics() {
        $this->db->select('s.ip_address, u.username, u.nama_lengkap, u.role, u.email, COUNT(*) as session_count, MAX(s.timestamp) as last_activity, s.user_agent');
        $this->db->from('ci_sessions s');
        $this->db->join('users u', 's.user_id = u.id', 'left');
        $this->db->where('s.is_active', 1);
        $this->db->group_by('s.ip_address');
        $this->db->order_by('last_activity', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Get session statistics
     * 
     * @return object
     */
    public function get_session_statistics() {
        $stats = new stdClass();
        
        // Active sessions
        $stats->total_active_sessions = $this->get_total_sessions();
        $stats->logged_in_users = $this->get_logged_in_users_count();
        $stats->guest_sessions = $this->get_guest_sessions_count();
        $stats->unique_ips = $this->get_unique_ip_count();
        
        // Today's statistics
        $today_start = date('Y-m-d 00:00:00');
        $today_end = date('Y-m-d 23:59:59');
        
        $this->db->select('COUNT(*) as total');
        $this->db->where('login_time >=', $today_start);
        $this->db->where('login_time <=', $today_end);
        $query = $this->db->get('session_logs');
        $stats->today_logins = $query->row()->total;
        
        // Average session duration today
        $this->db->select('AVG(session_duration) as avg_duration');
        $this->db->where('login_time >=', $today_start);
        $this->db->where('login_time <=', $today_end);
        $this->db->where('session_duration IS NOT NULL');
        $query = $this->db->get('session_logs');
        $stats->avg_session_duration = round($query->row()->avg_duration / 60, 2); // in minutes
        
        // Most active users today
        $this->db->select('u.username, u.nama_lengkap, COUNT(*) as login_count');
        $this->db->from('session_logs sl');
        $this->db->join('users u', 'sl.user_id = u.id', 'left');
        $this->db->where('sl.login_time >=', $today_start);
        $this->db->where('sl.login_time <=', $today_end);
        $this->db->group_by('sl.user_id');
        $this->db->order_by('login_count', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        $stats->most_active_users = $query->result();
        
        return $stats;
    }
}
