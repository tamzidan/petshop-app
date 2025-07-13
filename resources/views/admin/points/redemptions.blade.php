{{-- resources/views/admin/redemptions/index.blade.php --}}

<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Header Utama Halaman --}}
            <div class="bg-gradient-to-r from-orange-500 via-amber-500 to-yellow-400 p-6 text-white rounded-2xl shadow-lg mb-8">
                <h3 class="text-2xl font-bold mb-2">Klaim Voucher & Riwayat Penukaran</h3>
                <p class="text-sm opacity-90">Proses klaim voucher dari pelanggan dan lihat semua riwayat penukaran poin.</p>
            </div>

            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded-xl mb-6 flex items-center space-x-3">
                    <div class="w-6 h-6 bg-green-100 dark:bg-green-800 rounded-full flex items-center justify-center">
                        <svg class="w-3 h-3 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span>{!! session('success') !!}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 px-4 py-3 rounded-xl mb-6 flex items-center space-x-3">
                    <div class="w-6 h-6 bg-red-100 dark:bg-red-800 rounded-full flex items-center justify-center">
                        <svg class="w-3 h-3 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </div>
                    <span>{!! session('error') !!}</span>
                </div>
            @endif
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Kolom Kiri: Form Klaim Voucher --}}
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl border border-gray-100 dark:border-gray-700 h-full">
                        <div class="p-6">
                            <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Klaim Voucher Pelanggan</h4>
                            <form action="{{ route('admin.redemptions.claim') }}" method="POST">
                                @csrf
                                <div class="space-y-4">
                                    <div>
                                        <label for="unique_code" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Kode Unik:</label>
                                        <input type="text" id="unique_code" name="unique_code" placeholder="ABCD123XYZ" value="{{ old('unique_code') }}" required maxlength="10"
                                               class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 uppercase placeholder:normal-case">
                                        @error('unique_code')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                                    </div>
                                    <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white font-semibold rounded-xl shadow-md transition duration-200">
                                        Proses Klaim
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan: Riwayat Penukaran --}}
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                        <div class="p-6">
                            <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Riwayat Semua Penukaran Poin</h4>
                             @if ($redemptions->isEmpty())
                                <div class="text-center py-16">
                                    <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-10 h-10 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-1.5h5.25m-5.25 0h3m-3 0h-3m2.25-4.5a3 3 0 013-3h1.5a3 3 0 013 3v.75m-6 0v-1.5m-3.75 3a3 3 0 013-3h1.5a3 3 0 013 3v.75m-6 0v-1.5m-6 3.75a3 3 0 013-3h1.5a3 3 0 013 3v.75m-6 0v-1.5m0 0h-3.75" />
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">Belum ada riwayat.</p>
                                    <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Semua data penukaran voucher akan tercatat di sini.</p>
                                </div>
                            @else
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-amber-50 dark:bg-amber-900/20">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-amber-800 dark:text-amber-200 uppercase tracking-wider">User</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-amber-800 dark:text-amber-200 uppercase tracking-wider">Produk</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-amber-800 dark:text-amber-200 uppercase tracking-wider">Kode & Poin</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-amber-800 dark:text-amber-200 uppercase tracking-wider">Status</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-amber-800 dark:text-amber-200 uppercase tracking-wider">Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                            @foreach ($redemptions as $redemption)
                                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $redemption->user->name }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $redemption->product->name }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                        <div class="font-bold text-gray-800 dark:text-gray-200">{{ $redemption->unique_code }}</div>
                                                        <div>{{ $redemption->points_used }} poin</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{
                                                            $redemption->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-300' :
                                                            ($redemption->status === 'claimed' ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-300')
                                                        }}">
                                                            {{ ucfirst($redemption->status) }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                        <div>Dibuat: {{ $redemption->created_at->format('d M Y') }}</div>
                                                        <div>Diklaim: {{ $redemption->claimed_at ? $redemption->claimed_at->format('d M Y') : '-' }}</div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>