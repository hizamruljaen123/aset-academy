<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?= isset($title) ? html_escape($title) : 'Aset Academy Mobile' ?></title>
    <meta name="description" content="<?= isset($description) ? html_escape($description) : 'Aset Academy - Belajar Programming Jadi Mudah & Menyenangkan' ?>">
    <meta name="keywords" content="<?= isset($keywords) ? html_escape($keywords) : 'programming course, coding bootcamp, learn programming, web development, mobile development, data science' ?>">
    <meta name="theme-color" content="#3B82F6">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    
    <!-- Mobile-first CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    
    <!-- Mobile-specific styles -->
    <style>
        /* Mobile-first approach */
        * {
            -webkit-tap-highlight-color: transparent;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        
        /* Prevent zoom on focus */
        input, textarea, select {
            font-size: 16px;
        }
        
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }
        
        /* Custom scrollbar for mobile */
        ::-webkit-scrollbar {
            width: 4px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 2px;
        }
        
        /* Mobile navigation */
        .mobile-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            border-top: 1px solid #e5e7eb;
            z-index: 1000;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
        }
        
        .mobile-nav-item {
            flex: 1;
            text-align: center;
            padding: 8px 0;
            transition: all 0.2s ease;
        }
        
        .mobile-nav-item:active {
            background-color: #f3f4f6;
        }
        
        .mobile-nav-item.active {
            color: #3B82F6;
        }
        
        /* Card styles for mobile */
        .mobile-card {
            background: white;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .mobile-card:active {
            transform: scale(0.98);
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
        }
        
        /* Button styles for mobile */
        .mobile-btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        
        .mobile-btn:active {
            transform: scale(0.95);
        }
        
        /* Tab navigation for mobile */
        .mobile-tabs {
            display: flex;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        .mobile-tab {
            flex: 1;
            padding: 12px 16px;
            text-align: center;
            border-bottom: 2px solid transparent;
            transition: all 0.2s ease;
            white-space: nowrap;
            font-size: 14px;
        }
        
        .mobile-tab.active {
            color: #3B82F6;
            border-bottom-color: #3B82F6;
        }
        
        /* Profile avatar for mobile */
        .mobile-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3B82F6, #8B5CF6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 20px;
        }
        
        /* Loading spinner for mobile */
        .mobile-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid #f3f4f6;
            border-top: 3px solid #3B82F6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Pull-to-refresh indicator */
        .pull-to-refresh {
            text-align: center;
            padding: 20px;
            color: #6b7280;
            font-size: 14px;
        }
        
        /* Bottom safe area for iPhone X and newer */
        @supports (padding-bottom: env(safe-area-inset-bottom)) {
            .mobile-nav {
                padding-bottom: env(safe-area-inset-bottom);
            }
        }
        
        /* AOS animations */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
    
    <!-- Mobile-specific meta tags -->
    <link rel="manifest" href="<?= base_url('assets/manifest.json') ?>">
    <link rel="icon" href="<?= base_url('assets/favicon.ico') ?>" sizes="192x192">
    <link rel="apple-touch-icon" href="<?= base_url('assets/apple-touch-icon.png') ?>">
</head>
<body class="font-sans antialiased bg-gray-50 pb-20" id="mobile-app">
    <!-- Mobile Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="px-4 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="mobile-avatar">
                        <?php if (isset($student_profile)): ?>
                            <?php echo strtoupper(substr($student_profile->nama_lengkap, 0, 1)); ?>
                        <?php else: ?>
                            U
                        <?php endif; ?>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-gray-900">Dashboard</h1>
                        <p class="text-sm text-gray-500">Selamat datang!</p>
                    </div>
                </div>
                <button class="p-2 rounded-lg hover:bg-gray-100 transition-colors" onclick="location.href='<?= site_url('student_mobile/profile') ?>'">
                    <i data-feather="settings" class="w-5 h-5 text-gray-600"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="px-4 py-4">
        <!-- Content will be loaded here -->