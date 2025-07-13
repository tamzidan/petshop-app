{{-- resources/views/admin/dashboard.blade.php --}}

<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Header Sambutan --}}
            <div class="bg-gradient-to-r from-orange-500 via-amber-500 to-yellow-400 p-8 text-white rounded-2xl shadow-xl mb-10 text-center">
                <h1 class="text-3xl md:text-4xl font-extrabold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h1>
                <p class="text-lg opacity-90">Ini adalah pusat kontrol untuk semua fitur Petshop Anda.</p>
            </div>

            {{-- Grid Menu Navigasi --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                
                {{-- Kartu Menu: Manajemen Produk Poin --}}
                <a href="{{ route('admin.products.index') }}" class="group block p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:border-orange-400">
                    <div class="flex items-center justify-center w-12 h-12 bg-orange-100 dark:bg-orange-900/50 rounded-full mb-4 transition-all duration-300 group-hover:bg-orange-500">
                        <svg class="w-6 h-6 text-orange-600 dark:text-orange-300 transition-all duration-300 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-1">Manajemen Produk</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Kelola produk yang bisa ditukar dengan poin.</p>
                </a>

                {{-- Kartu Menu: Kelola Poin User --}}
                <a href="{{ route('admin.points.create') }}" class="group block p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:border-amber-400">
                    <div class="flex items-center justify-center w-12 h-12 bg-amber-100 dark:bg-amber-900/50 rounded-full mb-4 transition-all duration-300 group-hover:bg-amber-500">
                        <svg class="w-6 h-6 text-amber-600 dark:text-amber-300 transition-all duration-300 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-1">Kelola Poin</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Tambah atau kurangi poin milik pengguna.</p>
                </a>
                
                {{-- Kartu Menu: Klaim Voucher --}}
                <a href="{{ route('admin.redemptions.index') }}" class="group block p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:border-yellow-400">
                    <div class="flex items-center justify-center w-12 h-12 bg-yellow-100 dark:bg-yellow-900/50 rounded-full mb-4 transition-all duration-300 group-hover:bg-yellow-500">
                        <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-300 transition-all duration-300 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-1.5h5.25m-5.25 0h3m-3 0h-3m2.25-4.5a3 3 0 013-3h1.5a3 3 0 013 3v.75m-6 0v-1.5m-3.75 3a3 3 0 013-3h1.5a3 3 0 013 3v.75m-6 0v-1.5m0 0h-3.75" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-1">Klaim & Riwayat</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Proses klaim voucher dan lihat semua riwayat.</p>
                </a>
                
                {{-- Kartu Menu: Daftar Poin User --}}
                <a href="{{ route('admin.points.index') }}" class="group block p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:border-orange-400">
                    <div class="flex items-center justify-center w-12 h-12 bg-orange-100 dark:bg-orange-900/50 rounded-full mb-4 transition-all duration-300 group-hover:bg-orange-500">
                        <svg class="w-6 h-6 text-orange-600 dark:text-orange-300 transition-all duration-300 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m-7.5-2.962A3.375 3.375 0 019 12.75l-1.546.927a3.375 3.375 0 00-3.808 4.971 4.5 4.5 0 005.454 1.272M12 12a3.375 3.375 0 100-6.75 3.375 3.375 0 000 6.75zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-1">Daftar Poin</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Lihat peringkat dan saldo poin semua pengguna.</p>
                </a>

            </div>

        </div>
    </div>
</x-app-layout>