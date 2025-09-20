<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-white text-gray-900"> 
    <div class="min-h-screen flex flex-col">
        @include('layouts.navigation')

        <main class="flex-1">
            @yield('content')
        </main>
    </div>
</body>
</html>
