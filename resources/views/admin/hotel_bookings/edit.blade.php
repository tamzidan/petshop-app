{{-- resources/views/admin/hotel_bookings/edit.blade.php --}}

<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl border border-gray-100 dark:border-gray-700">

                <div class="bg-gradient-to-r from-orange-500 via-amber-500 to-yellow-400 p-6 text-white">
                    <div>
                        <h3 class="text-2xl font-bold mb-2">Edit Data Penitipan Hotel</h3>
                        <p class="text-sm opacity-90">Kode Transaksi: {{ $booking->transaction_code }}</p>
                    </div>
                </div>

                <div class="p-6">
                    @if ($errors->any())
                        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 px-4 py-3 rounded-xl mb-6"><ul class="list-disc list-inside">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
                    @endif

                    <form action="{{ route('admin.hotel.update', $booking->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="customer_name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama Pelanggan:</label>
                                <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name', $booking->customer_name) }}" required class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                            </div>
                            <div>
                                <label for="customer_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nomor WhatsApp:</label>
                                <input type="text" id="customer_phone" name="customer_phone" value="{{ old('customer_phone', $booking->customer_phone) }}" required class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                            </div>
                        </div>

                        <div class="mt-6">
                            <label for="number_of_cats" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Jumlah Kucing:</label>
                            <input type="number" id="number_of_cats" name="number_of_cats" value="{{ old('number_of_cats', $booking->number_of_cats) }}" required min="1" class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <div>
                                <label for="check_in_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tanggal Check-in:</label>
                                <input type="date" id="check_in_date" name="check_in_date" value="{{ old('check_in_date', $booking->check_in_date->format('Y-m-d')) }}" required class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                            </div>
                            <div>
                                <label for="check_out_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tanggal Check-out:</label>
                                <input type="date" id="check_out_date" name="check_out_date" value="{{ old('check_out_date', $booking->check_out_date->format('Y-m-d')) }}" required class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                            </div>
                        </div>

                        <div class="form-group mt-6">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status Booking:</label>
                            <select id="status" name="status" required class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                <option value="pending" @selected(old('status', $booking->status) == 'pending')>Pending</option>
                                <option value="confirmed" @selected(old('status', $booking->status) == 'confirmed')>Confirmed</option>
                                <option value="completed" @selected(old('status', $booking->status) == 'completed')>Completed</option>
                                <option value="cancelled" @selected(old('status', $booking->status) == 'cancelled')>Cancelled</option>
                            </select>
                        </div>

                        <div class="mt-8 flex justify-end space-x-4">
                            <a href="{{ route('admin.hotel.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-xl font-semibold text-sm text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">Batal</a>
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white font-semibold rounded-xl shadow-md transition duration-200">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>