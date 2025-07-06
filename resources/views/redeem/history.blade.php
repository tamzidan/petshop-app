<x-app-layout>

<div class="sm:py-12 lg:py-12 bg-yellow-50 dark:bg-yellow-500 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-yellow-500 overflow-hidden shadow-lg sm:rounded-2xl border border-yellow-100 dark:border-yellow-700">

                <!-- Header dengan Poin User -->
                <div class="bg-gradient-to-r from-orange-700 to-yellow-600 p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Riwayat Penukaran</h3>
                            <p class="text-sm opacity-90">Lihat semua aktivitas penukaran poin Anda</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm opacity-90">Hai {{ Auth::user()->name }}, poin kamu</p>
                            <div class="flex items-center ms-12 mt-1">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center">
                                    <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 512 512" xml:space="preserve" fill="#000000" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css">  .st0{fill:#FFD700;}  </style> <g> <path class="st0" d="M256,0C114.625,0,0,114.625,0,256c0,141.391,114.625,256,256,256s256-114.609,256-256 C512,114.625,397.375,0,256,0z M256,464c-114.688,0-208-93.313-208-208S141.313,48,256,48c114.703,0,208,93.313,208,208 S370.703,464,256,464z"></path> <path class="st0" d="M256,80c-97.047,0-176,78.953-176,176s78.953,176,176,176s176-78.953,176-176S353.047,80,256,80z M256,416 c-88.219,0-160-71.781-160-160S167.781,96,256,96c88.234,0,160,71.781,160,160S344.234,416,256,416z"></path> <path class="st0" d="M263.094,173.109h-51.5c-8.219,0-14.875,6.656-14.875,14.859v151.813c0,8.219,6.656,14.875,14.875,14.875 h7.469c8.219,0,14.875-6.656,14.875-14.875v-42.75h29.156c38.984,0,70.719-27.781,70.719-61.953S302.078,173.109,263.094,173.109z M263.094,264.422h-29.156v-58.703h29.156c18.469,0,33.484,13.172,33.484,29.359C296.578,251.25,281.563,264.422,263.094,264.422z"></path> </g> </g></svg>
                                </div>
                                <span class="text-xl font-bold">{{ Auth::user()->points }}</span>
                            </div>
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

                    <div class="mb-6 flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('redeem.index') }}" class="bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white font-medium px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                <span>Tukar Poin Lainnya</span>
                            </div>
                        </a>
                        <a href="{{ url('/dashboard') }}" class="bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 text-white font-medium px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-center">
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
                            <div class="w-20 h-20 bg-amber-100 dark:bg-amber-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <p class="text-amber-500 dark:text-amber-400 text-lg font-medium">Belum ada riwayat penukaran</p>
                            <p class="text-amber-400 dark:text-amber-500 text-sm mt-1">Mulai tukarkan poin Anda dengan produk menarik!</p>
                        </div>
                    @else
                        <!-- Desktop Table View -->
                        <div class="hidden lg:block bg-white dark:bg-amber-800 rounded-2xl shadow-lg overflow-hidden border border-amber-100 dark:border-amber-700">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-amber-200 dark:divide-amber-700">
                                    <thead class="bg-yellow-50 dark:bg-yellow-900/20">
                                        <tr>
                                            <th class="px-6 py-4 text-left text-xs font-medium text-yellow-800 dark:text-yellow-200 uppercase tracking-wider">Tanggal Penukaran</th>
                                            <th class="px-6 py-4 text-left text-xs font-medium text-yellow-800 dark:text-yellow-200 uppercase tracking-wider">Produk</th>
                                            <th class="px-6 py-4 text-left text-xs font-medium text-yellow-800 dark:text-yellow-200 uppercase tracking-wider">Poin Digunakan</th>
                                            <th class="px-6 py-4 text-left text-xs font-medium text-yellow-800 dark:text-yellow-200 uppercase tracking-wider">Kode Klaim</th>
                                            <th class="px-6 py-4 text-left text-xs font-medium text-yellow-800 dark:text-yellow-200 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-4 text-left text-xs font-medium text-yellow-800 dark:text-yellow-200 uppercase tracking-wider">Tanggal Klaim</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-amber-800 divide-y divide-amber-200 dark:divide-amber-700">
                                        @foreach ($redemptions as $redemption)
                                            <tr class="hover:bg-amber-50 dark:hover:bg-amber-700 transition-colors duration-200">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-amber-900 dark:text-amber-100">
                                                    {{ $redemption->created_at->format('d M Y H:i') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-amber-900 dark:text-amber-100">
                                                    {{ $redemption->product->name }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-amber-900 dark:text-amber-100">
                                                    <div class="flex items-center space-x-1">
                                                        <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                                        </svg>
                                                        <span>{{ $redemption->points_used }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="text-xs font-mono font-bold text-amber-900 dark:text-amber-100 bg-amber-100 dark:bg-amber-700 rounded px-2 py-1">
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
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-amber-900 dark:text-amber-100">
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
                                <div class="bg-white dark:bg-amber-800 rounded-2xl shadow-lg border border-amber-100 dark:border-amber-700 p-5 hover:shadow-xl transition-shadow duration-300">
                                    <div class="flex flex-col space-y-3">
                                        <!-- Header with Status -->
                                        <div class="flex items-center justify-between">
                                            <h3 class="text-lg font-bold text-amber-900 dark:text-amber-100">{{ $redemption->product->name }}</h3>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{
                                                $redemption->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-300' :
                                                ($redemption->status === 'claimed' ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-300')
                                            }}">
                                                {{ ucfirst($redemption->status) }}
                                            </span>
                                        </div>

                                        <!-- Date and Points -->
                                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                                            <div class="flex items-center space-x-2 text-sm text-amber-600 dark:text-amber-400">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <span>{{ $redemption->created_at->format('d M Y H:i') }}</span>
                                            </div>
                                            <div class="flex items-center space-x-1 text-sm text-amber-900 dark:text-amber-100">
                                                <svg class="w-3 h-3" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 512 512" xml:space="preserve" fill="#000000" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css">  .st0{fill:#FFD700;}  </style> <g> <path class="st0" d="M256,0C114.625,0,0,114.625,0,256c0,141.391,114.625,256,256,256s256-114.609,256-256 C512,114.625,397.375,0,256,0z M256,464c-114.688,0-208-93.313-208-208S141.313,48,256,48c114.703,0,208,93.313,208,208 S370.703,464,256,464z"></path> <path class="st0" d="M256,80c-97.047,0-176,78.953-176,176s78.953,176,176,176s176-78.953,176-176S353.047,80,256,80z M256,416 c-88.219,0-160-71.781-160-160S167.781,96,256,96c88.234,0,160,71.781,160,160S344.234,416,256,416z"></path> <path class="st0" d="M263.094,173.109h-51.5c-8.219,0-14.875,6.656-14.875,14.859v151.813c0,8.219,6.656,14.875,14.875,14.875 h7.469c8.219,0,14.875-6.656,14.875-14.875v-42.75h29.156c38.984,0,70.719-27.781,70.719-61.953S302.078,173.109,263.094,173.109z M263.094,264.422h-29.156v-58.703h29.156c18.469,0,33.484,13.172,33.484,29.359C296.578,251.25,281.563,264.422,263.094,264.422z"></path> </g> </g></svg>
                                                <span class="font-medium">{{ $redemption->points_used }} Poin</span>
                                            </div>
                                        </div>

                                        <!-- Unique Code -->
                                        <div class="bg-amber-50 dark:bg-amber-700 rounded-lg p-3">
                                            <div class="flex items-center justify-between">
                                                <span class="text-sm text-amber-600 dark:text-amber-400">Kode Klaim:</span>
                                                <span class="text-sm font-mono font-bold text-amber-900 dark:text-amber-100 bg-white dark:bg-amber-800 px-3 py-1 rounded border">
                                                    {{ $redemption->unique_code }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Claim Date -->
                                        @if($redemption->claimed_at)
                                            <div class="flex items-center space-x-2 text-sm text-amber-600 dark:text-amber-400">
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