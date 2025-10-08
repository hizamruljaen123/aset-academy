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

        // Load configuration by directly including the config file (no CI config->load checks)
        // If the file is missing or doesn't define $config['cloud_storage'], fall back to the inline defaults below.
        $config = [];
        @include(APPPATH . 'config/cloud_storage.php');
        $cfg = $config['cloud_storage'] ?? [
            'ACCESS_KEY' => '112HPA3FIMQSDSD2Z23Q',
            'SECRET_KEY' => '8Nh1QbARDpa0HbBCDXQ7tP0M6uh8r5ikgQZyAWqf',
            'SERVER'     => 'is3.cloudhost.id',
            'NAME'       => 'pantaoumedia',
            'PATH'       => '/asset_academy/',
            'REGION'     => 'us-east-1'
        ];

        if (empty($cfg['ACCESS_KEY']) || empty($cfg['SECRET_KEY']) || empty($cfg['SERVER']) || empty($cfg['NAME'])) {
            log_message('error', 'ObjectStorage: missing storage configuration');
            return;
        }

        $this->bucket = $cfg['NAME'];
        $this->endpoint = rtrim($cfg['SERVER'], '/');
        $this->baseUrl = (strpos($cfg['SERVER'], 'http') === 0)
            ? rtrim($cfg['SERVER'], '/')
            : 'https://' . rtrim($cfg['SERVER'], '/');
        $this->prefix = isset($cfg['PATH']) ? ltrim($cfg['PATH'], '/') : '';

        $clientConfig = [
            'version' => 'latest',
            'region' => $cfg['REGION'] ?? 'us-east-1',
            'endpoint' => $this->baseUrl,
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key' => $cfg['ACCESS_KEY'],
                'secret' => $cfg['SECRET_KEY']
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
