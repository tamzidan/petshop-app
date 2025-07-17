{{-- resources/views/grooming/create.blade.php --}}

<x-app-layout>
    <div class="sm:py-12 lg:py-12 bg-yellow-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl border border-yellow-100 dark:border-gray-700">

                {{-- Header Halaman --}}
                <div class="bg-gradient-to-r from-orange-700 to-yellow-600 p-6 text-white">
                    <h3 class="text-2xl font-bold">Formulir Booking Grooming</h3>
                    <p class="text-sm opacity-90">Isi detail di bawah untuk menjadwalkan perawatan anabul Anda.</p>
                </div>

                <div class="p-6 md:p-8">
                    {{-- Notifikasi --}}
                    @if (session('success'))
                        <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded-xl mb-6 flex items-center space-x-3">
                            <div class="w-6 h-6 bg-green-100 dark:bg-green-800 rounded-full flex items-center justify-center flex-shrink-0"><svg class="w-3 h-3 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div>
                            <span class="text-sm sm:text-base">{!! session('success') !!}</span>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 px-4 py-3 rounded-xl mb-6 flex items-center space-x-3">
                             <div class="w-6 h-6 bg-red-100 dark:bg-red-800 rounded-full flex items-center justify-center flex-shrink-0"><svg class="w-3 h-3 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></div>
                            <span class="text-sm sm:text-base">{!! session('error') !!}</span>
                        </div>
                    @endif
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

                    {{-- Formulir Utama --}}
                    <form action="{{ route('grooming.book.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        {{-- Data Pelanggan --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="customer_name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama Lengkap</label>
                                <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name', Auth::user()->name ?? '') }}" required class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                            </div>
                            <div>
                                <label for="customer_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nomor WhatsApp</label>
                                <input type="text" id="customer_phone" name="customer_phone" value="{{ old('customer_phone', Auth::user()->phone_number ?? '') }}" placeholder="Contoh: 628123456789" required class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                            </div>
                        </div>

                        {{-- Pilihan Layanan --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                             <div>
                                <label for="pet_type" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Usia Kucing</label>
                                <select id="pet_type" name="pet_type" required onchange="updateGroomingOptions()" class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                    <option value="">-- Pilih Usia --</option>
                                    <option value="kitten" {{ (old('pet_type', $selectedPetType ?? '') == 'kitten') ? 'selected' : '' }}>Kitten</option>
                                    <option value="adult" {{ (old('pet_type', $selectedPetType ?? '') == 'adult') ? 'selected' : '' }}>Adult</option>
                                </select>
                            </div>
                             <div>
                                <label for="grooming_type" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Pilihan Grooming</label>
                                <select id="grooming_type" name="grooming_type" required onchange="updatePrice()" class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                    <option value="">-- Pilih Grooming --</option>
                                    {{-- Opsi ini akan diisi dinamis oleh JavaScript --}}
                                </select>
                            </div>
                        </div>
                        
                        {{-- Detail Harga Dinamis --}}
                        <div class="grooming-details p-4 border border-dashed border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700/50" id="groomingDetails" style="display: none;">
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Estimasi Harga: 
                                <strong id="selectedPrice" class="text-orange-600 dark:text-orange-400 text-lg"></strong>
                            </p>
                        </div>

                        {{-- Jadwal Booking --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="booking_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tanggal Booking</label>
                                <input type="date" id="booking_date" name="booking_date" value="{{ old('booking_date') }}" required min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                            </div>
                            <div>
                                <label for="booking_time" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Jam Booking</label>
                                <input type="time" id="booking_time" name="booking_time" value="{{ old('booking_time') }}" required class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="pt-6 border-t border-gray-200 dark:border-gray-700 flex items-center justify-end space-x-4">
                            <a href="{{ url('/dashboard') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 font-medium px-6 py-3 rounded-xl transition-all duration-300 shadow-sm text-center">
                                Kembali
                            </a>
                            <button type="submit" class="bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white font-bold px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-center">
                                Konfirmasi via WhatsApp
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT JAVASCRIPT INI TIDAK DIUBAH SAMA SEKALI --}}
    <script>
        const groomingOptionsData = @json($groomingOptions);
        const petTypeSelect = document.getElementById('pet_type');
        const groomingTypeSelect = document.getElementById('grooming_type');
        const selectedPriceSpan = document.getElementById('selectedPrice');
        const groomingDetailsDiv = document.getElementById('groomingDetails');

        const initialSelectedPetType = "{{ $selectedPetType ?? '' }}";
        const initialSelectedGroomingType = "{{ $selectedGroomingType ?? '' }}";

        function updateGroomingOptions() {
            const selectedPetType = petTypeSelect.value;
            groomingTypeSelect.innerHTML = '<option value="">-- Pilih Grooming --</option>'; 
            selectedPriceSpan.textContent = '';
            groomingDetailsDiv.style.display = 'none';

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
            if (initialSelectedPetType) {
                petTypeSelect.value = initialSelectedPetType;
            } else if ("{{ old('pet_type') }}") {
                petTypeSelect.value = "{{ old('pet_type') }}";
            }
            updateGroomingOptions(); 
        });
    </script>
</x-app-layout>