<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Timezone Library
 *
 * Library untuk mengelola konversi zona waktu dan validasi waktu absensi
 */
class Timezone_lib
{
    protected $CI;

    // Default timezone server (WIB - UTC+7)
    private $server_timezone = 'Asia/Jakarta';

    // List timezone yang didukung
    private $supported_timezones = [
        'Asia/Jakarta' => 'WIB (UTC+7)',
        'Asia/Makassar' => 'WITA (UTC+8)',
        'Asia/Jayapura' => 'WIT (UTC+9)',
        'UTC' => 'UTC',
        'America/New_York' => 'EST (UTC-5)',
        'Europe/London' => 'GMT (UTC+0)',
        'Asia/Tokyo' => 'JST (UTC+9)',
        'Australia/Sydney' => 'AEDT (UTC+10)',
        'Asia/Shanghai' => 'CST (UTC+8)',
        'Asia/Kolkata' => 'IST (UTC+5:30)',
    ];

    public function __construct()
    {
        $this->CI =& get_instance();

        // Set default timezone
        date_default_timezone_set($this->server_timezone);
    }

    /**
     * Get current server time
     */
    public function get_server_time()
    {
        return new DateTime('now', new DateTimeZone($this->server_timezone));
    }

    /**
     * Convert time to user timezone
     */
    public function convert_to_user_timezone($datetime, $user_timezone = null)
    {
        if (!$user_timezone) {
            $user_timezone = $this->server_timezone;
        }

        try {
            $server_time = new DateTime($datetime, new DateTimeZone($this->server_timezone));
            $server_time->setTimezone(new DateTimeZone($user_timezone));
            return $server_time;
        } catch (Exception $e) {
            // Return original time if conversion fails
            return new DateTime($datetime);
        }
    }

    /**
     * Get user timezone (dapat dari session atau database)
     */
    public function get_user_timezone($user_id = null)
    {
        // Default to server timezone
        $timezone = $this->server_timezone;

        // Jika ada user_id, dapatkan timezone dari database atau session
        if ($user_id) {
            // Cek apakah ada field timezone di tabel users
            $user = $this->CI->db->select('timezone')->get_where('users', ['id' => $user_id])->row();
            if ($user && !empty($user->timezone)) {
                $timezone = $user->timezone;
            }
        }

        // Cek dari session
        $session_timezone = $this->CI->session->userdata('user_timezone');
        if ($session_timezone && array_key_exists($session_timezone, $this->supported_timezones)) {
            $timezone = $session_timezone;
        }

        return $timezone;
    }

    /**
     * Set user timezone
     */
    public function set_user_timezone($user_id, $timezone)
    {
        if (!array_key_exists($timezone, $this->supported_timezones)) {
            return false;
        }

        // Simpan ke database jika ada field timezone
        if ($this->CI->db->field_exists('timezone', 'users')) {
            $this->CI->db->where('id', $user_id);
            $this->CI->db->update('users', ['timezone' => $timezone]);
        }

        // Simpan ke session
        $this->CI->session->set_userdata('user_timezone', $timezone);

        return true;
    }

    /**
     * Check if current time is within attendance window
     */
    public function is_within_attendance_window($start_time, $end_time, $buffer_minutes = 15, $user_timezone = null)
    {
        if (!$user_timezone) {
            $user_timezone = $this->get_user_timezone();
        }

        $now = new DateTime('now', new DateTimeZone($user_timezone));

        // Parse start and end time
        try {
            $start = new DateTime($start_time, new DateTimeZone($user_timezone));
            $end = new DateTime($end_time, new DateTimeZone($user_timezone));

            // Add buffer time (before start and after end)
            $start_buffer = clone $start;
            $start_buffer->modify("-{$buffer_minutes} minutes");

            $end_buffer = clone $end;
            $end_buffer->modify("+{$buffer_minutes} minutes");

            // Check if current time is within attendance window
            return ($now >= $start_buffer && $now <= $end_buffer);

        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Check if attendance is allowed for a schedule
     */
    public function can_attend_schedule($jadwal, $user_id = null, $buffer_minutes = 15)
    {
        if (!$jadwal || !isset($jadwal->tanggal_pertemuan)) {
            return false;
        }

        $user_timezone = $this->get_user_timezone($user_id);

        // Create full datetime strings
        $start_datetime = $jadwal->tanggal_pertemuan . ' ' . $jadwal->waktu_mulai;
        $end_datetime = $jadwal->tanggal_pertemuan . ' ' . $jadwal->waktu_selesai;

        return $this->is_within_attendance_window($start_datetime, $end_datetime, $buffer_minutes, $user_timezone);
    }

    /**
     * Format time for display
     */
    public function format_time($datetime, $format = 'd M Y H:i', $user_timezone = null)
    {
        if (!$user_timezone) {
            $user_timezone = $this->get_user_timezone();
        }

        try {
            $time = new DateTime($datetime, new DateTimeZone($this->server_timezone));
            $time->setTimezone(new DateTimeZone($user_timezone));
            return $time->format($format);
        } catch (Exception $e) {
            return date($format, strtotime($datetime));
        }
    }

    /**
     * Get supported timezones
     */
    public function get_supported_timezones()
    {
        return $this->supported_timezones;
    }

    /**
     * Get timezone offset in hours
     */
    public function get_timezone_offset($timezone)
    {
        try {
            $tz = new DateTimeZone($timezone);
            $now = new DateTime('now', $tz);
            return $tz->getOffset($now) / 3600;
        } catch (Exception $e) {
            return 0;
        }
    }

    /**
     * Validate timezone
     */
    public function is_valid_timezone($timezone)
    {
        return array_key_exists($timezone, $this->supported_timezones);
    }

    /**
     * Get attendance status based on time
     */
    public function get_attendance_status($jadwal, $user_id = null)
    {
        if (!$this->can_attend_schedule($jadwal, $user_id)) {
            $user_timezone = $this->get_user_timezone($user_id);
            $now = new DateTime('now', new DateTimeZone($user_timezone));
            $schedule_end = new DateTime($jadwal->tanggal_pertemuan . ' ' . $jadwal->waktu_selesai, new DateTimeZone($user_timezone));

            if ($now > $schedule_end) {
                return 'late'; // Terlambat
            } else {
                return 'early'; // Belum waktunya
            }
        }

        return 'available'; // Bisa absen
    }

    /**
     * Check if student has already attended
     */
    public function has_student_attended($jadwal_id, $student_id)
    {
        $this->CI->db->where('jadwal_id', $jadwal_id);
        $this->CI->db->where('siswa_id', $student_id);
        $result = $this->CI->db->get('absensi');

        return $result->num_rows() > 0;
    }

    /**
     * Get attendance record
     */
    public function get_student_attendance($jadwal_id, $student_id)
    {
        $this->CI->db->where('jadwal_id', $jadwal_id);
        $this->CI->db->where('siswa_id', $student_id);
        return $this->CI->db->get('absensi')->row();
    }

    /**
     * Get all attendance dates for a student (for calendar)
     */
    public function get_student_attendance_dates($student_id)
    {
        $this->CI->db->select('DATE(jk.tanggal_pertemuan) as date, a.status');
        $this->CI->db->from('absensi a');
        $this->CI->db->join('jadwal_kelas jk', 'a.jadwal_id = jk.id');
        $this->CI->db->where('a.siswa_id', $student_id);
        $this->CI->db->order_by('jk.tanggal_pertemuan', 'ASC');
        $query = $this->CI->db->get();
        $results = $query->result_array();

        $dates = [];
        foreach ($results as $row) {
            $dates[] = [
                'date' => $row['date'],
                'status' => $row['status']
            ];
        }

        return $dates;
    }
}
