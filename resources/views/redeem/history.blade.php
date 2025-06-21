<x-app-layout>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl border border-gray-100 dark:border-gray-700">

                <!-- Header dengan Poin User -->
                <div class="bg-gradient-to-r from-green-400 via-emerald-400 to-teal-400 p-6 text-white">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="mb-4 sm:mb-0">
                            <h3 class="text-2xl font-bold mb-2">Riwayat Penukaran</h3>
                            <p class="text-sm opacity-90">Lihat semua aktivitas penukaran poin Anda</p>
                        </div>
                        <div class="text-left sm:text-right">
                            <p class="text-sm opacity-90">Hai, {{ Auth::user()->name }}!</p>
                            <div class="flex items-center space-x-2 mt-1">
                                <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                                <span class="text-xl font-bold">{{ Auth::user()->points }} Poin</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    @if (session('success'))
                        <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded-xl mb-6 flex items-center space-x-3">
                            <div class="w-6 h-6 bg-green-100 dark:bg-green-800 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-3 h-3 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-sm sm:text-base">{!! session('success') !!}</span>
                        </div>
                    @endif

                    <div class="mb-6 flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('redeem.index') }}" class="bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white font-medium px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                <span>Tukar Poin Lainnya</span>
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
                    </div>

                    @if ($redemptions->isEmpty())
                        <div class="text-center py-16">
                            <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">Belum ada riwayat penukaran</p>
                            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Mulai tukarkan poin Anda dengan produk menarik!</p>
                        </div>
                    @else
                        <!-- Desktop Table View -->
                        <div class="hidden lg:block bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-green-50 dark:bg-green-900/20">
                                        <tr>
                                            <th class="px-6 py-4 text-left text-xs font-medium text-green-800 dark:text-green-200 uppercase tracking-wider">Tanggal Penukaran</th>
                                            <th class="px-6 py-4 text-left text-xs font-medium text-green-800 dark:text-green-200 uppercase tracking-wider">Produk</th>
                                            <th class="px-6 py-4 text-left text-xs font-medium text-green-800 dark:text-green-200 uppercase tracking-wider">Poin Digunakan</th>
                                            <th class="px-6 py-4 text-left text-xs font-medium text-green-800 dark:text-green-200 uppercase tracking-wider">Kode Klaim</th>
                                            <th class="px-6 py-4 text-left text-xs font-medium text-green-800 dark:text-green-200 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-4 text-left text-xs font-medium text-green-800 dark:text-green-200 uppercase tracking-wider">Tanggal Klaim</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach ($redemptions as $redemption)
                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $redemption->created_at->format('d M Y H:i') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    {{ $redemption->product->name }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    <div class="flex items-center space-x-1">
                                                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                                        </svg>
                                                        <span>{{ $redemption->points_used }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="text-xs font-mono font-bold text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-700 rounded px-2 py-1">
                                                        {{ $redemption->unique_code }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{
                                                        $redemption->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-300' :
                                                        ($redemption->status === 'claimed' ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-300')
                                                    }}">
                                                        {{ ucfirst($redemption->status) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $redemption->claimed_at ? $redemption->claimed_at->format('d M Y H:i') : '-' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Mobile/Tablet Card View -->
                        <div class="lg:hidden space-y-4">
                            @foreach ($redemptions as $redemption)
                                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-5 hover:shadow-xl transition-shadow duration-300">
                                    <div class="flex flex-col space-y-3">
                                        <!-- Header with Status -->
                                        <div class="flex items-center justify-between">
                                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ $redemption->product->name }}</h3>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{
                                                $redemption->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-300' :
                                                ($redemption->status === 'claimed' ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-300')
                                            }}">
                                                {{ ucfirst($redemption->status) }}
                                            </span>
                                        </div>

                                        <!-- Date and Points -->
                                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                                            <div class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <span>{{ $redemption->created_at->format('d M Y H:i') }}</span>
                                            </div>
                                            <div class="flex items-center space-x-1 text-sm text-gray-900 dark:text-gray-100">
                                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                                </svg>
                                                <span class="font-medium">{{ $redemption->points_used }} Poin</span>
                                            </div>
                                        </div>

                                        <!-- Unique Code -->
                                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3">
                                            <div class="flex items-center justify-between">
                                                <span class="text-sm text-gray-600 dark:text-gray-400">Kode Klaim:</span>
                                                <span class="text-sm font-mono font-bold text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 px-3 py-1 rounded border">
                                                    {{ $redemption->unique_code }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Claim Date -->
                                        @if($redemption->claimed_at)
                                            <div class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
                                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                <span>Diklaim: {{ $redemption->claimed_at->format('d M Y H:i') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </div>
</x-app-layout>