{{-- resources/views/hotel/create.blade.php --}}
<x-app-layout>
    <div class="sm:py-12 lg:py-12 bg-yellow-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl border border-yellow-100 dark:border-gray-700">

                <div class="bg-gradient-to-r from-orange-700 to-yellow-600 p-6 text-white">
                    <h3 class="text-2xl font-bold">Formulir Booking Penitipan Hotel</h3>
                </div>

                <div class="p-6 md:p-8">
                    {{-- Notifikasi Sukses setelah redirect dari booking --}}
                    @if (session('success'))
                        <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded-xl mb-6 flex items-center space-x-3">
                            <div class="w-6 h-6 bg-green-100 dark:bg-green-800 rounded-full flex items-center justify-center flex-shrink-0"><svg class="w-3 h-3 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div>
                            <span class="text-sm sm:text-base">{!! session('success') !!}</span>
                        </div>
                    @endif
                     {{-- Notifikasi Error Validasi --}}
                    @if ($errors->any())
                        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 px-4 py-3 rounded-xl mb-6">
                            <p class="font-bold mb-2">Oops! Ada beberapa kesalahan:</p>
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form action="{{ route('hotel.store') }}" method="POST" class="space-y-6">
                        @csrf

                        {{-- Info Pelanggan --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="customer_name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama Pelanggan</label>
                                <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name', auth()->user()->name) }}" required class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                            </div>
                            <div>
                                <label for="customer_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nomor Telepon (WA)</label>
                                <input type="text" name="customer_phone" id="customer_phone" value="{{ old('customer_phone', auth()->user()->phone_number) }}" required class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                            </div>
                        </div>

                        {{-- Detail Booking --}}
                         <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-1">
                                <label for="number_of_cats" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Jumlah Kucing</label>
                                <input type="number" name="number_of_cats" id="number_of_cats" value="{{ old('number_of_cats', 1) }}" min="1" required class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                            </div>
                            <div>
                                <label for="check_in_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tanggal Check-in</label>
                                <input type="date" name="check_in_date" id="check_in_date" value="{{ old('check_in_date') }}" required class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                            </div>
                            <div>
                                <label for="check_out_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tanggal Check-out</label>
                                <input type="date" name="check_out_date" id="check_out_date" value="{{ old('check_out_date') }}" required class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="pt-6 border-t border-gray-200 dark:border-gray-700 flex items-center justify-end space-x-4">
                            <a href="{{ route('hotel.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 font-medium px-6 py-3 rounded-xl transition-all duration-300 shadow-sm text-center">
                                Batal
                            </a>
                            <button type="submit" class="bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white font-bold px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-center">
                                Booking Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>