<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Student Dashboard</title>
        <!-- The include counted as a view and so it wouldn't work on the main php page it was trying to load-->
        @vite(['resources/css/app.css', 'resources\js\studentJS\studDashboard.js'])

    </head>
    <body class="font-sans antialiased dark:bg-white">
            <!-- Define a div with a Vue component -->
            <div id="studDashboard">
                <studDashboard :file-upload-url="{{ json_encode(route('file.store')) }}"></studDashboard>
            </div>

    </body>
</html>
