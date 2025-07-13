{{-- resources/views/admin/nama_fitur_baru/index.blade.php --}}

<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl border border-gray-100 dark:border-gray-700">

                {{-- [DIUBAH] Header dengan gradasi warna oranye/kuning --}}
                <div class="bg-gradient-to-r from-orange-500 via-amber-500 to-yellow-400 p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            {{-- Ganti teks ini sesuai fitur Anda --}}
                            <h3 class="text-2xl font-bold mb-2">Manajemen Penitipan Hewan</h3>
                            <p class="text-sm opacity-90">Kelola semua data penitipan hewan di sini.</p>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    {{-- Notifikasi sukses (tetap hijau untuk konsistensi UX) --}}
                    @if (session('success'))
                        <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded-xl mb-6 flex items-center space-x-3">
                            <div class="w-6 h-6 bg-green-100 dark:bg-green-800 rounded-full flex items-center justify-center">
                                <svg class="w-3 h-3 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span>{!! session('success') !!}</span>
                        </div>
                    @endif

                    {{-- Notifikasi error (tetap merah untuk konsistensi UX) --}}
                    @if (session('error'))
                        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 px-4 py-3 rounded-xl mb-6 flex items-center space-x-3">
                            <div class="w-6 h-6 bg-red-100 dark:bg-red-800 rounded-full flex items-center justify-center">
                                <svg class="w-3 h-3 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                            <span>{!! session('error') !!}</span>
                        </div>
                    @endif

                    <div class="mb-6">
                        {{-- Ganti route ini ke route pencarian fitur Anda --}}
                        <form action="{{ route('admin.grooming.index') }}" method="GET" class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-4">
                            <input type="text" name="search" placeholder="Cari data..." value="{{ request('search') }}"
                                   {{-- [DIUBAH] Warna fokus input field --}}
                                   class="flex-grow w-full sm:w-auto px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-400">
                            {{-- [DIUBAH] Warna tombol utama --}}
                            <button type="submit" class="px-6 py-2 bg-orange-600 hover:bg-orange-700 text-white font-semibold rounded-lg shadow-md transition duration-200">Cari</button>
                            @if(request('search'))
                                {{-- Ganti route ini ke route index fitur Anda --}}
                                <a href="{{ route('admin.grooming.index') }}" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg shadow-md transition duration-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">Reset</a>
                            @endif
                        </form>
                    </div>

                    {{-- Ganti variabel $bookings dengan variabel dari controller Anda --}}
                    @if ($bookings->isEmpty())
                        <div class="text-center py-16">
                            <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">Belum ada data penitipan.</p>
                            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Semua data penitipan yang masuk akan muncul di sini.</p>
                        </div>
                    @else
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    {{-- [DIUBAH] Warna header tabel --}}
                                    <thead class="bg-amber-50 dark:bg-amber-900/20">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-amber-800 dark:text-amber-200 uppercase tracking-wider">ID Transaksi</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-amber-800 dark:text-amber-200 uppercase tracking-wider">Pelanggan</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-amber-800 dark:text-amber-200 uppercase tracking-wider">Detail Hewan</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-amber-800 dark:text-amber-200 uppercase tracking-wider">Tanggal & Waktu</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-amber-800 dark:text-amber-200 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-amber-800 dark:text-amber-200 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        {{-- Ganti $bookings dengan variabel Anda dan sesuaikan field-nya --}}
                                        @foreach ($bookings as $booking)
                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 dark:text-gray-100">
                                                    {{ $booking->transaction_code }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    <div>{{ $booking->customer_name }}</div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $booking->customer_phone }}</div>
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                                    <div>{{ ucfirst($booking->pet_type) }}</div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">Catatan: -</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    <div>{{ Illuminate\Support\Carbon::parse($booking->booking_date)->format('d M Y') }}</div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ Illuminate\Support\Carbon::parse($booking->booking_time)->format('H:i') }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{-- Status badge (pending sudah kuning, yang lain tetap) --}}
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{
                                                        $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-300' :
                                                        ($booking->status === 'confirmed' ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-300')
                                                    }}">
                                                        {{ ucfirst($booking->status) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <div class="flex items-center space-x-2">
                                                        {{-- [DIUBAH] Warna ikon edit --}}
                                                        <a href="{{ route('admin.grooming.edit', $booking->id) }}" class="text-orange-600 hover:text-orange-900 dark:text-orange-400 dark:hover:text-orange-300">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                        </a>
                                                        {{-- Aksi lain (confirm/cancel) tetap menggunakan warna fungsionalnya --}}
                                                        @if ($booking->status === 'pending')
                                                            <form action="{{ route('admin.grooming.confirm', $booking->id) }}" method="POST" onsubmit="return confirm('Konfirmasi data ini?')">
                                                                @csrf
                                                                <button type="submit" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300">
                                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                                </button>
                                                            </form>
                                                            <form action="{{ route('admin.grooming.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Batalkan data ini?')">
                                                                @csrf
                                                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2A9 9 0 111 12a9 9 0 0118 0z"></path></svg>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="p-6">
                                {{ $bookings->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>