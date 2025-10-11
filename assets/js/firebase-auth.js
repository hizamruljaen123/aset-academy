/**
 * Firebase Authentication JavaScript
 * Handles Firebase UI authentication for login page
 *
 * Required global variables from PHP:
 * - firebaseAuthUrl: URL for Firebase authentication endpoint
 * - termsUrl: Terms of service URL
 * - privacyUrl: Privacy policy URL
 */

document.addEventListener('DOMContentLoaded', function() {
    const loginCard = document.querySelector('.transition-opacity');
    if (loginCard) {
        loginCard.classList.add('opacity-100');
    }

    // Firebase configuration from PHP variables
    const firebaseConfig = {
        apiKey: window.firebaseConfig.apiKey,
        authDomain: window.firebaseConfig.authDomain,
        projectId: window.firebaseConfig.projectId,
        storageBucket: window.firebaseConfig.storageBucket,
        messagingSenderId: window.firebaseConfig.messagingSenderId,
        appId: window.firebaseConfig.appId
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
                    return fetch(window.firebaseAuthUrl, {
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
        tosUrl: window.termsUrl,
        // Privacy policy url.
        privacyPolicyUrl: window.privacyUrl,
        // Optional: Customize the display of the provider buttons
        credentialHelper: firebaseui.auth.CredentialHelper.GOOGLE_YOLO
    };

    // The start method will wait until the DOM is loaded.
    ui.start('#firebaseui-auth-container', uiConfig);
});
