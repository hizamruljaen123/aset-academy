<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Test Encryption Controller
 * 
 * Controller untuk testing encryption URL functionality
 */
class Test_encryption extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('encryption_url');
    }

    /**
     * Test encryption and decryption functionality
     */
    public function index()
    {
        echo "<h1>URL Encryption Test</h1>";
        echo "<h2>Testing encryption and decryption</h2>";
        
        // Test cases
        $test_ids = [1, 42, 999, 12345, 999999];
        
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>Original ID</th><th>Encrypted</th><th>Decrypted</th><th>Match</th></tr>";
        
        foreach ($test_ids as $original_id) {
            $encrypted = $this->encryption_url->encode($original_id);
            $decrypted = $this->encryption_url->decode($encrypted);
            $match = ($decrypted === $original_id) ? '✅' : '❌';
            
            echo "<tr>";
            echo "<td>{$original_id}</td>";
            echo "<td>{$encrypted}</td>";
            echo "<td>{$decrypted}</td>";
            echo "<td>{$match}</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        // Test URL generation
        echo "<h2>Testing URL Generation</h2>";
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>ID</th><th>Detail URL</th><th>Register URL</th><th>Guest Register URL</th></tr>";
        
        foreach ([1, 42, 123] as $id) {
            $detail_url = workshop_detail_url($id);
            $register_url = workshop_register_url($id);
            $guest_register_url = workshop_register_guest_url($id);
            
            echo "<tr>";
            echo "<td>{$id}</td>";
            echo "<td><a href='{$detail_url}' target='_blank'>{$detail_url}</a></td>";
            echo "<td><a href='{$register_url}' target='_blank'>{$register_url}</a></td>";
            echo "<td><a href='{$guest_register_url}' target='_blank'>{$guest_register_url}</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        
        // Test invalid encrypted strings
        echo "<h2>Testing Invalid Encrypted Strings</h2>";
        $invalid_strings = ['invalid', '123abc', '!@#$%', 'toolongstringtoolongstringtoolongstring'];
        
        foreach ($invalid_strings as $invalid) {
            $result = $this->encryption_url->decode($invalid);
            echo "Invalid: '{$invalid}' -> " . ($result === false ? '❌ (correctly rejected)' : "⚠️ (returned: {$result})") . "<br>";
        }
    }

    /**
     * Test with actual workshop data
     */
    public function workshop_test()
    {
        $this->load->model('Workshop_model');
        
        echo "<h1>Workshop URL Test</h1>";
        
        // Get some workshops
        $workshops = $this->Workshop_model->get_all_workshops();
        
        if (empty($workshops)) {
            echo "No workshops found. Please create some test workshops first.";
            return;
        }
        
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>ID</th><th>Title</th><th>Encrypted ID</th><th>Detail URL</th></tr>";
        
        foreach (array_slice($workshops, 0, 5) as $workshop) {
            $encrypted_id = encrypt_url_id($workshop->id);
            $detail_url = workshop_detail_url($workshop->id);
            
            echo "<tr>";
            echo "<td>{$workshop->id}</td>";
            echo "<td>" . htmlspecialchars($workshop->title) . "</td>";
            echo "<td>{$encrypted_id}</td>";
            echo "<td><a href='{$detail_url}' target='_blank'>{$detail_url}</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}
