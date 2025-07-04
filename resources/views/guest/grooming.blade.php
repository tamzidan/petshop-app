{{-- resources/views/grooming/index.blade.php --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="{{ asset('images/telapak-kaki-kucing.png') }}" type="image/x-icon">
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
                                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Dashboard</a>
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

            <div class="bg-white dark:bg-yellow-500 overflow-hidden shadow-lg border border-orange-100 dark:border-orange-700">

                <div class="bg-amber-700 p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Layanan Grooming Kami</h3>
                            <p class="text-sm opacity-90">Pilih Paket Grooming Terbaik untuk Hewan Peliharaan Anda!</p>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    @if (session('success'))
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 text-yellow-700 dark:text-yellow-300 px-4 py-3 rounded-xl mb-6 flex items-center space-x-3">
                            <div class="w-6 h-6 bg-yellow-100 dark:bg-yellow-800 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-3 h-3 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-sm sm:text-base">{!! session('success') !!}</span>
                        </div>
                    @endif

                    {{-- <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('grooming.history') }}" class="bg-gradient-to-r from-yellow-500 to-amber-500 hover:from-yellow-600 hover:to-amber-600 text-white font-medium px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                <span>Riwayat Grooming</span>
                            </div>
                        </a>
                        <a href="{{ url('/dashboard') }}" class="bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white font-medium px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                <span>Kembali ke Dashboard</span>
                            </div>
                        </a>
                    </div> --}}


                <div class="p-6">
                    {{-- <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-8 text-center">Pilih Paket Grooming Terbaik untuk Hewan Peliharaan Anda!</h3> --}}

                    @foreach ($groomingOptions as $petType => $groomingTypes)
                        <div class="mb-12">
                            <h4 class="text-xl font-semibold text-orange-700 dark:text-orange-800 mb-6 border-b-2 border-amber-300 dark:border-amber-700 pb-3 text-center">
                                Grooming {{ ucfirst($petType) }} ({{ $petType === 'kitten' ? 'Anak Kucing' : 'Kucing Dewasa' }})
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                @foreach ($groomingTypes as $groomingKey => $details)
                                    <div class="bg-white dark:bg-gray-700 border border-amber-100 dark:border-gray-600 rounded-2xl p-6 flex flex-col justify-between shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group">
                                        <div>
                                            <h5 class="text-xl font-bold text-amber-700 dark:text-amber-400 mb-3 text-center group-hover:text-amber-800 dark:group-hover:text-amber-300 transition-colors">
                                                {{ Str::title(str_replace('_', ' ', $groomingKey)) }}
                                            </h5>
                                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-4 text-center">Keuntungan:</p>
                                            <ul class="list-disc list-inside text-sm text-gray-700 dark:text-gray-200 mb-6 space-y-1">
                                                @forelse ($details['benefits'] as $benefit)
                                                    <li>{{ $benefit }}</li>
                                                @empty
                                                    <li>Tidak ada keuntungan spesifik yang terdaftar.</li>
                                                @endforelse
                                            </ul>
                                        </div>
                                        <div class="mt-auto pt-4 border-t border-amber-100 dark:border-gray-600">
                                            <p class="text-center text-3xl font-extrabold text-yellow-600 dark:text-yellow-400 mb-4">
                                                Rp{{ number_format($details['price'], 0, ',', '.') }}
                                            </p>
                                            <a href="{{ route('grooming.book.create', ['petType' => $petType, 'groomingType' => Str::title(str_replace('_', ' ', $groomingKey))]) }}" class="block w-full text-center px-4 py-3 bg-gradient-to-r from-yellow-500 to-amber-600 hover:from-yellow-600 hover:to-amber-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                                                Booking Sekarang!
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                </div>
                </div>
            </div>

            <footer class="bg-gray-800 dark:bg-gray-900 text-white py-8 mt-auto">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <p>&copy; {{ date('Y') }} Enha Petshop. All rights reserved.</p>
                    <p class="text-sm text-gray-400 mt-2">Dibuat dengan ❤️ untuk hewan kesayangan Anda.</p>
                </div>
            </footer>

    </body>
</html>