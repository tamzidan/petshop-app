{{-- resources/views/dashboard.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Selamat datang, {{ Auth::user()->name }}!</h3>
                    <p class="mt-2 text-base text-gray-700">
                        {{ __("Anda berhasil masuk ke dashboard aplikasi Petshop.") }}
                    </p>

                    @if (Auth::user()->role === 'user')
                        <div class="mt-8 p-6 bg-blue-50 border border-blue-200 rounded-lg text-center shadow-md">
                            <p class="text-lg font-bold text-blue-800">Poin Anda saat ini:</p>
                            <p class="text-5xl font-extrabold text-green-600 mt-2">{{ Auth::user()->points }}</p>
                            <p class="text-sm text-gray-500 mt-1">Gunakan poin Anda untuk menukarkan berbagai hadiah menarik!</p>
                        </div>

                        <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <a href="{{ route('redeem.index') }}" class="flex items-center justify-center p-6 bg-indigo-600 text-white rounded-lg shadow-lg hover:bg-indigo-700 transition duration-300 ease-in-out transform hover:scale-105 text-lg font-semibold">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.592 1L17.5 11.25m-3.5 3.5l2.25 2.25m-4 4L12 18l-3.5 1.5M4 12H3m18 0h-1M6.75 4.5l-1.5-1.5M7.5 20.25l-1.5-1.5M10.5 4.5h3m-6 6h6m-3 6h.01"></path></svg>
                                Tukar Poin Sekarang!
                            </a>
                            <a href="{{ route('redeem.history') }}" class="flex items-center justify-center p-6 bg-gray-200 text-gray-800 rounded-lg shadow-lg hover:bg-gray-300 transition duration-300 ease-in-out transform hover:scale-105 text-lg font-semibold">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                Lihat Riwayat Penukaran
                            </a>
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