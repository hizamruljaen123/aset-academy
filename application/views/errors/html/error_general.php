<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$base_url = config_item('base_url');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Error</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
    body {
        font-family: 'Poppins', sans-serif;
    }
</style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="text-center p-8 bg-white rounded-2xl shadow-2xl max-w-lg w-full transform transition-all hover:scale-105 duration-500">
        
        <div class="mb-6">
             <img src="https://raw.githubusercontent.com/hizamruljaen123/aset-academy/main/assets/img/error.svg" alt="General Error" class="mx-auto w-64 h-64">
        </div>
        
        <h1 class="text-4xl font-bold text-red-600 mb-2"><?php echo $heading; ?></h1>

        <div class="text-gray-600 mb-8 bg-gray-50 p-4 rounded-lg">
            <?php echo $message; ?>
        </div>

        <a href="<?php echo $base_url; ?>" class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-gradient-to-r from-red-500 to-orange-500 hover:from-red-600 hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-300 hover:scale-105">
            <i class="fas fa-home mr-2"></i>
            Kembali ke Beranda
        </a>
    </div>
</body>
</html>