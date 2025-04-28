<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login</title>
        @vite(['resources/css/app.css', 'resources/js/login.js'])

        <!-- Google Sign-In SDK -->
        <script src="https://apis.google.com/js/platform.js" async defer></script>
    </head>
    <body class="font-sans antialiased dark:bg-white">
        <div id="login">
            <!-- Google Login Button -->
            <div class="g-signin2" data-onsuccess="onSignIn"></div>
        </div>

        <!-- JavaScript to handle Google Sign-In -->
        <script type="text/javascript">
            function onSignIn(googleUser) {
                var id_token = googleUser.getAuthResponse().id_token;
                // Send the token to your server for validation
                fetch('/auth/callback/google', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ token: id_token })
                })
                .then(response => response.json())
                .then(data => {
                    // Handle response from your backend
                    console.log(data);
                    window.location.href = '/dashboard'; // Redirect after successful login
                })
                .catch(error => console.log('Error:', error));
            }
        </script>
    </body>
</html>
