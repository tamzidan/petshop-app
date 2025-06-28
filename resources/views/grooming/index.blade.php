{{-- resources/views/grooming/index.blade.php --}}

<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl border border-gray-100 dark:border-gray-700">

                <div class="bg-gradient-to-r from-green-500 via-emerald-500 to-teal-600 p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Layanan Grooming Kami</h3>
                            {{-- <p class="text-sm opacity-90">Pilih paket grooming terbaik untuk hewan kesayangan Anda!</p> --}}
                        </div>
                        {{-- Opsional: Anda bisa menampilkan informasi user di sini juga jika diinginkan, seperti di halaman redeem --}}
                        {{-- <div class="text-right">
                            <p class="text-sm opacity-90">Hai, {{ Auth::user()->name }}!</p>
                        </div> --}}
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

                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('grooming.history') }}" class="bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white font-medium px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                <span>Riwayat Grooming</span>
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
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-8 text-center">Pilih Paket Grooming Terbaik untuk Hewan Peliharaan Anda!</h3>

                    @foreach ($groomingOptions as $petType => $groomingTypes)
                        <div class="mb-12">
                            <h4 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-6 border-b-2 border-emerald-300 dark:border-emerald-700 pb-3 text-center">
                                Grooming {{ ucfirst($petType) }} ({{ $petType === 'kitten' ? 'Anak Kucing' : 'Kucing Dewasa' }})
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                @foreach ($groomingTypes as $groomingKey => $details)
                                    <div class="bg-white dark:bg-gray-700 border border-emerald-100 dark:border-gray-600 rounded-2xl p-6 flex flex-col justify-between shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group">
                                        <div>
                                            <h5 class="text-xl font-bold text-emerald-700 dark:text-emerald-400 mb-3 text-center group-hover:text-emerald-800 dark:group-hover:text-emerald-300 transition-colors">
                                                {{ Str::title(str_replace('_', ' ', $groomingKey)) }}
                                            </h5>
                                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-4 text-center">Keuntungan:</p>
                                            <ul class="list-disc list-inside text-sm text-gray-700 dark:text-gray-200 mb-6 space-y-1">
                                                @forelse ($details['benefits'] as $benefit)
                                                    <li>{{ $benefit }}</li>
                                                @empty
                                                    <li>Tidak ada keuntungan spesifik yang terdaftar.</li>
                                                @endforelse
                                            </ul>
                                        </div>
                                        <div class="mt-auto pt-4 border-t border-emerald-100 dark:border-gray-600">
                                            <p class="text-center text-3xl font-extrabold text-green-600 dark:text-green-400 mb-4">
                                                Rp{{ number_format($details['price'], 0, ',', '.') }}
                                            </p>
                                            <a href="{{ route('grooming.book.create', ['petType' => $petType, 'groomingType' => Str::title(str_replace('_', ' ', $groomingKey))]) }}" class="block w-full text-center px-4 py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                                                Booking Sekarang!
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-10 text-center">
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-xl font-semibold text-sm text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>