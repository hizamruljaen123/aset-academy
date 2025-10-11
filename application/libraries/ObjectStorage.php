<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

class ObjectStorage
{
    protected $ci;
    protected $s3;
    protected $bucket;
    protected $endpoint;
    protected $baseUrl;
    protected $prefix = '';

    public function __construct($config = [])
    {
        $this->ci = &get_instance();

        // Load Composer autoloader
        $autoload = APPPATH . '../vendor/autoload.php';
        if (file_exists($autoload)) {
            require_once $autoload;
        }

        // Load configuration from environment variables
        $cfg = [
            'access_key' => env('CLOUD_STORAGE_ACCESS_KEY'),
            'secret_key' => env('CLOUD_STORAGE_SECRET_KEY'),
            'server'    => env('CLOUD_STORAGE_SERVER'),
            'name'      => env('CLOUD_STORAGE_NAME'),
            'path'      => env('CLOUD_STORAGE_PATH'),
            'region'    => env('CLOUD_STORAGE_REGION') ?: 'us-east-1'
        ];
        
        // Validate required configuration
        $required = ['access_key', 'secret_key', 'server', 'name'];
        foreach ($required as $key) {
            if (empty($cfg[$key])) {
                throw new RuntimeException("Missing required configuration: CLOUD_STORAGE_" . strtoupper($key));
            }
        }

        // Configuration validation is already done above

        $this->bucket = $cfg['name'];
        $this->endpoint = rtrim($cfg['server'], '/');
        $this->baseUrl = (strpos($cfg['server'], 'http') === 0)
            ? rtrim($cfg['server'], '/')
            : 'https://' . rtrim($cfg['server'], '/');
        $this->prefix = !empty($cfg['path']) ? ltrim($cfg['path'], '/') : '';

        $clientConfig = [
            'version' => 'latest',
            'region' => $cfg['region'],
            'endpoint' => $this->baseUrl,
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key' => $cfg['access_key'],
                'secret' => $cfg['secret_key']
            ]
        ];

        try {
            $this->s3 = new S3Client($clientConfig);
        } catch (AwsException $e) {
            log_message('error', 'ObjectStorage: S3 client init error: ' . $e->getMessage());
            $this->s3 = null;
        }
    }

    protected function parse_cloud_storage_file($path)
    {
        $result = [];
        if (!file_exists($path)) {
            return $result;
        }
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || strpos($line, '#') === 0) continue;
            $parts = preg_split('/\s*=\s*/', $line, 2);
            if (count($parts) == 2) {
                $key = strtoupper(trim($parts[0]));
                $value = trim($parts[1]);
                $result[$key] = $value;
            }
        }
        return $result;
    }

    public function putFile($localPath, $remoteKey, $acl = 'public-read')
    {
        if (!$this->s3) return false;
        if (!file_exists($localPath)) return false;

        $key = $this->prefix ? rtrim($this->prefix, '/') . '/' . ltrim($remoteKey, '/') : ltrim($remoteKey, '/');

        try {
            $body = fopen($localPath, 'r');
            $params = [
                'Bucket' => $this->bucket,
                'Key' => $key,
                'Body' => $body,
                'ACL' => $acl
            ];
            // Try to set ContentType if possible
            if (function_exists('mime_content_type')) {
                $mime = @mime_content_type($localPath);
                if ($mime) $params['ContentType'] = $mime;
            }

            $this->s3->putObject($params);
            // Construct public URL
            $url = $this->baseUrl . '/' . $this->bucket . '/' . $key;
            return $url;
        } catch (AwsException $e) {
            log_message('error', 'ObjectStorage putFile error: ' . $e->getMessage());
            return false;
        }
    }

    public function delete($remoteKey)
    {
        if (!$this->s3) return false;
        $key = $this->prefix ? rtrim($this->prefix, '/') . '/' . ltrim($remoteKey, '/') : ltrim($remoteKey, '/');
        try {
            $this->s3->deleteObject(['Bucket' => $this->bucket, 'Key' => $key]);
            return true;
        } catch (AwsException $e) {
            log_message('error', 'ObjectStorage delete error: ' . $e->getMessage());
            return false;
        }
    }

    public function getUrl($remoteKey)
    {
        $key = $this->prefix ? rtrim($this->prefix, '/') . '/' . ltrim($remoteKey, '/') : ltrim($remoteKey, '/');
        return $this->baseUrl . '/' . $this->bucket . '/' . $key;
    }
}
