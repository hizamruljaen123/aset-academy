<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Primary Meta Tags -->
    <title><?php echo isset($title) ? html_escape($title) : 'Kelas Coding Murah | Pelatihan Coding Terbaik | Belajar Coding Online - Aset Academy'; ?></title>
    <meta name="title" content="<?php echo isset($title) ? html_escape($title) : 'Kelas Coding Murah | Pelatihan Coding Terbaik | Belajar Coding Online - Aset Academy'; ?>">
    <meta name="description" content="<?php echo isset($description) ? html_escape($description) : 'Kelas coding murah dan pelatihan coding terbaik untuk belajar coding online. Kursus programming lengkap dengan sertifikat, project nyata dan dukungan mentor profesional. Daftar kelas coding sekarang!'; ?>">
    <meta name="keywords" content="<?php echo isset($keywords) ? html_escape($keywords) : 'kelas coding, pelatihan coding, belajar coding, kursus programming, coding bootcamp, kelas coding murah, belajar coding online, kursus web development, mobile development, data science, javascript, php, python, java'; ?>">
    <meta name="author" content="Aset Academy">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="googlebot" content="index, follow">

    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo current_url(); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo current_url(); ?>">
    <meta property="og:title" content="<?php echo isset($title) ? html_escape($title) : 'Kelas Coding Murah | Pelatihan Coding Terbaik | Belajar Coding Online - Aset Academy'; ?>">
    <meta property="og:description" content="<?php echo isset($description) ? html_escape($description) : 'Kelas coding murah dan pelatihan coding terbaik untuk belajar coding online. Kursus programming lengkap dengan sertifikat, project nyata dan dukungan mentor profesional.'; ?>">
    <meta property="og:image" content="<?php echo base_url('assets/images/aset-academy-og-image.jpg'); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Aset Academy">
    <meta property="og:locale" content="id_ID">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo current_url(); ?>">
    <meta property="twitter:title" content="<?php echo isset($title) ? html_escape($title) : 'Kelas Coding Murah | Pelatihan Coding Terbaik | Belajar Coding Online - Aset Academy'; ?>">
    <meta property="twitter:description" content="<?php echo isset($description) ? html_escape($description) : 'Kelas coding murah dan pelatihan coding terbaik untuk belajar coding online. Kursus programming lengkap dengan sertifikat, project nyata dan dukungan mentor profesional.'; ?>">
    <meta property="twitter:image" content="<?php echo base_url('assets/images/aset-academy-twitter-image.jpg'); ?>">

    <!-- Additional SEO Meta Tags -->
    <meta name="theme-color" content="#0e1127">
    <meta name="msapplication-TileColor" content="#0e1127">
    <meta name="application-name" content="Aset Academy">

    <!-- Structured Data - JSON-LD -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "EducationalOrganization",
        "name": "Aset Academy",
        "description": "Platform kelas coding murah dan pelatihan coding terbaik untuk belajar coding online dengan kurikulum lengkap dan sertifikat resmi",
        "url": "<?php echo base_url(); ?>",
        "logo": "<?php echo base_url('assets/images/logo.png'); ?>",
        "sameAs": [
            "https://facebook.com/asetacademy",
            "https://instagram.com/asetacademy",
            "https://linkedin.com/company/asetacademy"
        ],
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+62-xxx-xxxx-xxxx",
            "contactType": "customer service",
            "availableLanguage": "Indonesian"
        },
        "offers": {
            "@type": "OfferCatalog",
            "name": "Kelas Coding & Pelatihan Programming",
            "itemListElement": [
                {
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Course",
                        "name": "Kelas Coding Web Development",
                        "description": "Pelatihan coding lengkap untuk menjadi web developer profesional",
                        "provider": {
                            "@type": "EducationalOrganization",
                            "name": "Aset Academy"
                        }
                    }
                },
                {
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Course",
                        "name": "Kelas Coding Mobile Development",
                        "description": "Belajar coding untuk membuat aplikasi mobile Android dan iOS",
                        "provider": {
                            "@type": "EducationalOrganization",
                            "name": "Aset Academy"
                        }
                    }
                },
                {
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Course",
                        "name": "Kelas Coding Data Science",
                        "description": "Pelatihan coding untuk analisis data dan machine learning",
                        "provider": {
                            "@type": "EducationalOrganization",
                            "name": "Aset Academy"
                        }
                    }
                }
            ]
        },
        "areaServed": "Indonesia",
        "serviceType": "Online Learning Platform"
    }
    </script>

    <!-- SEO & Social Metadata --><!-- Sudah very good. Tambah favicon dan manifest -->
    <link rel="icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/png">
    <link rel="icon" href="<?= base_url('assets/img/logo.svg') ?>" type="image/svg+xml">
    <link rel="apple-touch-icon" href="<?= base_url('assets/img/logo.png') ?>">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileImage" content="<?= base_url('assets/img/logo.png') ?>" />
    <meta name="theme-color" content="#0e1127" />
    <!-- Preload Font Modern (Inter dan Feather Icon) -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/webfonts/fa-solid-900.woff2" as="font" type="font/woff2" crossorigin>

    <!-- Libraries -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.globe.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes pulse-blob {
            0% { transform: scale(1); opacity: 0.8; }
            50% { transform: scale(1.1); opacity: 0.6; }
            100% { transform: scale(1); opacity: 0.8; }
        }
        .pulse-blob {
            animation: pulse-blob 8s ease-in-out infinite;
        }
        .carousel {
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }
        .carousel-item {
            scroll-snap-align: start;
            flex: 0 0 auto;
        }
        .faq-item .faq-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        
        /* Dark Theme Variables */
        :root {
            --primary-dark: #0e1127;
            --secondary-dark: #2e3c73;
            --accent-dark: #198aad;
            --text-light: #ffffff;
            --text-muted: rgba(255, 255, 255, 0.8);
            --bg-glass: rgba(255, 255, 255, 0.1);
            --border-glass: rgba(255, 255, 255, 0.2);
        }
        
        /* Custom Scrollbar for Dark Theme */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--primary-dark);
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--secondary-dark);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent-dark);
        }
    </style>
    <link rel="stylesheet" href="<?= base_url('assets/css/documentation.css') ?>">
</head>
<body class="font-sans antialiased bg-gradient-to-br from-gray-900 via-slate-900 to-gray-900 text-white selection:bg-blue-500/20 selection:text-blue-300 transition duration-200">
