<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="{{ asset('images/telapak-kaki-kucing.png') }}" type="image/x-icon">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-yellow-500">
            <nav class="bg-white dark:bg-amber-800 border-b border-amber-100 dark:border-amber-700 shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <div class="shrink-0 flex items-center">
                                <a href="{{ url('/') }}">
                                    {{-- <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" /> --}}
                                    <span class="flex text-2xl font-bold text-orange-600 dark:text-orange-400">
                                        <x-application-logo class="h-6 w-auto me-2" />Enha Petshop
                                    </span>
                                </a>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            @if (Route::has('login'))
                                <div class="flex space-x-4">
                                    @auth
                                        <a href="{{ url('/dashboard') }}" class="font-semibold text-amber-600 hover:text-amber-900 dark:text-amber-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Dashboard</a>
                                    @else
                                        <a href="{{ route('login') }}" class="font-semibold text-amber-600 hover:text-amber-900 dark:text-yellow-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Login</a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="font-semibold text-amber-600 hover:text-amber-900 dark:text-yellow-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Register</a>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-yellow-500 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @stack('scripts') {{-- <-- PASTIKAN BARIS INI ADA --}}
    </body>
</html>
