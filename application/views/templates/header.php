<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - Academy Lite</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon.ico') ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/favicon.ico') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/img/logo.png') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/img/logo.png') ?>">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Tailwind CSS (Production Ready) -->
    <script src="https://cdn.tailwindcss.com/3.4.0"></script>
    <script>
        window.baseUrl = '<?php echo rtrim(base_url(), '/'); ?>/';
        window.siteUrl = '<?php echo rtrim(site_url(), '/'); ?>/';
        
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontSize: {
                        'input': '1rem',
                    },
                    padding: {
                        'input': '0.75rem',
                    },
                    colors: {
                        'input-border': {
                            DEFAULT: '#d1d5db',
                            focus: '#3b82f6',
                        },
                    },
                },
            },
        };
    </script>

    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" onerror="console.warn('Alpine.js failed to load')"></script>
    
    <!-- Teacher Styles -->
    <link href="<?php echo base_url('assets/css/teacher.css'); ?>" rel="stylesheet">
    
    <!-- Absensi Calendar Styles -->
    <link href="<?php echo base_url('assets/css/absensi_calendar.css'); ?>" rel="stylesheet">
    
    <!-- Quill.js Styles -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/quill-custom.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/forum.css'); ?>" rel="stylesheet">
    
    <!-- Custom Form Input Styles -->
    <link href="<?php echo base_url('assets/css/form-inputs.css'); ?>" rel="stylesheet">
    <!-- Form Enhancement Utilities -->
    <link href="<?php echo base_url('assets/css/form-enhancements.css'); ?>" rel="stylesheet">
    <!-- Permissions Styles -->
    <link href="<?php echo base_url('assets/css/permissions.css'); ?>" rel="stylesheet">
    
    <!-- Global Form Styles - Enhanced & Cleaner -->
    <style>
        /* Enhanced Form Input Styling */
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        input[type="tel"],
        input[type="url"],
        input[type="search"],
        input[type="date"],
        input[type="time"],
        input[type="datetime-local"],
        textarea,
        select {
            /* Base styling with better readability */
            font-size: 1rem; /* 16px base font */
            line-height: 1.5; /* Better line height for readability */
            padding: 0.75rem 1rem; /* Consistent padding */
            border: 1px solid #d1d5db; /* Gray-300 */
            border-radius: 0.5rem; /* rounded-lg */
            background-color: #ffffff;
            color: #111827; /* Gray-900 */
            font-family: inherit;
            transition: all 0.2s ease-in-out;
            width: 100%;
            box-sizing: border-box;
        }

        /* Enhanced focus states */
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="number"]:focus,
        input[type="tel"]:focus,
        input[type="url"]:focus,
        input[type="search"]:focus,
        input[type="date"]:focus,
        input[type="time"]:focus,
        input[type="datetime-local"]:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #3b82f6; /* Blue-500 */
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); /* Blue-500 with opacity */
            background-color: #fefefe;
        }

        /* Placeholder styling */
        input::placeholder,
        textarea::placeholder {
            color: #9ca3af; /* Gray-400 */
            opacity: 1;
        }

        /* Select dropdown arrow styling */
        select {
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1rem;
            padding-right: 2.5rem;
            cursor: pointer;
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            input[type="text"],
            input[type="email"],
            input[type="password"],
            input[type="number"],
            input[type="tel"],
            input[type="url"],
            input[type="search"],
            input[type="date"],
            input[type="time"],
            input[type="datetime-local"],
            textarea,
            select {
                background-color: #1f2937; /* Gray-800 */
                color: #f9fafb; /* Gray-50 */
                border-color: #374151; /* Gray-700 */
            }

            input[type="text"]:focus,
            input[type="email"]:focus,
            input[type="password"]:focus,
            input[type="number"]:focus,
            input[type="tel"]:focus,
            input[type="url"]:focus,
            input[type="search"]:focus,
            input[type="date"]:focus,
            input[type="time"]:focus,
            input[type="datetime-local"]:focus,
            textarea:focus,
            select:focus {
                border-color: #60a5fa; /* Blue-400 */
                box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.1);
            }

            input::placeholder,
            textarea::placeholder {
                color: #6b7280; /* Gray-500 */
            }

            select {
                background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
            }
        }

        /* Form labels - Enhanced styling */
        label {
            display: block;
            font-weight: 500;
            color: #374151; /* Gray-700 */
            font-size: 0.875rem; /* text-sm */
            margin-bottom: 0.5rem;
            line-height: 1.25;
        }

        /* Required field indicator */
        label:has(+ input[required]),
        label:has(+ select[required]),
        label:has(+ textarea[required]) {
            position: relative;
        }

        label:has(+ input[required])::after,
        label:has(+ select[required])::after,
        label:has(+ textarea[required])::after {
            content: "*";
            color: #ef4444; /* Red-500 */
            margin-left: 0.25rem;
            font-weight: 600;
        }

        /* Form groups - Better spacing */
        .form-group {
            margin-bottom: 1.5rem;
        }

        /* Error state styling */
        .form-error input,
        .form-error select,
        .form-error textarea {
            border-color: #ef4444; /* Red-500 */
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .form-error input:focus,
        .form-error select:focus,
        .form-error textarea:focus {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        /* Success state styling */
        .form-success input,
        .form-success select,
        .form-success textarea {
            border-color: #10b981; /* Emerald-500 */
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .form-success input:focus,
        .form-success select:focus,
        .form-success textarea:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        /* Disabled state styling */
        input:disabled,
        select:disabled,
        textarea:disabled {
            background-color: #f9fafb; /* Gray-50 */
            color: #6b7280; /* Gray-500 */
            cursor: not-allowed;
            opacity: 0.7;
        }

        /* Readonly state styling */
        input:read-only,
        select:read-only,
        textarea:read-only {
            background-color: #f9fafb; /* Gray-50 */
            color: #374151; /* Gray-700 */
            cursor: default;
        }

        /* Button styling */
        button[type="submit"],
        input[type="submit"],
        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        button[type="submit"]:hover,
        input[type="submit"]:hover,
        .btn-primary:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transform: translateY(-1px);
        }

        button[type="submit"]:focus,
        input[type="submit"]:focus,
        .btn-primary:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }

        /* Secondary button styling */
        .btn-secondary {
            background-color: #f9fafb; /* Gray-50 */
            color: #374151; /* Gray-700 */
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            border: 1px solid #d1d5db; /* Gray-300 */
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        .btn-secondary:hover {
            background-color: #f3f4f6; /* Gray-100 */
            border-color: #9ca3af; /* Gray-400 */
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {
            input[type="text"],
            input[type="email"],
            input[type="password"],
            input[type="number"],
            input[type="tel"],
            input[type="url"],
            input[type="search"],
            input[type="date"],
            input[type="time"],
            input[type="datetime-local"],
            textarea,
            select {
                font-size: 1rem; /* Prevent zoom on iOS */
                padding: 1rem; /* Larger touch targets */
            }
        }

        /* Custom Scrollbar for Sidebar */
        #sidebar::-webkit-scrollbar {
            width: 6px;
        }

        #sidebar::-webkit-scrollbar-track {
            background: #f1f5f9; /* Gray-100 */
            border-radius: 3px;
        }

        #sidebar::-webkit-scrollbar-thumb {
            background: #cbd5e1; /* Gray-300 */
            border-radius: 3px;
            transition: background 0.2s ease;
        }

        #sidebar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8; /* Gray-400 */
        }

        @media (prefers-contrast: high) {
            input[type="text"],
            input[type="email"],
            input[type="password"],
            input[type="number"],
            input[type="tel"],
            input[type="url"],
            input[type="search"],
            input[type="date"],
            input[type="time"],
            input[type="datetime-local"],
            textarea,
            select {
                border-width: 2px;
            }

            input[type="text"]:focus,
            input[type="email"]:focus,
            input[type="password"]:focus,
            input[type="number"]:focus,
            input[type="tel"]:focus,
            input[type="url"]:focus,
            input[type="search"]:focus,
            input[type="date"]:focus,
            input[type="time"]:focus,
            input[type="datetime-local"]:focus,
            textarea:focus,
            select:focus {
                border-width: 3px;
            }
        }

        /* Firefox scrollbar */
        #sidebar {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 #f1f5f9;
        }
    </style>
    
    <!-- Admin Assignments Styles -->
    <link href="<?php echo base_url('assets/css/assignments-admin.css'); ?>" rel="stylesheet">    

    <!-- Highlight.js for Syntax Highlighting -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>

    <!-- FullCalendar -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

    <!-- Flowbite -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js" onerror="console.warn('Flowbite failed to load')"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gradient-to-b from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 shadow-xl fixed h-full transition-all duration-300 ease-in-out z-50 overflow-y-auto border-r border-gray-200 dark:border-gray-700" id="sidebar">
            <!-- Logo & Brand -->
            <div class="p-4 border-b border-gray-200 dark:border-gray-700 bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm">
                <a href="<?php echo site_url(); ?>" class="flex items-center space-x-3 group">
                    <!-- Logo Light Mode -->
                    <img src="<?= base_url('assets/img/logo.png') ?>" alt="ASET Academy" class="h-8 w-auto dark:hidden">
                    <!-- Logo Dark Mode -->
                    <img src="<?= base_url('assets/img/logo-white.png') ?>" alt="ASET Academy" class="h-8 w-auto hidden dark:block">
                </a>
            </div>
            
            <!-- Dark Mode Toggle -->
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <button onclick="toggleDarkMode()" class="w-full flex items-center justify-between px-4 py-3 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-xl transition-all duration-300 group">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-orange-500 dark:from-blue-500 dark:to-indigo-600 rounded-lg flex items-center justify-center shadow-md group-hover:shadow-lg transition-all">
                            <i class="fas fa-sun text-white dark:hidden"></i>
                            <i class="fas fa-moon text-white hidden dark:inline-block"></i>
                        </div>
                        <div class="text-left">
                            <div class="text-sm font-semibold text-gray-800 dark:text-white">
                                <span class="dark:hidden">Light Mode</span>
                                <span class="hidden dark:inline">Dark Mode</span>
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Klik untuk ubah</div>
                        </div>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400 group-hover:translate-x-1 transition-transform"></i>
                </button>
            </div>
            
            <nav class="p-2" x-data="{
                teacherSections: {
                    dashboard: true,
                    teaching: false,
                    assessment: false,
                    community: false
                },
                studentSections: {
                    dashboard: true,
                    learning: false,
                    operational: false,
                    discussion: false
                },
                adminSections: {
                    dashboard: true,
                    masterdata: false,
                    classes: false,
                    operational: false,
                    community: false,
                    admin: false
                }
            }">
                <?php 
                $role = $this->session->userdata('role');
                $level = $this->session->userdata('level');
                ?>
                
                <?php if ($role == 'guru'): ?>
                    <!-- Teacher Navigation -->
                    <!-- Dashboard Section -->
                    <div class="mb-2">
                        <button                                 class="flex items-center justify-between w-full px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 rounded-xl transition-all duration-200 group">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-cyan-500 to-teal-500 rounded-lg flex items-center justify-center mr-3 shadow-md">
                                    <i class="fas fa-tachometer-alt text-xs text-white"></i>
                        </div>
                                <span class="font-medium text-sm">Dashboard</span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"
                               ></i>
                        </button>
                        <div style="display: block;" x-transition class="ml-4 mt-1 space-y-1">
                            <a href="<?php echo site_url('teacher'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-home text-xs"></i>
                                </div>
                                <span class="font-medium">Beranda</span>
                            </a>
                        </div>
                    </div>

                    <!-- Kelas & Materi Section -->
                    <div class="mb-2">
                        <button @click="teacherSections.teaching = !teacherSections.teaching"
                                class="flex items-center justify-between w-full px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 rounded-xl transition-all duration-200 group">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-500 rounded-lg flex items-center justify-center mr-3 shadow-md">
                                    <i class="fas fa-chalkboard-teacher text-xs text-white"></i>
                                </div>
                                <span class="font-medium text-sm">Kelas & Materi</span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"
                               :class="{'rotate-180': teacherSections.teaching}"></i>
                        </button>
                        <div x-show="teacherSections.teaching" x-transition class="ml-4 mt-1 space-y-1">
                            <a href="<?php echo site_url('teacher/kelas'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-graduation-cap text-xs"></i>
                                </div>
                                <span class="font-medium">Kelas Saya</span>
                            </a>
                            <a href="<?php echo site_url('teacher/siswa'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-users text-xs"></i>
                                </div>
                                <span class="font-medium">Siswa Saya</span>
                            </a>
                            <a href="<?php echo site_url('teacher/materi'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-book text-xs"></i>
                                </div>
                                <span class="font-medium">Materi</span>
                            </a>
                        </div>
                    </div>

                    <!-- Penilaian Section -->
                    <div class="mb-2">
                        <button                                 class="flex items-center justify-between w-full px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 rounded-xl transition-all duration-200 group">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-500 rounded-lg flex items-center justify-center mr-3 shadow-md">
                                    <i class="fas fa-edit text-xs text-white"></i>
                                </div>
                                <span class="font-medium text-sm">Penilaian</span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"
                               ></i>
                        </button>
                        <div style="display: block;" x-transition class="ml-4 mt-1 space-y-1">
                            <a href="<?php echo site_url('teacher/assignments'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-clipboard-check text-xs"></i>
                                </div>
                                <span class="font-medium">Penilaian</span>
                            </a>
                        </div>
                    </div>

                    <!-- Komunitas Section -->
                    <div class="mb-2">
                        <button                                 class="flex items-center justify-between w-full px-4 py-2 text-gray-600 dark:text-gray-300 rounded-xl transition-all duration-200 group">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center mr-3 shadow-md">
                                    <i class="fas fa-users text-xs text-white"></i>
                                </div>
                                <span class="font-medium text-sm">Diskusi</span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"
                               ></i>
                        </button>
                        <div style="display: block;" x-transition class="ml-4 mt-1 space-y-1">
                            <a href="<?php echo site_url('forum'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-comments text-xs"></i>
                                </div>
                                <span class="font-medium">Forum</span>
                            </a>
                            <a href="<?php echo site_url('teacher/workshop-guests'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-users-cog text-xs"></i>
                                </div>
                                <span class="font-medium">Workshop Guests</span>
                            </a>
                        </div>
                    </div>
                    
                <?php elseif ($role == 'siswa'): ?>
                    <!-- Student Navigation -->
                    <!-- Dashboard Section -->
                    <div class="mb-2">
                        <button                                 class="flex items-center justify-between w-full px-4 py-2 text-gray-600 dark:text-gray-300 rounded-xl transition-all duration-200 group">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-cyan-500 to-teal-500 rounded-lg flex items-center justify-center mr-3 shadow-md">
                                    <i class="fas fa-tachometer-alt text-xs text-white"></i>
                                </div>
                                <span class="font-medium text-sm">Dashboard</span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"
                               ></i>
                        </button>
                        <div style="display: block;" x-transition class="ml-4 mt-1 space-y-1">
                            <a href="<?php echo site_url('student'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-home text-xs"></i>
                                </div>
                                <span class="font-medium">Beranda</span>
                            </a>
                            <a href="<?php echo site_url('student/profile'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-user text-xs"></i>
                                </div>
                                <span class="font-medium">Profil Saya</span>
                            </a>
                            <a href="<?php echo site_url('student/orders'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-shopping-cart text-xs"></i>
                                </div>
                                <span class="font-medium">Pesanan Saya</span>
                            </a>
                        </div>
                    </div>

                    <!-- Pembelajaran Section -->
                    <div class="mb-2">
                        <button                                 class="flex items-center justify-between w-full px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 rounded-xl transition-all duration-200 group">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-500 rounded-lg flex items-center justify-center mr-3 shadow-md">
                                    <i class="fas fa-graduation-cap text-xs text-white"></i>
                                </div>
                                <span class="font-medium text-sm">Pembelajaran</span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"
                               ></i>
                        </button>
                        <div style="display: block;" x-transition class="ml-4 mt-1 space-y-1">
                            <a href="<?php echo site_url('student/all_classes'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-layer-group text-xs"></i>
                                </div>
                                <span class="font-medium">Semua Kelas Saya</span>
                            </a>
                            <a href="<?php echo site_url('student/premium'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-crown text-xs text-yellow-500"></i>
                                </div>
                                <span class="font-medium">Kelas Premium</span>
                            </a>
                            <a href="<?php echo site_url('student/workshops'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-users text-xs"></i>
                                </div>
                                <span class="font-medium">Workshop & Seminar</span>
                            </a>
                            <a href="<?php echo site_url('student/free_classes'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-graduation-cap text-xs"></i>
                                </div>
                                <span class="font-medium">Kelas Gratis</span>
                            </a>
                            <a href="<?php echo site_url('student/materi'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-book-open text-xs"></i>
                                </div>
                                <span class="font-medium">Materi Pembelajaran</span>
                            </a>
                        </div>
                    </div>

                    <!-- Operasional Section -->
                    <div class="mb-2">
                        <button                                 class="flex items-center justify-between w-full px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 rounded-xl transition-all duration-200 group">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-500 rounded-lg flex items-center justify-center mr-3 shadow-md">
                                    <i class="fas fa-cogs text-xs text-white"></i>
                                </div>
                                <span class="font-medium text-sm">Operasional</span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"
                               ></i>
                        </button>
                        <div style="display: block;" x-transition class="ml-4 mt-1 space-y-1">
                            <a href="<?php echo site_url('absensi'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-user-check text-xs"></i>
                                </div>
                                <span class="font-medium">Absensi Saya</span>
                            </a>
                            <a href="<?php echo site_url('student/assignments'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-tasks text-xs"></i>
                                </div>
                                <span class="font-medium">Penilaian</span>
                            </a>
                            <a href="<?php echo site_url('forum'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-comments text-xs"></i>
                                </div>
                                <span class="font-medium">Forum</span>
                            </a>
                        </div>
                    </div>
                    
                <?php else: ?>
                    <!-- Admin Navigation -->
                    <!-- Dashboard Section -->
                    <div class="mb-2">
                        <button                                 class="flex items-center justify-between w-full px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 rounded-xl transition-all duration-200 group">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-cyan-500 to-teal-500 rounded-lg flex items-center justify-center mr-3 shadow-md">
                                    <i class="fas fa-tachometer-alt text-xs text-white"></i>
                                </div>
                                <span class="font-medium text-sm">Dashboard</span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"
                               ></i>
                        </button>
                        <div style="display: block;" x-transition class="ml-4 mt-1 space-y-1">
                            <a href="<?php echo site_url('dashboard'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-home text-xs"></i>
                                </div>
                                <span class="font-medium">Beranda</span>
                            </a>
                            <a href="<?php echo site_url('admin/statistics'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-chart-line text-xs"></i>
                                </div>
                                <span class="font-medium">Statistics</span>
                            </a>
                        </div>
                    </div>

                    <!-- Data Master Section -->
                    <div class="mb-2">
                        <button                                 class="flex items-center justify-between w-full px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 rounded-xl transition-all duration-200 group">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-red-500 rounded-lg flex items-center justify-center mr-3 shadow-md">
                                    <i class="fas fa-database text-xs text-white"></i>
                                </div>
                                <span class="font-medium text-sm">Data Master</span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"
                               ></i>
                        </button>
                        <div style="display: block;" x-transition class="ml-4 mt-1 space-y-1">
                            <a href="<?php echo site_url('siswa'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-users text-xs"></i>
                                </div>
                                <span class="font-medium">Data Siswa</span>
                            </a>
                            <a href="<?php echo site_url('admin_guru'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-chalkboard-teacher text-xs"></i>
                                </div>
                                <span class="font-medium">Kelola Guru</span>
                            </a>
                        </div>
                    </div>

                    <!-- Kelas & Materi Section -->
                    <div class="mb-2">
                        <button                                 class="flex items-center justify-between w-full px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 rounded-xl transition-all duration-200 group">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-500 rounded-lg flex items-center justify-center mr-3 shadow-md">
                                    <i class="fas fa-graduation-cap text-xs text-white"></i>
                                </div>
                                <span class="font-medium text-sm">Kelas & Materi</span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"
                               ></i>
                        </button>
                        <div style="display: block;" x-transition class="ml-4 mt-1 space-y-1">
                            <a href="<?php echo site_url('kelas'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-code text-xs"></i>
                                </div>
                                <span class="font-medium">Kelas Programming</span>
                            </a>
                            <a href="<?php echo site_url('materi'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-book text-xs"></i>
                                </div>
                                <span class="font-medium">Materi</span>
                            </a>
                            <a href="<?php echo site_url('admin/free_classes'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-graduation-cap text-xs"></i>
                                </div>
                                <span class="font-medium">Kelas Gratis</span>
                            </a>
                            <a href="<?php echo site_url('admin/class_categories'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-tags text-xs"></i>
                                </div>
                                <span class="font-medium">Kategori Kelas</span>
                            </a>
                        </div>
                    </div>

                    <!-- Operasional Section -->
                    <div class="mb-2">
                        <button                                 class="flex items-center justify-between w-full px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 rounded-xl transition-all duration-200 group">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-500 rounded-lg flex items-center justify-center mr-3 shadow-md">
                                    <i class="fas fa-cogs text-xs text-white"></i>
                                </div>
                                <span class="font-medium text-sm">Operasional</span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"
                               ></i>
                        </button>
                        <div style="display: block;" x-transition class="ml-4 mt-1 space-y-1">
                            <a href="<?php echo site_url('absensi'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-user-check text-xs"></i>
                                </div>
                                <span class="font-medium">Kelola Absensi</span>
                            </a>
                            <a href="<?php echo site_url('admin/jadwal'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-calendar-alt text-xs"></i>
                                </div>
                                <span class="font-medium">Kelola Jadwal</span>
                            </a>
                            <a href="<?php echo site_url('admin/assignments'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-clipboard-check text-xs"></i>
                                </div>
                                <span class="font-medium">Penilaian</span>
                            </a>
                            <a href="<?= site_url('admin/workshops'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-chalkboard-teacher text-xs"></i>
                                </div>
                                <span class="font-medium">Workshop & Seminar</span>
                            </a>
                            <a href="<?php echo site_url('admin/workshop-guests'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-users-cog text-xs"></i>
                                </div>
                                <span class="font-medium">Workshop Guests</span>
                            </a>
                        </div>
                    </div>

                    <!-- Komunitas Section -->
                    <div class="mb-2">
                        <button                                 class="flex items-center justify-between w-full px-4 py-2 text-gray-600 dark:text-gray-300 rounded-xl transition-all duration-200 group">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center mr-3 shadow-md">
                                    <i class="fas fa-users text-xs text-white"></i>
                                </div>
                                <span class="font-medium text-sm">Komunitas</span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"
                               ></i>
                        </button>
                        <div style="display: block;" x-transition class="ml-4 mt-1 space-y-1">
                            <a href="<?php echo site_url('forum'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-comments text-xs"></i>
                                </div>
                                <span class="font-medium">Forum</span>
                            </a>
                    <?php if ($level === '1'): ?>
                            <a href="<?php echo site_url('admin/recruitment'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm" target="_blank" rel="noopener">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-briefcase text-xs"></i>
                                </div>
                                <span class="font-medium">Halaman Karier</span>
                    </a>
                    <?php endif; ?>
                        </div>
                    </div>
                    
                    <?php if ($level == '1' || $level == '2'): // Super Admin or Admin ?>
                    <!-- Admin Section -->
                    <div class="mb-2">
                        <button  class="flex items-center justify-between w-full px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 rounded-xl transition-all duration-200 group">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-red-500 to-pink-500 rounded-lg flex items-center justify-center mr-3 shadow-md">
                                    <i class="fas fa-user-shield text-xs text-white"></i>
                                </div>
                                <span class="font-medium text-sm">Admin</span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"
                               ></i>
                        </button>
                        <div style="display: block;" x-transition class="ml-4 mt-1 space-y-1">
                            <a href="<?php echo site_url('payment/admin_verify'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-money-check-alt text-xs"></i>
                                </div>
                                <span class="font-medium">Verifikasi Pembayaran</span>
                            </a>
                            <a href="<?php echo site_url('admin/enrollment'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-user-graduate text-xs"></i>
                                </div>
                                <span class="font-medium">Kelola Akses Kelas</span>
                            </a>
                            <a href="<?php echo site_url('admin/contact'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-phone text-xs"></i>
                                </div>
                                <span class="font-medium">Kotak Masuk</span>
                            </a>
                            <a href="<?php echo site_url('admin/users'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-user-shield text-xs"></i>
                                </div>
                                <span class="font-medium">Kelola User</span>
                            </a>
                            <a href="<?php echo site_url('admin/permissions'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-key text-xs"></i>
                                </div>
                                <span class="font-medium">Kelola Permission</span>
                            </a>
                            <a href="<?php echo site_url('admin/settings'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-cog text-xs"></i>
                                </div>
                                <span class="font-medium">Pengaturan Sistem</span>
                            </a>
                            <a href="<?php echo site_url('admin/session_management'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-shield-alt text-xs"></i>
                                </div>
                                <span class="font-medium">Session Management</span>
                            </a>
                            <a href="<?php echo site_url('admin/midtrans'); ?>" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200 group text-sm">
                                <div class="w-6 h-6 flex items-center justify-center rounded-md mr-3 bg-gray-100 dark:bg-gray-700 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-credit-card text-xs"></i>
                                </div>
                                <span class="font-medium">Midtrans Payment</span>
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-0 md:ml-64 transition-all duration-300 ease-in-out" id="mainContent">
            <!-- Topbar -->
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-md shadow-lg border-b border-gray-200 dark:border-gray-700 p-4 flex justify-between items-center sticky top-0 z-40 transition-colors duration-300">
                <div class="flex items-center space-x-4">
                    <button onclick="toggleSidebar()" class="md:hidden bg-gradient-to-br from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white p-2.5 rounded-lg mr-3 transition-all duration-300 shadow-md hover:shadow-lg">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800 dark:text-white"><?php echo $title; ?></h1>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Welcome back! 👋</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-3">
                    <div class="relative" id="profileDropdown">
                        <button type="button" id="userMenuButton" class="flex items-center space-x-3 px-3 py-2 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 border border-gray-200 dark:border-gray-600 bg-white/50 dark:bg-gray-800/50">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center shadow-md">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <div class="text-left hidden md:block">
                                <p class="text-sm font-semibold text-gray-800 dark:text-white truncate max-w-[150px]">
                                    <?php echo $this->session->userdata('nama_lengkap') ?: 'Admin'; ?>
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-[150px]">
                                    <?php 
                                    $role = $this->session->userdata('role');
                                    $role_labels = [
                                        'super_admin' => 'Super Admin',
                                        'admin' => 'Administrator',
                                        'guru' => 'Guru',
                                        'siswa' => 'Siswa'
                                    ];
                                    echo isset($role_labels[$role]) ? $role_labels[$role] : 'Pengguna';
                                    ?>
                                </p>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 dark:text-gray-500 text-xs ml-1 transition-transform group-hover:rotate-180"></i>
                        </button>
                        
                        <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-64 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl py-2 ring-1 ring-black ring-opacity-5 dark:ring-gray-700 focus:outline-none z-50 transition-all duration-200 ease-in-out transform opacity-0 scale-95 border border-gray-200 dark:border-gray-700" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <div class="px-4 py-4 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-blue-50 to-purple-50 dark:from-gray-700 dark:to-gray-600 mx-2 rounded-xl mb-2">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center shadow-md">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                                            <?php echo $this->session->userdata('nama_lengkap') ?: 'Admin'; ?>
                                        </p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400 truncate">
                                            <?php echo $this->session->userdata('email') ?: 'admin@academy.com'; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo site_url('profile'); ?>" class="flex items-center px-4 py-3 mx-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700 rounded-xl transition-all duration-200 group" role="menuitem" tabindex="-1">
                                <div class="w-9 h-9 bg-gray-100 dark:bg-gray-600 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-user-cog text-gray-600 dark:text-gray-300"></i>
                                </div>
                                <span class="font-medium">Profile Settings</span>
                            </a>
                            <div class="border-t border-gray-200 dark:border-gray-700 my-2"></div>
                            <a href="<?php echo site_url('auth/logout'); ?>" class="flex items-center px-4 py-3 mx-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-xl transition-all duration-200 group" role="menuitem" tabindex="-1">
                                <div class="w-9 h-9 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-sign-out-alt text-red-600 dark:text-red-400"></i>
                                </div>
                                <span class="font-medium">Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="p-4">
                <!-- Flash Messages -->
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="mb-4 p-4 border-l-4 border-green-500 bg-green-50 dark:bg-green-900/20 rounded-xl shadow-md dark:border-green-400 transition-all duration-300">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-500 dark:bg-green-600 rounded-lg flex items-center justify-center mr-3 shadow-md">
                                <i class="fas fa-check-circle text-white"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-bold text-green-800 dark:text-green-300">Success!</p>
                                <p class="text-green-700 dark:text-green-400"><?php echo $this->session->flashdata('success'); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="mb-4 p-4 border-l-4 border-red-500 bg-red-50 dark:bg-red-900/20 rounded-xl shadow-md dark:border-red-400 transition-all duration-300">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-red-500 dark:bg-red-600 rounded-lg flex items-center justify-center mr-3 shadow-md">
                                <i class="fas fa-exclamation-circle text-white"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-bold text-red-800 dark:text-red-300">Error!</p>
                                <p class="text-red-700 dark:text-red-400"><?php echo $this->session->flashdata('error'); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

    <script>
        // Dark Mode Toggle
        function toggleDarkMode() {
            const html = document.documentElement;
            const isDark = html.classList.contains('dark');
            
            if (isDark) {
                html.classList.remove('dark');
                localStorage.setItem('darkMode', 'false');
            } else {
                html.classList.add('dark');
                localStorage.setItem('darkMode', 'true');
            }
        }

        // Check dark mode preference on load
        window.addEventListener('DOMContentLoaded', function() {
            const darkMode = localStorage.getItem('darkMode');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            
            if (darkMode === 'true' || (darkMode === null && prefersDark)) {
                document.documentElement.classList.add('dark');
            }
        });

        // Toggle sidebar on mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            
            sidebar.classList.toggle('hidden');
            sidebar.classList.toggle('block');
            mainContent.classList.toggle('ml-64');
        }

        // Toggle user dropdown
        document.addEventListener('DOMContentLoaded', function() {
            const userMenuButton = document.getElementById('userMenuButton');
            const dropdownMenu = document.getElementById('dropdownMenu');
            let isOpen = false;

            // Toggle dropdown on button click
            userMenuButton.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                if (isOpen) {
                    dropdownMenu.classList.add('hidden');
                    dropdownMenu.classList.remove('opacity-100', 'scale-100');
                    dropdownMenu.classList.add('opacity-0', 'scale-95');
                    isOpen = false;
                } else {
                    dropdownMenu.classList.remove('hidden');
                    dropdownMenu.classList.remove('opacity-0', 'scale-95');
                    dropdownMenu.classList.add('opacity-100', 'scale-100');
                    isOpen = true;
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                const profileDropdown = document.getElementById('profileDropdown');
                
                if (!profileDropdown.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                    dropdownMenu.classList.remove('opacity-100', 'scale-100');
                    dropdownMenu.classList.add('opacity-0', 'scale-95');
                    isOpen = false;
                }
            });
        });

        // Handle mobile sidebar
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            if (window.innerWidth > 768) {
                sidebar.classList.remove('hidden');
                sidebar.classList.add('block');
            }
        });
    </script>
    <!-- Quill.js Scripts -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="<?php echo base_url('assets/js/quill-init.js'); ?>"></script>
    
    <!-- Admin Assignments Scripts -->
    <script src="<?php echo base_url('assets/js/assignments-admin.js'); ?>"></script>
    <!-- Permissions Scripts -->
    <script src="<?php echo base_url('assets/js/permissions.js'); ?>"></script>

    <!-- Dynamic Scripts and Styles -->
    <?php if (isset($scripts) && is_array($scripts)): ?>
        <?php foreach ($scripts as $script): ?>
            <?php if (filter_var($script, FILTER_VALIDATE_URL)): ?>
                <script src="<?php echo $script; ?>"></script>
            <?php else: ?>
                <script src="<?php echo base_url($script); ?>"></script>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <?php if (isset($styles) && is_array($styles)): ?>
        <?php foreach ($styles as $style): ?>
            <?php if (filter_var($style, FILTER_VALIDATE_URL)): ?>
                <link href="<?php echo $style; ?>" rel="stylesheet">
            <?php else: ?>
                <link href="<?php echo base_url($style); ?>" rel="stylesheet">
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Global JavaScript Error Handler -->
    <script>
        // Global error handler to catch and log JavaScript errors
        window.addEventListener('error', function(e) {
            console.warn('JavaScript Error:', e.error ? e.error.message : e.message, 'at', e.filename + ':' + e.lineno);
            // Don't prevent default to allow normal error handling
        });

        // Handle unhandled promise rejections
        window.addEventListener('unhandledrejection', function(e) {
            console.warn('Unhandled Promise Rejection:', e.reason);
        });

        // Suppress specific known warnings
        const originalWarn = console.warn;
        console.warn = function(...args) {
            // Filter out known harmless warnings
            if (args[0] && typeof args[0] === 'string') {
                if (args[0].includes('cdn.tailwindcss.com should not be used in production')) {
                    return; // Suppress Tailwind warning (now using stable version)
                }
                if (args[0].includes('cdn.jsdelivr.net should not be used in production')) {
                    return; // Suppress jsDelivr warning
                }
                if (args[0].includes('$ is not defined')) {
                    return; // Suppress jQuery undefined warning (loaded per page)
                }
            }
            originalWarn.apply(console, args);
        };
    </script>
