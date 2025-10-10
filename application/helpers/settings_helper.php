<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('get_setting')) {
    /**
     * Get a setting value by key
     *
     * @param string $key Setting key
     * @param mixed $default Default value if setting not found
     * @return mixed Setting value or default
     */
    function get_setting($key, $default = null) {
        $CI =& get_instance();
        
        // Check if settings table exists to prevent errors during installation
        if (!$CI->db->table_exists('settings')) {
            return $default;
        }
        
        try {
            $setting = $CI->db->where('setting_key', $key)->get('settings')->row();
            
            if (!empty($setting) && isset($setting->value)) {
                // If type is not set, return as string
                if (!isset($setting->type)) {
                    return $setting->value;
                }
                
                // Handle different setting types
                switch (strtolower($setting->type)) {
                    case 'boolean':
                    case 'bool':
                        return (bool)$setting->value;
                    case 'integer':
                    case 'int':
                        return (int)$setting->value;
                    case 'float':
                        return (float)$setting->value;
                    case 'json':
                    case 'array':
                        return json_decode($setting->value, true);
                    default:
                        return $setting->value;
                }
            }
        } catch (Exception $e) {
            log_message('error', 'Error in get_setting: ' . $e->getMessage());
        }
        
        return $default;
    }
}

if (!function_exists('set_setting')) {
    /**
     * Set a setting value
     *
     * @param string $key Setting key
     * @param mixed $value Setting value
     * @param string $type Data type (string, boolean, integer, float, json)
     * @return bool Success status
     */
    function set_setting($key, $value, $type = 'string') {
        $CI =& get_instance();
        
        // Convert value based on type
        $value_to_store = $value;
        
        if ($type === 'boolean' || $type === 'bool') {
            $value_to_store = $value ? '1' : '0';
        } elseif ($type === 'integer' || $type === 'int') {
            $value_to_store = (int)$value;
        } elseif ($type === 'float') {
            $value_to_store = (float)$value;
        } elseif ($type === 'json' || $type === 'array') {
            $value_to_store = json_encode($value);
        }
        
        // Check if setting exists
        $setting = $CI->db->where('setting_key', $key)->get('settings')->row();
        
        if ($setting) {
            // Update existing setting
            return $CI->db->where('setting_key', $key)->update('settings', [
                'value' => $value_to_store,
                'type' => $type,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        } else {
            // Insert new setting
            return $CI->db->insert('settings', [
                'setting_key' => $key,
                'value' => $value_to_store,
                'type' => $type,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}

if (!function_exists('delete_setting')) {
    /**
     * Delete a setting
     *
     * @param string $key Setting key to delete
     * @return bool Success status
     */
    function delete_setting($key) {
        $CI =& get_instance();
        return $CI->db->where('setting_key', $key)->delete('settings');
    }
}

// Load this helper automatically
$CI =& get_instance();
$CI->load->helper('settings');
