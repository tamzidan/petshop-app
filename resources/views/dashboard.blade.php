{{-- Dashboard User --}}

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
                    <h3 class="text-lg font-medium text-gray-900">Selamat datang, {{ Auth::user()->name }}!</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        {{ __("Anda berhasil masuk ke dashboard.") }}
                    </p>

                    @if (Auth::user()->role === 'user')
                        <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <p class="text-md font-bold text-blue-800">Poin Anda saat ini: <span class="text-xl text-green-600">{{ Auth::user()->points }}</span></p>
                        </div>

                        <div class="mt-8 flex space-x-4">
                            <a href="{{ route('redeem.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Tukar Poin Sekarang!
                            </a>
                            <a href="{{ route('redeem.history') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Lihat Riwayat Penukaran
                            </a>
                        </div>
                    @endif

                    @if (Auth::user()->role === 'admin')
                        <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <p class="text-md font-bold text-yellow-800">Anda masuk sebagai Admin.</p>
                            <p class="mt-1 text-sm text-yellow-700">Silakan kunjungi dashboard admin untuk fitur lengkap.</p>
                            <a href="{{ route('admin.dashboard') }}" class="mt-3 inline-block px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Pergi ke Dashboard Admin
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>