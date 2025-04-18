<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>STEM Finance</title>
        <!-- The include counted as a view and so it wouldn't work on the main php page it was trying to load-->
    
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased dark:bg-white">
        <div id="app">
            <!-- There can only be one vue per page? -->
            <welcome :login-route="'{{ route('login') }}'" :signup-route="'{{ route('signup') }}'"/>
        </div>
    </body>
</html>
