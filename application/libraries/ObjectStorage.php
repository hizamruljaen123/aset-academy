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
        } else {
            log_message('error', 'ObjectStorage: Composer autoload not found at ' . $autoload);
        }

        if (!class_exists(S3Client::class)) {
            log_message('error', 'ObjectStorage: AWS SDK for PHP (aws/aws-sdk-php) is not installed.');
            return;
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

    /**
     * Compress image before upload
     * Supports: JPEG, PNG, GIF, WebP
     * 
     * @param string $sourcePath Path to original image
     * @return string|false Path to compressed image or false on failure
     */
    protected function compressImage($sourcePath)
    {
        // Check if GD library is available
        if (!extension_loaded('gd')) {
            log_message('debug', 'GD library not available, skipping image compression');
            return $sourcePath;
        }

        // Get image info
        $imageInfo = @getimagesize($sourcePath);
        if (!$imageInfo) {
            return $sourcePath;
        }

        list($width, $height, $type) = $imageInfo;
        
        // Skip compression for very small images (< 50KB)
        $fileSize = filesize($sourcePath);
        if ($fileSize < 51200) {
            return $sourcePath;
        }

        // Create image resource based on type
        $sourceImage = null;
        switch ($type) {
            case IMAGETYPE_JPEG:
                $sourceImage = @imagecreatefromjpeg($sourcePath);
                break;
            case IMAGETYPE_PNG:
                $sourceImage = @imagecreatefrompng($sourcePath);
                break;
            case IMAGETYPE_GIF:
                $sourceImage = @imagecreatefromgif($sourcePath);
                break;
            case IMAGETYPE_WEBP:
                if (function_exists('imagecreatefromwebp')) {
                    $sourceImage = @imagecreatefromwebp($sourcePath);
                }
                break;
            default:
                return $sourcePath;
        }

        if (!$sourceImage) {
            return $sourcePath;
        }

        // Calculate new dimensions if image is too large
        $maxWidth = 1920;
        $maxHeight = 1920;
        $newWidth = $width;
        $newHeight = $height;

        if ($width > $maxWidth || $height > $maxHeight) {
            $ratio = min($maxWidth / $width, $maxHeight / $height);
            $newWidth = round($width * $ratio);
            $newHeight = round($height * $ratio);
        }

        // Create new image with calculated dimensions
        $newImage = imagecreatetruecolor($newWidth, $newHeight);

        // Preserve transparency for PNG and GIF
        if ($type == IMAGETYPE_PNG || $type == IMAGETYPE_GIF) {
            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);
            $transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127);
            imagefilledrectangle($newImage, 0, 0, $newWidth, $newHeight, $transparent);
        }

        // Resample image with high quality
        imagecopyresampled($newImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        // Create temp file for compressed image
        $tempPath = sys_get_temp_dir() . '/' . uniqid('compressed_') . '_' . basename($sourcePath);

        // Save compressed image based on type
        $success = false;
        switch ($type) {
            case IMAGETYPE_JPEG:
                // JPEG with 85% quality (optimal balance)
                $success = imagejpeg($newImage, $tempPath, 85);
                break;
            case IMAGETYPE_PNG:
                // PNG with compression level 6 (0-9, 9 = max compression)
                $success = imagepng($newImage, $tempPath, 6);
                break;
            case IMAGETYPE_GIF:
                $success = imagegif($newImage, $tempPath);
                break;
            case IMAGETYPE_WEBP:
                if (function_exists('imagewebp')) {
                    // WebP with 85% quality
                    $success = imagewebp($newImage, $tempPath, 85);
                }
                break;
        }

        // Free memory
        imagedestroy($sourceImage);
        imagedestroy($newImage);

        if (!$success || !file_exists($tempPath)) {
            return $sourcePath;
        }

        // Check if compression actually reduced file size
        $originalSize = filesize($sourcePath);
        $compressedSize = filesize($tempPath);

        if ($compressedSize < $originalSize) {
            log_message('info', sprintf(
                'Image compressed: %s -> %s (%.1f%% reduction)',
                $this->formatBytes($originalSize),
                $this->formatBytes($compressedSize),
                (($originalSize - $compressedSize) / $originalSize) * 100
            ));
            return $tempPath;
        } else {
            // If compression didn't help, delete temp file and use original
            @unlink($tempPath);
            return $sourcePath;
        }
    }

    /**
     * Format bytes to human readable format
     */
    protected function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    /**
     * Check if file is an image
     */
    protected function isImage($filePath)
    {
        if (!file_exists($filePath)) {
            return false;
        }

        $mime = @mime_content_type($filePath);
        if (!$mime) {
            // Fallback to extension check
            $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
            return in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
        }

        return strpos($mime, 'image/') === 0;
    }

    public function putFile($localPath, $remoteKey, $acl = 'public-read', $compress = true)
    {
        if (!$this->s3) return false;
        if (!file_exists($localPath)) return false;

        // Compress image if it's an image file and compression is enabled
        $uploadPath = $localPath;
        $isCompressed = false;
        
        if ($compress && $this->isImage($localPath)) {
            $compressedPath = $this->compressImage($localPath);
            if ($compressedPath !== $localPath) {
                $uploadPath = $compressedPath;
                $isCompressed = true;
            }
        }

        $key = $this->prefix ? rtrim($this->prefix, '/') . '/' . ltrim($remoteKey, '/') : ltrim($remoteKey, '/');

        try {
            $body = fopen($uploadPath, 'r');
            $params = [
                'Bucket' => $this->bucket,
                'Key' => $key,
                'Body' => $body,
                'ACL' => $acl
            ];
            
            // Try to set ContentType if possible
            if (function_exists('mime_content_type')) {
                $mime = @mime_content_type($uploadPath);
                if ($mime) $params['ContentType'] = $mime;
            }

            $this->s3->putObject($params);
            
            // Clean up compressed temp file if exists
            if ($isCompressed && file_exists($uploadPath)) {
                @unlink($uploadPath);
            }
            
            // Construct public URL
            $url = $this->baseUrl . '/' . $this->bucket . '/' . $key;
            return $url;
        } catch (AwsException $e) {
            // Clean up compressed temp file on error
            if ($isCompressed && file_exists($uploadPath)) {
                @unlink($uploadPath);
            }
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
