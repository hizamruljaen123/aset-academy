<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Asset Academy</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <div class="min-h-screen flex">
        <!-- Left Side - Image Section (50%) -->
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-indigo-600 to-purple-700 p-12 flex-col justify-center relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-10 left-10 w-20 h-20 bg-white rounded-full"></div>
                <div class="absolute top-32 right-20 w-16 h-16 bg-yellow-300 rounded-full"></div>
                <div class="absolute bottom-20 left-20 w-24 h-24 bg-pink-300 rounded-full"></div>
                <div class="absolute bottom-32 right-10 w-12 h-12 bg-green-300 rounded-full"></div>
            </div>

            <div class="relative z-10">
                <!-- Logo -->
                <div class="mb-8" data-aos="fade-down" data-aos-duration="1000">
                    <img src="<?= base_url('assets/img/logo-white.png') ?>" alt="ASET Academy" class="h-12" onerror="this.src='<?= base_url('assets/img/logo.png') ?>'">
                </div>

                <!-- Main Content -->
                <div class="text-white" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                        Heyy Dev !<br>
                    </h1>
                    

                    <!-- Programming Memes Section -->
                    <div class="mb-8">
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 border border-white/20">
                            <div class="text-left">
                                <i class="fas fa-laugh-beam text-yellow-300 text-2xl mb-2"></i>
                                <div id="meme-text" class="text-lg font-medium min-h-[2rem] flex items-letf justify-"></div>
                                
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form (50%) -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <!-- Mobile Logo -->
                <div class="lg:hidden text-center mb-8" data-aos="fade-down">
                    <img src="<?= base_url('assets/img/logo.png') ?>" alt="ASET Academy" class="h-10 mx-auto">
                </div>

                <!-- Login Card -->
                <div class="bg-white rounded-2xl shadow-xl p-8 transition-all duration-500 opacity-0 transform translate-y-4" data-aos="fade-up" data-aos-duration="1000">
                    <div class="text-center mb-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Selamat Datang Kembali</h2>
                        <p class="text-gray-600">Masuk ke akun Anda untuk melanjutkan pembelajaran</p>
                    </div>

                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="mb-6 p-4 border-l-4 border-red-500 bg-red-50 rounded-lg" data-aos="fade-down">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-circle text-red-600 mr-3"></i>
                                <div>
                                    <p class="font-semibold text-red-800">Error</p>
                                    <p class="text-red-700 text-sm"><?php echo $this->session->flashdata('error'); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="mb-6 p-4 border-l-4 border-green-500 bg-green-50 rounded-lg" data-aos="fade-down">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-600 mr-3"></i>
                                <div>
                                    <p class="font-semibold text-green-800">Success</p>
                                    <p class="text-green-700 text-sm"><?php echo $this->session->flashdata('success'); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php echo form_open('auth', 'class="space-y-4"'); ?>
                        <div class="space-y-2">
                            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <input type="text" id="username" name="username" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Masukan username" required>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input type="password" id="password" name="password" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Masukan password" required>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Login
                            </button>
                        </div>
                    <?php echo form_close(); ?>

                    <div class="mt-6 text-center text-sm text-gray-500">
                        <p>Belum punya akun? <a href="<?php echo site_url('auth/register'); ?>" class="text-blue-500 hover:text-blue-600">Daftar di sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            AOS.init();

            // Programming memes array
            const programmingMemes = [
                "Code like a boss, debug like a ninja 🥷",
                "First rule of programming: If it works, don't touch it ⚠️",
                "There are only 10 types of people: those who understand binary and those who don't 🔢",
                "Programming is 10% writing code and 90% understanding why it's not working 🐛",
                "I don't always test my code, but when I do, I do it in production 🚀",
                "Keep calm and code on ☕",
                "Eat, sleep, code, repeat 🔄",
                "Code is poetry written by machines 📝",
                "Real programmers count from 0 🎯",
                "JavaScript: because you need to break things sometimes 💥",
                "Git happens... when you least expect it 🌪️",
                "Life is too short for bad coffee and slow internet ☕⚡",
                "The best way to predict the future is to code it yourself 🔮",
                "Debugging: Being the detective in a crime movie where you are also the murderer 🕵️",
                "A good programmer is someone who always looks both ways before crossing a one-way street 👀"
            ];

            let currentMemeIndex = 0;
            const memeTextElement = document.getElementById('meme-text');

            // Function to change meme text with fade effect
            function changeMeme() {
                if (memeTextElement) {
                    memeTextElement.style.opacity = '0';

                    setTimeout(() => {
                        memeTextElement.textContent = programmingMemes[currentMemeIndex];
                        memeTextElement.style.opacity = '1';
                        currentMemeIndex = (currentMemeIndex + 1) % programmingMemes.length;
                    }, 300);
                }
            }

            // Start meme rotation
            if (memeTextElement) {
                memeTextElement.textContent = programmingMemes[0];
                memeTextElement.style.opacity = '1';
                memeTextElement.style.transition = 'opacity 0.3s ease-in-out';
            }

            setInterval(changeMeme, 3000);

            // Animate login card
            setTimeout(() => {
                const loginCard = document.querySelector('.bg-white.rounded-2xl');
                if (loginCard) {
                    loginCard.classList.remove('opacity-0', 'translate-y-4');
                    loginCard.classList.add('opacity-100', 'translate-y-0');
                }
            }, 100);
        });
    </script>
</body>
</html>