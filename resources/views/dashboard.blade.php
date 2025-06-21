{{-- resources/views/dashboard.blade.php --}}

<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-green-50 dark:from-gray-900 dark:to-green-900 p-4">
        <!-- Header Section -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mb-6 border border-blue-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-green-600 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800 dark:text-white">Hi, {{ auth()->user()->name }}</h1>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Selamat datang di PetShop</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-sm text-gray-600 dark:text-gray-300">Saldo Poin</div>
                    <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ auth()->user()->points }}</div>
                </div>
            </div>
            
            <div class="mt-4">
                <a href="{{ route('redeem.index') }}" class="block w-full px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-xl text-center transition-all duration-200">
                    Tukarkan Point
                </a>
            </div>
            <div class="mt-4">
                <a href="{{ route('redeem.history') }}" class="block w-full px-6 py-3 bg-gray-200 text-gray-800 hover:bg-gray-300 font-medium rounded-xl text-center transition-all duration-200">
                    Riwayat Penukaran
                </a>
            </div>

        </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (Auth::user()->role === 'user')
                    <!-- Menu Grid -->
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        <!-- Shop -->
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-orange-100 dark:border-gray-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer group">
                            <div class="flex flex-col items-center text-center space-y-3">
                                <div class="w-16 h-16 bg-gradient-to-r from-orange-400 to-red-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 dark:text-white group-hover:text-orange-500 transition-colors">Shop</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Makanan & Aksesoris</p>
                            </div>
                        </div>

                        <!-- Grooming -->
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-green-100 dark:border-gray-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer group">
                            <a href="grooming">
                            <div class="flex flex-col items-center text-center space-y-3">
                                <div class="w-16 h-16 bg-gradient-to-r from-green-400 to-teal-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM7 3V1m10 20a4 4 0 004-4V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4zM17 3V1"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 dark:text-white group-hover:text-green-500 transition-colors">Grooming</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Perawatan Hewan</p>
                            </div>
                            </a>
                        </div>

                        <!-- Clinic -->
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-blue-100 dark:border-gray-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer group">
                            <div class="flex flex-col items-center text-center space-y-3">
                                <div class="w-16 h-16 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 dark:text-white group-hover:text-blue-500 transition-colors">Clinic</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Kesehatan Hewan</p>
                            </div>
                        </div>

                        <!-- Hotel -->
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-green-100 dark:border-gray-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer group">
                            <div class="flex flex-col items-center text-center space-y-3">
                                <div class="w-16 h-16 bg-gradient-to-r from-green-400 to-pink-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 dark:text-white group-hover:text-green-500 transition-colors">Hotel</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Penitipan Hewan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Promo/Banner Section -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-yellow-100 dark:border-gray-700 mb-6">
                        <div class="bg-gradient-to-r from-yellow-400 via-orange-400 to-red-400 p-6">
                            <div class="flex items-center justify-between">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-2">Promo Spesial!</h3>
                                    <p class="text-sm opacity-90">Diskon 20% untuk semua layanan grooming</p>
                                    <p class="text-xs opacity-75 mt-1">Berlaku hingga akhir bulan</p>
                                </div>
                                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 border border-gray-100 dark:border-gray-700">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-gray-800 dark:text-white">12</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Pesanan Aktif</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 border border-gray-100 dark:border-gray-700">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-gray-800 dark:text-white">3</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Jadwal Hari Ini</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 border border-gray-100 dark:border-gray-700">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-gray-800 dark:text-white">8</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Hewan Favorit</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 border border-gray-100 dark:border-gray-700">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-orange-100 dark:bg-orange-900 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-gray-800 dark:text-white">500</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Total Poin</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-100 dark:border-gray-700">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">Aktivitas Terbaru</h3>
                            <button class="text-green-600 dark:text-green-400 text-sm font-medium hover:text-green-700 dark:hover:text-green-300">
                                Lihat Semua
                            </button>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex items-center space-x-4 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-800 dark:text-white">Grooming untuk Fluffy selesai</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">2 jam yang lalu</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-800 dark:text-white">Pembelian makanan kucing berhasil</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">1 hari yang lalu</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-800 dark:text-white">Jadwal checkup Milo terjadwal</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">3 hari yang lalu</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if (Auth::user()->role === 'admin')
                        <div class="mt-8 p-6 bg-yellow-50 border border-yellow-200 rounded-lg text-center shadow-md">
                            <p class="text-lg font-bold text-yellow-800">Anda masuk sebagai Admin.</p>
                            <p class="mt-3 text-base text-yellow-700">Gunakan dashboard admin untuk mengelola produk, poin, dan penukaran.</p>
                            <a href="{{ route('admin.dashboard') }}" class="mt-6 inline-flex items-center px-6 py-3 bg-yellow-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.52-1.728 2.016-1.728 2.535 0L15.34 9.5a.75.75 0 00.5.215h5.518a.75.75 0 01.564 1.258l-4.47 5.587a.75.75 0 00-.282.81l1.79 5.517c.15.462-.218.91-.676.77L12 20.354l-5.783 2.115c-.458.134-.826-.308-.676-.77l1.79-5.517a.75.75 0 00-.282-.81L2.078 10.973a.75.75 0 01.564-1.258h5.518a.75.75 0 00.5-.215l2.536-5.183z"></path></svg>
                                Pergi ke Dashboard Admin
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>