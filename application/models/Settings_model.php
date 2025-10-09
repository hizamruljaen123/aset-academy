<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get setting value by key
     */
    public function get_setting($key, $default = null)
    {
        $this->db->where('setting_key', $key);
        $query = $this->db->get('settings');

        if ($query->num_rows() > 0) {
            $setting = $query->row();
            return $this->_cast_value($setting->setting_value, $setting->setting_type);
        }

        return $default;
    }

    /**
     * Set setting value
     */
    public function set_setting($key, $value, $type = 'string', $description = '')
    {
        $data = [
            'setting_value' => $value,
            'setting_type' => $type,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if (!empty($description)) {
            $data['description'] = $description;
        }

        $this->db->where('setting_key', $key);
        $exists = $this->db->get('settings')->num_rows() > 0;

        if ($exists) {
            $this->db->where('setting_key', $key);
            return $this->db->update('settings', $data);
        } else {
            $data['setting_key'] = $key;
            return $this->db->insert('settings', $data);
        }
    }

    /**
     * Check if maintenance mode is enabled
     */
    public function is_maintenance_mode()
    {
        return $this->get_setting('maintenance_mode', false) === true;
    }

    /**
     * Enable maintenance mode
     */
    public function enable_maintenance_mode()
    {
        return $this->set_setting('maintenance_mode', 'true', 'boolean', 'Enable/disable maintenance mode for the website');
    }

    /**
     * Disable maintenance mode
     */
    public function disable_maintenance_mode()
    {
        return $this->set_setting('maintenance_mode', 'false', 'boolean', 'Enable/disable maintenance mode for the website');
    }

    /**
     * Get maintenance message
     */
    public function get_maintenance_message()
    {
        return $this->get_setting('maintenance_message', 'Website sedang dalam pemeliharaan. Kami akan segera kembali melayani Anda.');
    }

    /**
     * Set maintenance message
     */
    public function set_maintenance_message($message)
    {
        return $this->set_setting('maintenance_message', $message, 'string', 'Message to display during maintenance mode');
    }

    /**
     * Get all settings
     */
    public function get_all_settings()
    {
        $query = $this->db->get('settings');
        $settings = [];

        foreach ($query->result() as $setting) {
            $settings[$setting->setting_key] = [
                'value' => $this->_cast_value($setting->setting_value, $setting->setting_type),
                'type' => $setting->setting_type,
                'description' => $setting->description,
                'updated_at' => $setting->updated_at
            ];
        }

        return $settings;
    }

    /**
     * Cast value based on type
     */
    private function _cast_value($value, $type)
    {
        switch ($type) {
            case 'boolean':
                return filter_var($value, FILTER_VALIDATE_BOOLEAN);
            case 'integer':
                return (int) $value;
            case 'json':
                return json_decode($value, true);
            default:
                return $value;
        }
    }
}
