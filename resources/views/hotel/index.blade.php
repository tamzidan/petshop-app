{{-- resources/views/hotel/index.blade.php --}}
<x-app-layout>
    <div class="sm:py-12 lg:py-12 bg-yellow-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl border border-yellow-100 dark:border-gray-700">

                {{-- Bagian Header --}}
                <div class="bg-gradient-to-r from-orange-700 to-yellow-600 p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Layanan Hotel Terbaik Untuk Anabul</h3>
                            <p class="text-sm opacity-90">Tempat penitipan yang aman, nyaman, dan penuh perhatian.</p>
                        </div>
                    </div>
                </div>

                {{-- Konten Utama --}}
                <div class="p-6 md:p-8 text-gray-800 dark:text-gray-200">

                    {{-- Deskripsi Layanan --}}
                    <div class="text-center mb-8">
                        <h4 class="text-xl font-bold text-orange-600 dark:text-orange-400">Mengapa Memilih Hotel Kami?</h4>
                        <p class="mt-2 text-gray-600 dark:text-gray-300">Kami menyediakan lebih dari sekadar tempat menginap. Kami memberikan pengalaman liburan yang menyenangkan untuk hewan kesayangan Anda dengan fasilitas dan perawatan premium.</p>
                    </div>

                    {{-- Detail Fasilitas & Harga --}}
                    <div class="grid md:grid-cols-2 gap-8 items-center bg-gray-50 dark:bg-gray-700/50 p-6 rounded-xl border border-gray-200 dark:border-gray-700">
                        {{-- Daftar Fasilitas --}}
                        <div>
                            <h5 class="font-bold mb-4 text-lg">Fasilitas yang Didapat:</h5>
                            <ul class="space-y-3">
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span>Kandang higienis & luas dengan sirkulasi udara baik.</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span>Pakan berkualitas (2x sehari) & air minum bersih.</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span>Area bermain indoor yang aman dan terkontrol.</span>
                                </li>
                                 <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span>Update foto/video harian via WhatsApp.</span>
                                </li>
                            </ul>
                        </div>
                        {{-- Harga & Tombol Booking --}}
                        <div class="text-center bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                            <p class="text-gray-500 dark:text-gray-400">Harga Mulai Dari</p>
                            <p class="text-4xl font-extrabold my-2 text-orange-600 dark:text-orange-400">Rp50.000</p>
                            <p class="text-gray-500 dark:text-gray-400">/malam per ekor</p>
                            
                            {{-- Tombol Booking Sekarang --}}
                            <a href="{{ route('hotel.create') }}" class="mt-6 block w-full bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white font-bold px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span>Booking Hotel Sekarang!</span>
                                </div>
                            </a>
                        </div>
                    </div>

                     {{-- Tombol Navigasi Bawah --}}
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row gap-3 justify-center">
                        <a href="{{ route('hotel.history') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 font-medium px-6 py-3 rounded-xl transition-all duration-300 shadow-sm text-center">
                            Riwayat Order Hotel
                        </a>
                        <a href="{{ url('/dashboard') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 font-medium px-6 py-3 rounded-xl transition-all duration-300 shadow-sm text-center">
                            Kembali ke Dashboard
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>