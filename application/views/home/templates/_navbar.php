<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<nav class="fixed w-full bg-white/80 backdrop-blur-sm shadow-md z-50 transition-all duration-300">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <img src="<?= base_url('assets/img/logo.png') ?>" alt="ASET Academy" class="h-8">
        </div>
        
        <div class="hidden md:flex space-x-8">
            <a href="<?= site_url('home') ?>" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">Beranda</a>
            <a href="<?= site_url('home/premium') ?>" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">Kelas Premium</a>
            <a href="<?= site_url('home/free') ?>" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">Kelas Gratis</a>
            <a href="<?= site_url('home/digital_solutions') ?>" class="text-emerald-600 hover:text-emerald-700 font-medium transition-colors">💻 Solusi Digital</a>
            <a href="<?= site_url('home/partnership') ?>" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">Partnership</a>
            <a href="<?= site_url('home/about') ?>" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">Tentang Kami</a>
            <a href="<?= site_url('home/faq') ?>" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">FAQ</a>
        </div>
        
        <div class="flex items-center space-x-4">
            <a href="<?= site_url('auth/login') ?>" class="hidden md:block px-4 py-2 text-blue-600 font-medium hover:text-blue-700 transition-colors">Masuk</a>
            <a href="<?= site_url('auth/register') ?>" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors">Daftar</a>
            <button class="md:hidden">
                <i data-feather="menu" class="w-6 h-6 text-gray-700"></i>
            </button>
        </div>
    </div>
</nav>
