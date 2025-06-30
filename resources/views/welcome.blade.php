<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Enha Petshop') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            /* Custom CSS jika diperlukan, untuk overrides atau efek khusus */
            .hero-bg {
                background-image: url('https://plus.unsplash.com/premium_photo-1707353401897-da9ba223f807?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); /* Ganti dengan gambar petshopmu */
                background-size: cover;
                background-position: center;
            }
        </style>
    </head>
    <body class="font-sans antialiased text-gray-900 dark:text-gray-100">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <div class="shrink-0 flex items-center">
                                <a href="{{ url('/') }}">
                                    {{-- <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" /> --}}
                                    <span class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">Enha Petshop</span>
                                </a>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            @if (Route::has('login'))
                                <div class="flex space-x-4">
                                    @auth
                                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Dashboard</a>
                                    @else
                                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Login</a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Register</a>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>

            <div class="hero-bg flex items-center justify-center min-h-[calc(100vh-64px)] text-center text-white p-6">
                <div class="bg-black bg-opacity-60 p-8 rounded-lg max-w-2xl mx-auto shadow-xl">
                    <h1 class="text-4xl sm:text-5xl font-extrabold mb-4 leading-tight">
                        Selamat Datang di <span class="text-indigo-400">Enha Petshop</span>!
                    </h1>
                    <p class="text-lg sm:text-xl mb-8 opacity-90">
                        Pusat layanan terbaik untuk hewan kesayangan Anda. Temukan berbagai produk, layanan grooming, dan reward poin menarik.
                    </p>
                    <div class="space-y-4 sm:space-y-0 sm:space-x-4 flex flex-col sm:flex-row justify-center">
                        <a href="{{ route('grooming.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition duration-300 transform hover:scale-105">
                            Lihat Layanan Grooming
                        </a>
                        <a href="{{ route('register') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition duration-300 transform hover:scale-105">
                            Daftar Sekarang!
                        </a>
                    </div>
                    @guest
                        <p class="mt-8 text-md opacity-80">
                            Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-indigo-300 hover:text-indigo-100 underline">Login di sini</a> untuk mendapatkan poin dan menukarkan reward!
                        </p>
                    @endguest
                </div>
            </div>

            <div class="py-16 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h2 class="text-3xl font-bold mb-8">Kenapa Memilih Enha Petshop?</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="p-6 bg-gray-50 dark:bg-gray-700 rounded-lg shadow-md">
                            <svg class="w-12 h-12 text-indigo-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <h3 class="text-xl font-semibold mb-2">Layanan Profesional</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm">Tim ahli kami siap memberikan perawatan terbaik untuk hewan kesayangan Anda.</p>
                        </div>
                        <div class="p-6 bg-gray-50 dark:bg-gray-700 rounded-lg shadow-md">
                            <svg class="w-12 h-12 text-green-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            <h3 class="text-xl font-semibold mb-2">Produk Berkualitas</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm">Berbagai pilihan makanan, mainan, dan aksesori dari merek terkemuka.</p>
                        </div>
                        <div class="p-6 bg-gray-50 dark:bg-gray-700 rounded-lg shadow-md">
                            <svg class="w-12 h-12 text-yellow-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.592 1L17.5 11.25m-3.5 3.5l2.25 2.25m-4 4L12 18l-3.5 1.5M4 12H3m18 0h-1M6.75 4.5l-1.5-1.5M7.5 20.25l-1.5-1.5M10.5 4.5h3m-6 6h6m-3 6h.01"></path></svg>
                            <h3 class="text-xl font-semibold mb-2">Rewards Menarik</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm">Dapatkan poin setiap transaksi dan tukarkan dengan hadiah istimewa.</p>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="bg-gray-800 dark:bg-gray-900 text-white py-8 mt-auto">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <p>&copy; {{ date('Y') }} Enha Petshop. All rights reserved.</p>
                    <p class="text-sm text-gray-400 mt-2">Dibuat dengan ❤️ untuk hewan kesayangan Anda.</p>
                </div>
            </footer>
        </div>
    </body>
</html>