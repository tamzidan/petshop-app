{{-- resources/views/user/grooming_history.blade.php --}}

<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl border border-gray-100 dark:border-gray-700">

                <div class="bg-gradient-to-r from-teal-500 via-cyan-500 to-sky-600 p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Riwayat Booking Grooming Anda</h3>
                            <p class="text-sm opacity-90">Lihat semua booking grooming yang pernah Anda buat.</p>
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
                        <a href="{{ route('grooming.index') }}" class="bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white font-medium px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                <span>Booking Grooming Lagi!</span>
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

                <div class="p-6">
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

                    @if ($bookings->isEmpty())
                        <div class="text-center py-16">
                            <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h.01M17 11h.01M9 15h.01M15 15h.01M9 19h.01M15 19h.01M5 19V6a2 2 0 012-2h10a2 2 0 012 2v13a2 2 0 01-2 2H7a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">Anda belum memiliki riwayat booking grooming.</p>
                            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Ayo <a href="{{ route('grooming.index') }}" class="text-blue-600 hover:underline">booking grooming pertama Anda</a> sekarang!</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($bookings as $booking)
                                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 p-6 flex flex-col justify-between">
                                    <div>
                                        <div class="flex items-center justify-between mb-4">
                                            <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">Kode Transaksi: {{ $booking->transaction_code }}</h4>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{
                                                $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-300' :
                                                ($booking->status === 'confirmed' ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-300')
                                            }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </div>
                                        <p class="text-gray-700 dark:text-gray-300 mb-2">
                                            <span class="font-medium">Jenis Hewan:</span> {{ ucfirst($booking->pet_type) }}
                                        </p>
                                        <p class="text-gray-700 dark:text-gray-300 mb-2">
                                            <span class="font-medium">Layanan:</span> {{ $booking->grooming_type }}
                                        </p>
                                        <p class="text-gray-700 dark:text-gray-300 mb-2">
                                            <span class="font-medium">Harga:</span> Rp{{ number_format($booking->price, 0, ',', '.') }}
                                        </p>
                                        <p class="text-gray-700 dark:text-gray-300 mb-2">
                                            <span class="font-medium">Tanggal:</span> {{ $booking->booking_date->format('d M Y') }}
                                        </p>
                                        <p class="text-gray-700 dark:text-gray-300 mb-4">
                                            <span class="font-medium">Jam:</span> {{ $booking->booking_time->format('H:i') }}
                                        </p>
                                    </div>

                                    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                        @if ($booking->status === 'confirmed')
                                            <a href="{{ route('grooming.index', ['pet_type' => $booking->pet_type, 'grooming_type' => $booking->grooming_type]) }}"
                                               class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-200">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                                Booking Lagi
                                            </a>
                                        @elseif ($booking->status === 'pending')
                                            @php
                                                $adminPhoneNumber = '6285722403823'; // Ganti dengan nomor WhatsApp admin yang sebenarnya
                                                $message = urlencode("Halo admin, saya ingin menanyakan status booking grooming saya dengan Kode Transaksi: {$booking->transaction_code} untuk {$booking->customer_name} pada tanggal {$booking->booking_date->format('d M Y')} jam {$booking->booking_time->format('H:i')} dengan layanan {$booking->grooming_type} ({$booking->pet_type}).");
                                                $whatsappLink = "https://wa.me/{$adminPhoneNumber}?text={$message}";
                                            @endphp
                                            <a href="{{ $whatsappLink }}" target="_blank"
                                               class="w-full inline-flex justify-center items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition duration-200">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                                Hubungi Admin via WhatsApp
                                            </a>
                                        @elseif ($booking->status === 'cancelled')
                                            <a href="{{ route('grooming.index') }}"
                                               class="w-full inline-flex justify-center items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg shadow-md transition duration-200">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Cari Jadwal Lain
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-6">
                            {{ $bookings->links() }}
                        </div>
                    @endif
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>