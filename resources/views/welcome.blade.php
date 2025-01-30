<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>STEM Finance</title>
        <!-- Path is needed for the Vite Manifest to work-->
        @include('/GitHub/496financeProject')
    
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased dark:bg-white">
        <div id="app">
            <counter />
        </div>
    </body>
</html>
