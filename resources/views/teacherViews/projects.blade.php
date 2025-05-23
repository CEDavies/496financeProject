<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Projects</title>
        <!-- The include counted as a view and so it wouldn't work on the main php page it was trying to load-->
    
        @vite(['resources/css/app.css', 'resources/js/teacherJS/projects.js'])
    </head>
    <body class="font-sans antialiased dark:bg-white">
        <div id="teachProject"
            home-route="{{ route('home') }}"
            project-route="{{ route('projects') }}"
            manage-stud="{{ route('manageStud') }}"
            manage-invest="{{ route('manageInvest') }}"
            report-route="{{ route('reports') }}"
        >
            <projects/>
        </div>
    </body>
</html>
