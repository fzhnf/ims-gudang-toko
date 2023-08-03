<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Inventory Management System</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">

        <style>
            @keyframes slideDown {
                from {
                    transform: translateY(-20%);
                    opacity: 0;
                }
                to {
                    transform: translateY(0);
                    opacity: 1;
                }
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-cover bg-center" style="background-image: url('/img/welcome-bg.jpg');">
        <div class="flex justify-center items-center h-screen bg-opacity-25 bg-white dark:bg-opacity-50">
            @if (Route::has('login'))
            <div class="bg-white dark:bg-gray-800 bg-opacity-50 dark:bg-opacity-50 rounded-lg shadow-md p-8" style="animation: slideDown 1s ease;">
                <img src="/img/inventory-logo.png" class="mr-auto ml-auto mb-2" alt="inv" srcset="">
                <div class="text-center">
                    <h1 class="text-4xl font-semibold text-gray-800 dark:text-white mb-3">Inventory Management System</h1>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-block px-6 py-3 font-semibold text-white bg-green-500 rounded-lg shadow-md hover:bg-green-600">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="inline-block px-6 py-3 font-semibold text-white bg-blue-500 rounded-lg shadow-md hover:bg-blue-600">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-block px-6 py-3 mt-4 font-semibold text-white bg-purple-500 rounded-lg shadow-md hover:bg-purple-600">Register</a>
                        @endif
                    @endauth
                </div>
            </div>
            @endif
        </div>
    </body>
</html>
