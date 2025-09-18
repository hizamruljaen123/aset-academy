<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {
        // Set content type to XML
        $this->output->set_content_type('application/xml');

        // Get base URL
        $base_url = base_url();

        // Static pages
        $pages = [
            [
                'loc' => $base_url,
                'lastmod' => '2024-09-18',
                'changefreq' => 'daily',
                'priority' => '1.0'
            ],
            [
                'loc' => $base_url . 'home/premium',
                'lastmod' => '2024-09-18',
                'changefreq' => 'weekly',
                'priority' => '0.9'
            ],
            [
                'loc' => $base_url . 'home/free',
                'lastmod' => '2024-09-18',
                'changefreq' => 'weekly',
                'priority' => '0.9'
            ],
            [
                'loc' => $base_url . 'home/digital_solutions',
                'lastmod' => '2024-09-18',
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ],
            [
                'loc' => $base_url . 'home/partnership',
                'lastmod' => '2024-09-18',
                'changefreq' => 'monthly',
                'priority' => '0.7'
            ],
            [
                'loc' => $base_url . 'home/about',
                'lastmod' => '2024-09-18',
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ],
            [
                'loc' => $base_url . 'home/faq',
                'lastmod' => '2024-09-18',
                'changefreq' => 'monthly',
                'priority' => '0.7'
            ],
            [
                'loc' => $base_url . 'home/download_app',
                'lastmod' => '2024-09-18',
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ],
            [
                'loc' => $base_url . 'documentation',
                'lastmod' => '2024-09-18',
                'changefreq' => 'monthly',
                'priority' => '0.6'
            ]
        ];

        // Add documentation chapters
        for ($i = 1; $i <= 10; $i++) {
            $pages[] = [
                'loc' => $base_url . 'documentation/chapter' . $i,
                'lastmod' => '2024-09-18',
                'changefreq' => 'monthly',
                'priority' => '0.5'
            ];
        }

        // Add authentication pages
        $auth_pages = [
            'auth/login',
            'auth/register',
            'auth/forgot_password'
        ];

        foreach ($auth_pages as $page) {
            $pages[] = [
                'loc' => $base_url . $page,
                'lastmod' => '2024-09-18',
                'changefreq' => 'yearly',
                'priority' => '0.3'
            ];
        }

        // TODO: Add dynamic content like premium classes, free classes, etc.
        // You can add database queries here to include dynamic URLs

        // Generate XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($pages as $page) {
            $xml .= "\t<url>\n";
            $xml .= "\t\t<loc>" . htmlspecialchars($page['loc']) . "</loc>\n";
            $xml .= "\t\t<lastmod>" . $page['lastmod'] . "</lastmod>\n";
            $xml .= "\t\t<changefreq>" . $page['changefreq'] . "</changefreq>\n";
            $xml .= "\t\t<priority>" . $page['priority'] . "</priority>\n";
            $xml .= "\t</url>\n";
        }

        $xml .= '</urlset>';

        $this->output->set_output($xml);
    }
}
