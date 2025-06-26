{{-- resources/views/admin/grooming_bookings/edit.blade.php --}}

<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl border border-gray-100 dark:border-gray-700">

                <div class="bg-gradient-to-r from-teal-500 via-cyan-500 to-sky-600 p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Edit Booking Grooming</h3>
                            <p class="text-sm opacity-90">Kode Transaksi: {{ $booking->transaction_code }}</p>
                        </div>
                    </div>
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

                    @if ($errors->any())
                        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 px-4 py-3 rounded-xl mb-6">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.grooming.update', $booking->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-group">
                                <label for="customer_name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama Pelanggan:</label>
                                <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name', $booking->customer_name) }}" required
                                       class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                @error('customer_name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div class="form-group">
                                <label for="customer_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nomor WhatsApp:</label>
                                <input type="text" id="customer_phone" name="customer_phone" value="{{ old('customer_phone', $booking->customer_phone) }}" required
                                       class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                @error('customer_phone')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <div class="form-group">
                                <label for="pet_type" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Jenis Hewan:</label>
                                <select id="pet_type" name="pet_type" required onchange="updateGroomingOptions()"
                                        class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                    <option value="">-- Pilih Jenis Hewan --</option>
                                    <option value="kitten" {{ (old('pet_type', $booking->pet_type) == 'kitten') ? 'selected' : '' }}>Kitten</option>
                                    <option value="adult" {{ (old('pet_type', $booking->pet_type) == 'adult') ? 'selected' : '' }}>Adult</option>
                                </select>
                                @error('pet_type')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div class="form-group">
                                <label for="grooming_type" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Pilihan Grooming:</label>
                                <select id="grooming_type" name="grooming_type" required onchange="updatePrice()"
                                        class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                    <option value="">-- Pilih Grooming --</option>
                                    {{-- Options will be populated by JavaScript --}}
                                </select>
                                @error('grooming_type')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="grooming-details p-4 border border-dashed border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-200 mt-6" id="groomingDetails" style="display: none;">
                            <p class="text-sm font-medium">Harga Estimasi: <strong id="selectedPrice" class="text-blue-600 dark:text-blue-400 text-lg"></strong></p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <div class="form-group">
                                <label for="booking_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tanggal Booking:</label>
                                <input type="date" id="booking_date" name="booking_date" value="{{ old('booking_date', $booking->booking_date->format('Y-m-d')) }}" required min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                       class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                @error('booking_date')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div class="form-group">
                                <label for="booking_time" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Jam Booking:</label>
                                <input type="time" id="booking_time" name="booking_time" value="{{ old('booking_time', $booking->booking_time->format('H:i')) }}" required
                                       class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                @error('booking_time')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="form-group mt-6">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status Booking:</label>
                            <select id="status" name="status" required
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                <option value="pending" {{ (old('status', $booking->status) == 'pending') ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ (old('status', $booking->status) == 'confirmed') ? 'selected' : '' }}>Confirmed</option>
                                <option value="cancelled" {{ (old('status', $booking->status) == 'cancelled') ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="mt-8 flex justify-end space-x-4">
                            <a href="{{ route('admin.grooming.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-xl font-semibold text-sm text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-md transition duration-200">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const groomingOptionsData = @json($groomingOptions);
        const petTypeSelect = document.getElementById('pet_type');
        const groomingTypeSelect = document.getElementById('grooming_type');
        const selectedPriceSpan = document.getElementById('selectedPrice');
        const groomingDetailsDiv = document.getElementById('groomingDetails');

        // Nilai awal dari booking yang sedang diedit
        const initialSelectedPetType = "{{ old('pet_type', $booking->pet_type) }}";
        const initialSelectedGroomingType = "{{ old('grooming_type', $booking->grooming_type) }}";

        function updateGroomingOptions() {
            const selectedPetType = petTypeSelect.value;
            groomingTypeSelect.innerHTML = '<option value="">-- Pilih Grooming --</option>'; // Reset
            selectedPriceSpan.textContent = ''; // Reset price
            groomingDetailsDiv.style.display = 'none'; // Hide details

            if (selectedPetType && groomingOptionsData[selectedPetType]) {
                const options = groomingOptionsData[selectedPetType];
                for (const key in options) {
                    if (options.hasOwnProperty(key)) {
                        const displayName = key.replace(/_/g, ' ').replace(/\b\w/g, char => char.toUpperCase());
                        const option = document.createElement('option');
                        option.value = displayName;
                        option.textContent = displayName + ' (Rp' + options[key]['price'].toLocaleString('id-ID') + ')';
                        groomingTypeSelect.appendChild(option);
                    }
                }
            }
            
            const oldGroomingType = "{{ old('grooming_type') }}" || initialSelectedGroomingType;
            if (oldGroomingType) {
                let optionExists = false;
                for (let i = 0; i < groomingTypeSelect.options.length; i++) {
                    if (groomingTypeSelect.options[i].value === oldGroomingType) {
                        optionExists = true;
                        break;
                    }
                }
                if (optionExists) {
                    groomingTypeSelect.value = oldGroomingType;
                } else {
                    groomingTypeSelect.value = "";
                }
                updatePrice();
            }
        }

        function updatePrice() {
            const selectedPetType = petTypeSelect.value;
            const selectedGroomingType = groomingTypeSelect.value;
            let price = 0;

            if (selectedPetType && selectedGroomingType && groomingOptionsData[selectedPetType]) {
                const groomingTypeKey = selectedGroomingType.toLowerCase().replace(/ /g, '_');
                price = groomingOptionsData[selectedPetType][groomingTypeKey] ? groomingOptionsData[selectedPetType][groomingTypeKey]['price'] : 0;
            }

            if (price > 0) {
                selectedPriceSpan.textContent = 'Rp' + price.toLocaleString('id-ID');
                groomingDetailsDiv.style.display = 'block';
            } else {
                selectedPriceSpan.textContent = '';
                groomingDetailsDiv.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Set petTypeSelect value based on initialSelectedPetType or old value
            if (initialSelectedPetType) {
                petTypeSelect.value = initialSelectedPetType;
            } else if ("{{ old('pet_type') }}") {
                petTypeSelect.value = "{{ old('pet_type') }}";
            }
            
            updateGroomingOptions(); 
        });
    </script>
</x-app-layout>