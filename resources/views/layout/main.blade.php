@props(['center' => false])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body @class(["bg-gray-100 min-h-screen flex flex-col items-center", "justify-center" => $center])>
        <main class="grow flex flex-col items-center {{ $center ? 'justify-center' : null }}">
            {{ $slot }}
        </main>
        <footer class="h-auto">
            <p class="text-center text-sm text-gray-500 hover:text-black transition-all">
                &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}
            </p>
        </footer>
    </body>
</html>