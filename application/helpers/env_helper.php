<?php
/**
 * Env Helper untuk CodeIgniter 3
 * 
 * Fungsi ini memungkinkan penggunaan env('KEY') untuk membaca variabel dari file .env
 * Mirip dengan Laravel
 */

if (!function_exists('env')) {
    /**
     * Mengambil nilai environment variable dari file .env
     *
     * @param string $key Nama key dari environment variable
     * @param mixed $default Nilai default jika key tidak ditemukan
     * @return mixed
     */
    function env($key, $default = null)
    {
        static $envVars = null;
        
        // Load .env file hanya sekali
        if ($envVars === null) {
            $envVars = [];
            
            // Tentukan path ke .env file
            // Coba beberapa kemungkinan lokasi
            $possiblePaths = [
                FCPATH . '.env',                           // Root folder (sejajar index.php)
                dirname(FCPATH) . '/.env',                 // Parent folder
                $_SERVER['DOCUMENT_ROOT'] . '/.env',       // Document root
                dirname(__FILE__) . '/../../.env',         // Relative dari helper
            ];
            
            $envFile = null;
            foreach ($possiblePaths as $path) {
                if (file_exists($path)) {
                    $envFile = $path;
                    break;
                }
            }
            
            // Cek apakah file .env ada
            if ($envFile && file_exists($envFile)) {
                $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                
                foreach ($lines as $line) {
                    // Skip komentar
                    $line = trim($line);
                    if (empty($line) || strpos($line, '#') === 0) {
                        continue;
                    }
                    
                    // Parse line
                    if (strpos($line, '=') !== false) {
                        list($name, $value) = explode('=', $line, 2);
                        $name = trim($name);
                        $value = trim($value);
                        
                        // Hapus quotes jika ada
                        if (preg_match('/^(["\'])(.*)\1$/', $value, $matches)) {
                            $value = $matches[2];
                        }
                        
                        $envVars[$name] = $value;
                        
                        // Set ke $_ENV juga untuk konsistensi
                        if (!isset($_ENV[$name])) {
                            $_ENV[$name] = $value;
                        }
                    }
                }
            }
        }
        
        // Prioritas: getenv() > $_ENV > $_SERVER > .env file
        $value = getenv($key);
        if ($value !== false) {
            return _parse_env_value($value);
        }
        
        if (isset($_ENV[$key])) {
            return _parse_env_value($_ENV[$key]);
        }
        
        if (isset($_SERVER[$key])) {
            return _parse_env_value($_SERVER[$key]);
        }
        
        if (isset($envVars[$key])) {
            return _parse_env_value($envVars[$key]);
        }
        
        return $default;
    }
}

if (!function_exists('_parse_env_value')) {
    /**
     * Parse nilai environment variable
     * Konversi string boolean dan null ke tipe data yang sesuai
     *
     * @param string $value
     * @return mixed
     */
    function _parse_env_value($value)
    {
        if (is_bool($value)) {
            return $value;
        }
        
        if (!is_string($value)) {
            return $value;
        }
        
        $lower = strtolower(trim($value));
        
        switch ($lower) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'null':
            case '(null)':
            case '':
                return null;
            case 'empty':
            case '(empty)':
                return '';
        }
        
        // Cek jika nilai adalah number
        if (is_numeric($value)) {
            return strpos($value, '.') !== false ? (float) $value : (int) $value;
        }
        
        return $value;
    }
}

if (!function_exists('is_local')) {
    /**
     * Cek apakah environment adalah local/development
     *
     * @return bool
     */
    function is_local()
    {
        $environment = env('CI_ENV', env('ENVIRONMENT', ENVIRONMENT));
        return in_array($environment, ['development', 'local', 'dev']);
    }
}

if (!function_exists('is_production')) {
    /**
     * Cek apakah environment adalah production
     *
     * @return bool
     */
    function is_production()
    {
        $environment = env('CI_ENV', env('ENVIRONMENT', ENVIRONMENT));
        return $environment === 'production';
    }
}

if (!function_exists('config_item_env')) {
    /**
     * Get config item dengan fallback ke environment variable
     *
     * @param string $item Config item name
     * @param string $envKey Environment variable key (opsional)
     * @param mixed $default Default value
     * @return mixed
     */
    function config_item_env($item, $envKey = null, $default = null)
    {
        $CI =& get_instance();
        
        // Cek di config terlebih dahulu
        $value = $CI->config->item($item);
        
        if ($value !== null) {
            return $value;
        }
        
        // Fallback ke env
        if ($envKey === null) {
            $envKey = strtoupper($item);
        }
        
        return env($envKey, $default);
    }
}