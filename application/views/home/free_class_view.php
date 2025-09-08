<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $description; ?>">
    <meta name="keywords" content="programming, coding, web development, academy, belajar programming, kursus online">
    <meta name="author" content="Asset Academy">

    <title><?php echo $title; ?></title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Styles -->
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #2dd4bf 0%, #06b6d4 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .fade-in {
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .gradient-text {
            background: linear-gradient(135deg, #2dd4bf 0%, #06b6d4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .level-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="<?php echo site_url('home'); ?>" class="text-2xl font-bold gradient-text">
                            Asset Academy
                        </a>
                    </div>
                    <div class="hidden md:block ml-10">
                        <div class="flex items-baseline space-x-4">
                            <a href="<?php echo site_url('home'); ?>" class="text-gray-700 hover:text-cyan-600 px-3 py-2 text-sm font-medium transition-colors">Beranda</a>
                            <a href="<?php echo site_url('home/premium'); ?>" class="text-gray-700 hover:text-cyan-600 px-3 py-2 text-sm font-medium transition-colors">Kelas Premium</a>
                            <a href="<?php echo site_url('home/free'); ?>" class="text-gray-700 hover:text-cyan-600 px-3 py-2 text-sm font-medium transition-colors">Kelas Gratis</a>
                            <a href="<?php echo site_url('home/about'); ?>" class="text-gray-700 hover:text-cyan-600 px-3 py-2 text-sm font-medium transition-colors">Tentang</a>
                            <a href="<?php echo site_url('home/faq'); ?>" class="text-gray-700 hover:text-cyan-600 px-3 py-2 text-sm font-medium transition-colors">FAQ</a>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <?php if ($this->session->userdata('logged_in')): ?>
                        <a href="<?php echo site_url('dashboard'); ?>" class="bg-cyan-600 hover:bg-cyan-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Dashboard
                        </a>
                    <?php else: ?>
                        <a href="<?php echo site_url('auth/login'); ?>" class="text-gray-700 hover:text-cyan-600 px-3 py-2 text-sm font-medium transition-colors">
                            Masuk
                        </a>
                        <a href="<?php echo site_url('auth/register'); ?>" class="bg-cyan-600 hover:bg-cyan-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Daftar
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
            <div class="text-white fade-in">
                <h1 class="text-3xl lg:text-4xl font-bold mb-4">
                    <?php echo html_escape($free_class->title); ?>
                </h1>
                <p class="text-lg lg:text-xl mb-6 text-cyan-100 max-w-3xl leading-relaxed">
                    <?php echo html_escape($free_class->description); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Class Details -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Tentang Kelas Ini</h2>
                        <div class="prose max-w-none">
                            <p class="text-gray-700 mb-6">Kelas gratis ini dirancang untuk membantu Anda memahami konsep dasar programming dengan pendekatan yang praktis dan mudah dipahami.</p>
                            <p class="text-gray-700 mb-6">Anda akan belajar melalui materi yang terstruktur dan langsung praktek dengan contoh-contoh nyata yang relevan dengan industri.</p>
                        </div>
                    </div>

                    <!-- Materials -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Materi Kelas (<?php echo count($materials); ?> Materi)</h2>
                        
                        <?php if (empty($materials)): ?>
                            <div class="text-center py-8">
                                <i class="fas fa-book text-4xl text-gray-300 mb-4"></i>
                                <p class="text-gray-500">Belum ada materi yang tersedia untuk kelas ini</p>
                            </div>
                        <?php else: ?>
                            <div class="space-y-4">
                                <?php foreach ($materials as $index => $material): ?>
                                    <div class="flex items-start p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                        <div class="flex-shrink-0 w-8 h-8 bg-cyan-100 text-cyan-600 rounded-full flex items-center justify-center font-medium mr-4 mt-1">
                                            <?php echo $index + 1; ?>
                                        </div>
                                        <div class="flex-grow">
                                            <h3 class="font-semibold text-gray-900"><?php echo html_escape($material->title); ?></h3>
                                            <p class="text-gray-600 text-sm mt-1"><?php echo html_escape($material->description); ?></p>
                                            <div class="flex items-center mt-2 text-sm text-gray-500">
                                                <span class="inline-flex items-center">
                                                    <?php if ($material->content_type == 'video'): ?>
                                                        <i class="fas fa-video mr-1"></i> Video
                                                    <?php elseif ($material->content_type == 'pdf'): ?>
                                                        <i class="fas fa-file-pdf mr-1"></i> PDF
                                                    <?php elseif ($material->content_type == 'link'): ?>
                                                        <i class="fas fa-link mr-1"></i> Link
                                                    <?php else: ?>
                                                        <i class="fas fa-file-alt mr-1"></i> Text
                                                    <?php endif; ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-lg p-6 mb-6 sticky top-24">
                        <div class="mb-6">
                            <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="<?php echo html_escape($free_class->title); ?>" class="w-full h-48 object-cover rounded-lg mb-4">
                            
                            <div class="flex justify-between items-center mb-4">
                                <?php 
                                // Determine badge color based on level
                                $levelColors = [
                                    'Dasar' => 'bg-green-100 text-green-800',
                                    'Menengah' => 'bg-yellow-100 text-yellow-800',
                                    'Lanjutan' => 'bg-red-100 text-red-800',
                                    'default' => 'bg-gray-100 text-gray-800'
                                ];
                                $badgeColor = $levelColors[$free_class->level] ?? $levelColors['default'];
                                ?>
                                <span class="level-badge <?php echo $badgeColor; ?>">
                                    <?php echo html_escape($free_class->level); ?>
                                </span>
                                
                                <span class="text-sm text-gray-500">
                                    <i class="fas fa-clock mr-1"></i><?php echo html_escape($free_class->duration); ?> menit
                                </span>
                            </div>
                        </div>

                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Kategori:</span>
                                <span class="font-medium text-gray-900"><?php echo html_escape($free_class->category); ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Materi:</span>
                                <span class="font-medium text-gray-900"><?php echo html_escape($free_class->material_count); ?> item</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Peserta:</span>
                                <span class="font-medium text-gray-900"><?php echo html_escape($enrolled_count); ?> siswa</span>
                            </div>
                        </div>

                        <div class="flex flex-col gap-3">
                            <?php if ($this->session->userdata('logged_in')): ?>
                                <a href="<?php echo site_url('auth/login'); ?>" class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-3 rounded-lg font-semibold text-center transition-colors">
                                    <i class="fas fa-user-graduate mr-2"></i>Ikuti Kelas
                                </a>
                            <?php else: ?>
                                <a href="<?php echo site_url('auth/register'); ?>" class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-3 rounded-lg font-semibold text-center transition-colors">
                                    <i class="fas fa-user-plus mr-2"></i>Daftar untuk Ikuti
                                </a>
                                <a href="<?php echo site_url('auth/login'); ?>" class="border border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-lg font-semibold text-center transition-colors">
                                    <i class="fas fa-sign-in-alt mr-2"></i>Sudah Punya Akun?
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Features -->
                    <div class="bg-gradient-to-br from-cyan-50 to-teal-50 rounded-xl p-6 border border-cyan-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Kenapa Memilih Kelas Ini?</h3>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-700">Materi terstruktur dan mudah dipahami</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-700">Langsung praktek dengan contoh nyata</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-700">Tanpa biaya dan selamanya gratis</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-700">Dapat sertifikat setelah menyelesaikan</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Classes -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Kelas Gratis Lainnya</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Jelajahi kelas gratis lainnya yang mungkin menarik bagi Anda</p>
            </div>
            
            <div class="text-center">
                <a href="<?php echo site_url('home/free'); ?>" class="inline-flex items-center px-6 py-3 bg-white text-cyan-600 border border-cyan-200 rounded-lg font-medium hover:bg-cyan-50 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Lihat Semua Kelas Gratis
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <div class="flex items-center mb-4">
                        <span class="text-2xl font-bold gradient-text">Asset Academy</span>
                    </div>
                    <p class="text-gray-400 mb-4 max-w-md">
                        Platform pembelajaran programming terdepan yang membantu Anda menguasai skill programming dari level pemula hingga expert.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-linkedin-in text-xl"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Platform</h3>
                    <ul class="space-y-2">
                        <li><a href="<?php echo site_url('home/premium'); ?>" class="text-gray-400 hover:text-white transition-colors">Kelas Premium</a></li>
                        <li><a href="<?php echo site_url('home/free'); ?>" class="text-gray-400 hover:text-white transition-colors">Kelas Gratis</a></li>
                        <li><a href="<?php echo site_url('auth/login'); ?>" class="text-gray-400 hover:text-white transition-colors">Masuk</a></li>
                        <li><a href="<?php echo site_url('auth/register'); ?>" class="text-gray-400 hover:text-white transition-colors">Daftar</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Dukungan</h3>
                    <ul class="space-y-2">
                        <li><a href="<?php echo site_url('home/faq'); ?>" class="text-gray-400 hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="<?php echo site_url('home/about'); ?>" class="text-gray-400 hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Kontak</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Bantuan</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400">
                    &copy; <?php echo date('Y'); ?> Asset Academy. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Simple fade-in animation
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.fade-in').classList.add('opacity-100');
        });
    </script>
</body>
</html>
