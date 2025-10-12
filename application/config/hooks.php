<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/userguide3/general/hooks.html
|
*/

/*
| -------------------------------------------------------------------------
| Session Tracking Hook
| -------------------------------------------------------------------------
| Automatically tracks user sessions and updates activity on every page load
| This hook runs after the controller is instantiated but before any method is called
*/
$hook['post_controller_constructor'] = array(
    'class'    => 'Session_tracker',
    'function' => 'track_session',
    'filename' => 'Session_tracker.php',
    'filepath' => 'hooks'
);

/*
|| -------------------------------------------------------------------------
|| Cache Headers Hook
|| -------------------------------------------------------------------------
|| Automatically adds cache control and expires headers for better performance
|| This hook runs after the controller is instantiated but before any method is called
*/
$hook['post_controller_constructor'][] = array(
    'class'    => 'Cache_headers',
    'function' => 'set_cache_headers',
    'filename' => 'Cache_headers.php',
    'filepath' => 'hooks'
);
