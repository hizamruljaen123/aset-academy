<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo isset($description) ? $description : 'Dokumentasi lengkap teknologi dan programming untuk pemula. Belajar dari dasar hingga mahir dengan panduan komprehensif.'; ?>">
    <meta name="keywords" content="dokumentasi, programming, teknologi, pemula, tutorial, coding, development">
    <meta name="author" content="ASET Academy">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo current_url(); ?>">
    <meta property="og:title" content="<?php echo isset($title) ? $title : 'Dokumentasi - ASET Academy'; ?>">
    <meta property="og:description" content="<?php echo isset($description) ? $description : 'Dokumentasi lengkap teknologi dan programming untuk pemula.'; ?>">
    <meta property="og:image" content="<?php echo base_url('assets/img/logo.png'); ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo current_url(); ?>">
    <meta property="twitter:title" content="<?php echo isset($title) ? $title : 'Dokumentasi - ASET Academy'; ?>">
    <meta property="twitter:description" content="<?php echo isset($description) ? $description : 'Dokumentasi lengkap teknologi dan programming untuk pemula.'; ?>">
    <meta property="twitter:image" content="<?php echo base_url('assets/img/logo.png'); ?>">

    <title><?php echo isset($title) ? $title : 'Dokumentasi - ASET Academy'; ?></title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .pulse-blob {
            animation: pulse-blob 7s infinite;
        }

        @keyframes pulse-blob {
            0% { transform: scale(1) translate(0px, 0px); }
            33% { transform: scale(1.1) translate(30px, -50px); }
            66% { transform: scale(0.9) translate(-20px, 20px); }
            100% { transform: scale(1) translate(0px, 0px); }
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .code-block {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 1rem;
            font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
            font-size: 0.875rem;
            line-height: 1.5;
            overflow-x: auto;
        }

        .highlight {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Mobile optimizations */
        @media (max-width: 768px) {
            .pulse-blob {
                animation-duration: 4s;
            }
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    <!-- Navigation -->
    <?php $this->load->view('documentation/templates/_navbar'); ?>

    <!-- Content Wrapper -->
    <div class="min-h-screen pt-16"> <!-- pt-16 accounts for fixed navbar -->
