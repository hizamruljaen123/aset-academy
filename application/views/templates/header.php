<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - Academy Lite</title>
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = {darkMode: 'class'}</script>

    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
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
    
    <!-- Admin Assignments Styles -->
    <link href="<?php echo base_url('assets/css/assignments-admin.css'); ?>" rel="stylesheet">    

    <!-- Highlight.js for Syntax Highlighting -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>

    <!-- FullCalendar -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

    <!-- Flowbite -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-md fixed h-full transition-all duration-300 ease-in-out z-50" id="sidebar">
            <div class="p-4 border-b border-gray-200">
                <a href="<?php echo site_url(); ?>" class="flex items-center text-blue-600 font-bold">
                    <i class="fas fa-graduation-cap mr-2"></i>
                    Academy Lite
                </a>
            </div>
            
            <nav class="p-2">
                <?php 
                $role = $this->session->userdata('role');
                $level = $this->session->userdata('level');
                ?>
                
                <?php if ($role == 'guru'): ?>
                    <!-- Teacher Navigation -->
                    <a href="<?php echo site_url('teacher'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'teacher') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-tachometer-alt w-5 text-center mr-3"></i>
                        Dashboard
                    </a>
                    <a href="<?php echo site_url('teacher/kelas'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'teacher' && $this->uri->segment(2) == 'kelas') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-chalkboard-teacher w-5 text-center mr-3"></i>
                        Kelas Saya
                    </a>
                    <a href="<?php echo site_url('teacher/siswa'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'teacher' && $this->uri->segment(2) == 'siswa') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-users w-5 text-center mr-3"></i>
                        Siswa Saya
                    </a>
                    <a href="<?php echo site_url('teacher/materi'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'teacher' && $this->uri->segment(2) == 'materi') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-book w-5 text-center mr-3"></i>
                        Materi
                    </a>
                    <a href="<?php echo site_url('teacher/assignments'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'teacher' && $this->uri->segment(2) == 'assignments') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-edit w-5 text-center mr-3"></i>
                        Penilaian
                    </a>
                    <a href="<?php echo site_url('forum'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'forum') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-comments w-5 text-center mr-3"></i>
                        Forum
                    </a>
                    
                <?php elseif ($role == 'siswa'): ?>
                    <!-- Student Navigation -->
                    <a href="<?php echo site_url('student'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'student' && $this->uri->segment(2) == '') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-tachometer-alt w-5 text-center mr-3"></i>
                        Dashboard
                    </a>
                    <a href="<?php echo site_url('student/profile'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'student' && $this->uri->segment(2) == 'profile') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-user w-5 text-center mr-3"></i>
                        Profil Saya
                    </a>
                    <a href="<?php echo site_url('student/materi'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'student' && $this->uri->segment(2) == 'materi') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-book-open w-5 text-center mr-3"></i>
                        Materi Pembelajaran
                    </a>
                    <a href="<?php echo site_url('student/premium'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'student' && $this->uri->segment(2) == 'premium') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-crown w-5 text-center mr-3 text-yellow-500"></i>
                        Kelas Premium
                    </a>
                    <a href="<?php echo site_url('student/free_classes'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'student' && $this->uri->segment(2) == 'free_classes') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-graduation-cap w-5 text-center mr-3"></i>
                        Kelas Gratis
                    </a>
                    <a href="<?php echo site_url('student/free_classes/my_classes'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'student' && $this->uri->segment(2) == 'free_classes' && $this->uri->segment(3) == 'my_classes') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-chalkboard w-5 text-center mr-3"></i>
                        Kelas Saya
                    </a>
                    <a href="<?php echo site_url('absensi'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'absensi') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-user-check w-5 text-center mr-3"></i>
                        Absensi Saya
                    </a>
                    <a href="<?php echo site_url('student/assignments'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'student' && $this->uri->segment(2) == 'assignments') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-tasks w-5 text-center mr-3"></i>
                        Penilaian
                    </a>
                    <a href="<?php echo site_url('forum'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'forum') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-comments w-5 text-center mr-3"></i>
                        Forum
                    </a>
                    
                <?php else: ?>
                    <!-- Admin Navigation -->
                    <a href="<?php echo site_url('dashboard'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-tachometer-alt w-5 text-center mr-3"></i>
                        Dashboard
                    </a>
                    <a href="<?php echo site_url('siswa'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'siswa') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-users w-5 text-center mr-3"></i>
                        Data Siswa
                    </a>
                    <a href="<?php echo site_url('kelas'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'kelas') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-code w-5 text-center mr-3"></i>
                        Kelas Programming
                    </a>
                    <a href="<?php echo site_url('materi'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'materi') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-book w-5 text-center mr-3"></i>
                        Materi
                    </a>
                    <a href="<?php echo site_url('admin_guru'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'admin_guru') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-chalkboard-teacher w-5 text-center mr-3"></i>
                        Kelola Guru
                    </a>
                    <a href="<?php echo site_url('admin/free_classes'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'free_classes') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-graduation-cap w-5 text-center mr-3"></i>
                        Kelas Gratis
                    </a>
                    <a href="<?php echo site_url('absensi'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'absensi') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-user-check w-5 text-center mr-3"></i>
                        Data Absensi
                    </a>
                    <a href="<?php echo site_url('admin/jadwal'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(2) == 'jadwal') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-calendar-alt w-5 text-center mr-3"></i>
                        Kelola Jadwal
                    </a>
                    <a href="<?php echo site_url('admin/assignments'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'assignments') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-clipboard-check w-5 text-center mr-3"></i>
                        Penilaian
                    </a>
                    <a href="<?php echo site_url('forum'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'forum') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-comments w-5 text-center mr-3"></i>
                        Forum
                    </a>
                    
                    <?php if ($level == '1' || $level == '2'): // Super Admin or Admin ?>
                    <div class="border-t border-gray-200 my-2"></div>
                    <div class="px-2 py-1 text-xs font-semibold text-gray-500 uppercase tracking-wider">Admin</div>
                    <a href="<?php echo site_url('payment/admin_verify'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'payment' && $this->uri->segment(2) == 'admin_verify') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-money-check-alt w-5 text-center mr-3"></i>
                        Verifikasi Pembayaran
                    </a>
                    <a href="<?php echo site_url('admin/enrollment'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'enrollment') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-user-graduate w-5 text-center mr-3"></i>
                        Kelola Akses Kelas
                    </a>
                    <a href="<?php echo site_url('admin/users'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'users') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-user-shield w-5 text-center mr-3"></i>
                        Kelola User
                    </a>
                    <a href="<?php echo site_url('admin/permissions'); ?>" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 mb-1 <?php echo ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'permissions') ? 'bg-blue-50 text-blue-600' : ''; ?>">
                        <i class="fas fa-key w-5 text-center mr-3"></i>
                        Kelola Permission
                    </a>
                    <?php endif; ?>
                <?php endif; ?>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-0 md:ml-64 transition-all duration-300 ease-in-out" id="mainContent">
            <!-- Topbar -->
            <div class="bg-white shadow-sm p-4 flex justify-between items-center sticky top-0 z-40">
                <div class="flex items-center">
                    <button onclick="toggleSidebar()" class="md:hidden bg-gray-100 hover:bg-gray-200 text-gray-600 p-2 rounded-md mr-3 transition-colors">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="text-xl font-semibold text-gray-800"><?php echo $title; ?></h1>
                </div>
                
                <div class="flex items-center space-x-3">
                    <div class="relative" id="profileDropdown">
                        <button type="button" id="userMenuButton" class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            <div class="w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <div class="text-left hidden md:block">
                                <p class="text-sm font-medium text-gray-700 truncate max-w-[150px]">
                                    <?php echo $this->session->userdata('nama_lengkap') ?: 'Admin'; ?>
                                </p>
                                <p class="text-xs text-gray-500 truncate max-w-[150px]">
                                    <?php 
                                    $role = $this->session->userdata('role');
                                    echo match($role) {
                                        'super_admin' => 'Super Admin',
                                        'admin' => 'Administrator',
                                        'guru' => 'Guru',
                                        'siswa' => 'Siswa',
                                        default => 'Pengguna'
                                    }; 
                                    ?>
                                </p>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 text-xs ml-1"></i>
                        </button>
                        
                        <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5 focus:outline-none z-50 transition-all duration-100 ease-in-out transform opacity-0 scale-95" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    <?php echo $this->session->userdata('nama_lengkap') ?: 'Admin'; ?>
                                </p>
                                <p class="text-xs text-gray-500 truncate">
                                    <?php echo $this->session->userdata('email') ?: 'admin@academy.com'; ?>
                                </p>
                            </div>
                            <a href="<?php echo site_url('profile'); ?>" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-150" role="menuitem" tabindex="-1">
                                <i class="fas fa-user-cog mr-3 text-gray-400 w-5 text-center"></i>
                                <span>Profile Settings</span>
                            </a>
                            <a href="<?php echo site_url('auth/logout'); ?>" class="flex items-center px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors duration-150" role="menuitem" tabindex="-1">
                                <i class="fas fa-sign-out-alt mr-3 text-red-400 w-5 text-center"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="p-4">
                <!-- Flash Messages -->
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="mb-4 p-4 border-l-4 border-green-500 bg-green-50 rounded-md">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-600 mr-3"></i>
                            <div>
                                <p class="font-semibold text-green-800">Success</p>
                                <p class="text-green-700"><?php echo $this->session->flashdata('success'); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="mb-4 p-4 border-l-4 border-red-500 bg-red-50 rounded-md">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle text-red-600 mr-3"></i>
                            <div>
                                <p class="font-semibold text-red-800">Error</p>
                                <p class="text-red-700"><?php echo $this->session->flashdata('error'); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

    <script>
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
