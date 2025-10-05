<?php
// Quick test script to instantiate ObjectStorage outside HTTP request (for local dev only)
require __DIR__ . '/../application/config/constants.php';
require __DIR__ . '/../vendor/autoload.php';

// Try bootstrap minimal CI instance if possible
// This script assumes it's run from project root via `php tools/test_objectstorage.php`.
// It will attempt to include CodeIgniter system/core if available; otherwise it will just include the library directly.

$libPath = __DIR__ . '/../application/libraries/ObjectStorage.php';
if (!file_exists($libPath)) {
    echo "ObjectStorage library not found: $libPath\n";
    exit(1);
}

require_once $libPath;

// Create a fake CI instance with minimal config loader
class FakeCI {
    public $config;
    public function __construct() {
        $this->config = new class {
            protected $items = [];
            public function load($file, $use_sections = FALSE, $fail_gracefully = TRUE) {
                // emulate CI load by including the file
                $path = __DIR__ . '/../../application/config/' . $file . '.php';
                if (file_exists($path)) {
                    $config = [];
                    include($path);
                    // if file defines $config, set items
                    if (isset($config)) {
                        if ($use_sections && isset($config[$file])) {
                            $this->items[$file] = $config[$file];
                        } else {
                            $this->items[$file] = $config;
                        }
                    }
                }
            }
            public function item($key) {
                return $this->items[$key] ?? null;
            }
        };
    }
}

// Inject fake CI into global get_instance()
$GLOBALS['CI_TEST_INSTANCE'] = new FakeCI();

function &get_instance() {
    return $GLOBALS['CI_TEST_INSTANCE'];
}

$os = new ObjectStorage();
if ($os) {
    echo "ObjectStorage constructed.\n";
} else {
    echo "ObjectStorage construction returned falsy.\n";
}

// End
