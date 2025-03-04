<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Reports</title>
        <!-- The include counted as a view and so it wouldn't work on the main php page it was trying to load-->
    
        @vite(['resources/css/app.css', 'resources/js/teacherJS/reports.js'])
    </head>
    <body class="font-sans antialiased dark:bg-white">
        <div id="reports">
            <reports/>
        </div>
    </body>
</html>
