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
</x-app-layout>