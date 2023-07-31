<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Inventory Management System</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
        <link href="{{ asset('/') }}assets/plugin/fontawesome/css/all.min.css" rel="stylesheet"/>
        
        {{-- Style --}}
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

            @keyframes slideRight {
                from {
                    transform: translateX(-5%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
          </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-200">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header>
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8" style="animation: slideDown 1s ease;">
                        {{ $header }}
                    </div>
                </header>
            @endif
            <!-- Page Content -->
            <main>
                <div class="max-w-7xl mx-auto pb-14 px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
