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
    <!-- Firebase UI Auth CSS -->
    <link type="text/css" rel="stylesheet" href="https://www.gstatic.com/firebasejs/ui/6.0.1/firebase-ui-auth.css" />
    <!-- Firebase App (the core Firebase SDK) -->
    <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-app-compat.js"></script>
    <!-- Firebase Auth -->
    <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-auth-compat.js"></script>
    <!-- Firebase UI -->
    <script src="https://www.gstatic.com/firebasejs/ui/6.0.1/firebase-ui-auth.js"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-br from-indigo-500 to-purple-600">

    <!-- Header -->
    

    <div class="max-w-md w-full mx-8 p-8 bg-white rounded-lg shadow-lg transition-opacity duration-500 opacity-0">
        <div class="text-center mb-8">
            <center>
            <img src="<?= base_url('assets/img/logo.png') ?>" alt="ASET Academy" class="h-8">
</center>
        
        </div>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="mb-6 p-4 border-l-4 border-red-500 bg-red-50 rounded">
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
            <div class="mb-6 p-4 border-l-4 border-green-500 bg-green-50 rounded">
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
                    <input type="text" id="username" name="username" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan username" required>
                </div>
            </div>

            <div class="space-y-2">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input type="password" id="password" name="password" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan password" required>
                </div>
            </div>

            <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Login
                </button>
            </div>
        <?php echo form_close(); ?>

        <!-- Divider -->
        <!-- <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">Atau masuk dengan</span>
            </div>
        </div>

        <div id="firebaseui-auth-container"></div>
        <div id="loader" class="text-center hidden">
            <div class="inline-block animate-spin rounded-full h-5 w-5 border-t-2 border-b-2 border-blue-500"></div>
            <p class="text-sm text-gray-600 mt-2">Mengautentikasi...</p>
        </div>
        <div id="firebaseui-auth-errors" class="mt-2 text-red-600 text-sm text-center"></div>

        <div class="mt-6 text-center text-sm text-gray-500">
            <p>Belum punya akun? <a href="<?php echo site_url('auth/register'); ?>" class="text-blue-500 hover:text-blue-600">Daftar di sini</a></p>
        </div> -->
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginCard = document.querySelector('.transition-opacity');
            if (loginCard) {
                loginCard.classList.add('opacity-100');
            }

            // Firebase configuration from config file
            const firebaseConfig = {
                apiKey: "<?php echo $firebase['api_key']; ?>",
                authDomain: "<?php echo $firebase['auth_domain']; ?>",
                projectId: "<?php echo $firebase['project_id']; ?>",
                storageBucket: "<?php echo $firebase['storage_bucket']; ?>",
                messagingSenderId: "<?php echo $firebase['messaging_sender_id']; ?>",
                appId: "<?php echo $firebase['app_id']; ?>"
            };

            // Initialize Firebase
            firebase.initializeApp(firebaseConfig);

            // Initialize the FirebaseUI Widget using Firebase
            const ui = new firebaseui.auth.AuthUI(firebase.auth());
            
            // FirebaseUI config
            const uiConfig = {
                callbacks: {
                    signInSuccessWithAuthResult: function(authResult, redirectUrl) {
                        // User successfully signed in.
                        // Return type determines whether we continue the redirect automatically
                        // or whether we leave that to developer to handle.
                        const user = authResult.user;
                        const credential = authResult.credential;
                        const isNewUser = authResult.additionalUserInfo.isNewUser;
                        
                        // Show loader
                        document.getElementById('firebaseui-auth-container').classList.add('hidden');
                        document.getElementById('loader').classList.remove('hidden');
                        
                        // Send the ID token to your backend for verification
                        user.getIdToken().then(function(idToken) {
                            return fetch('<?= site_url('auth/firebase_auth') ?>', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({ idToken: idToken })
                            });
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                window.location.href = data.redirectUrl || '/';
                            } else {
                                document.getElementById('firebaseui-auth-errors').textContent = data.message || 'Terjadi kesalahan saat login';
                                document.getElementById('firebaseui-auth-container').classList.remove('hidden');
                                document.getElementById('loader').classList.add('hidden');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            document.getElementById('firebaseui-auth-errors').textContent = 'Terjadi kesalahan saat login';
                            document.getElementById('firebaseui-auth-container').classList.remove('hidden');
                            document.getElementById('loader').classList.add('hidden');
                        });
                        
                        return false; // Don't redirect, we'll handle it after backend verification
                    },
                    uiShown: function() {
                        // The widget is rendered.
                        document.getElementById('loader').classList.add('hidden');
                    }
                },
                // Will use popup for IDP Providers sign-in flow instead of the default, redirect.
                signInFlow: 'popup',
                signInSuccessUrl: '/',
                signInOptions: [
                    // Leave the lines as is for the providers you want to offer your users.
                    firebase.auth.GoogleAuthProvider.PROVIDER_ID,
                ],
                // Terms of service url.
                tosUrl: '<?= site_url('terms') ?>',
                // Privacy policy url.
                privacyPolicyUrl: '<?= site_url('privacy') ?>',
                // Optional: Customize the display of the provider buttons
                credentialHelper: firebaseui.auth.CredentialHelper.GOOGLE_YOLO
            };

            // The start method will wait until the DOM is loaded.
            ui.start('#firebaseui-auth-container', uiConfig);
        });
    </script>
</body>
</html>