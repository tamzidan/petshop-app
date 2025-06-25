{{-- resources/views/grooming/create.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Grooming - Petshop</title>
    <style>
        body { font-family: sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        .container { max-width: 700px; margin: auto; background-color: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        h1 { color: #007bff; text-align: center; margin-bottom: 25px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="date"], input[type="time"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 1em;
        }
        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            font-size: 1em;
            transition: background-color 0.3s ease;
            display: inline-block;
            text-decoration: none;
        }
        .btn-primary { background-color: #007bff; }
        .btn-primary:hover { background-color: #0056b3; }
        .btn-secondary { background-color: #6c757d; }
        .btn-secondary:hover { background-color: #5a6268; }
        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 1em;
            font-weight: bold;
        }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .error-message { color: red; font-size: 0.9em; margin-top: 5px; }
        .grooming-details {
            border: 1px dashed #ccc;
            padding: 10px;
            margin-top: 15px;
            border-radius: 5px;
            background-color: #fcfcfc;
        }
        .grooming-details p {
            margin: 5px 0;
            font-size: 0.95em;
        }
        .grooming-details strong {
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Form Booking Grooming</h1>

        <div style="text-align: center; margin-bottom: 20px;">
            <a href="{{ url('/dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('grooming.book.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="customer_name">Nama Lengkap:</label>
                <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name', Auth::user()->name ?? '') }}" required>
                @error('customer_name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="customer_phone">Nomor WhatsApp (Ex: 6281234567890):</label>
                <input type="text" id="customer_phone" name="customer_phone" value="{{ old('customer_phone', Auth::user()->phone ?? '') }}" placeholder="Format: 62xxxxxxxxxx" required>
                @error('customer_phone')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="pet_type">Usia Kucing:</label>
                <select id="pet_type" name="pet_type" required onchange="updateGroomingOptions()">
                    <option value="">-- Pilih Usia Kucing --</option>
                    <option value="kitten" {{ (old('pet_type', $selectedPetType ?? '') == 'kitten') ? 'selected' : '' }}>Kitten</option>
                    <option value="adult" {{ (old('pet_type', $selectedPetType ?? '') == 'adult') ? 'selected' : '' }}>Adult</option>
                </select>
                @error('pet_type')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="grooming_type">Pilihan Grooming:</label>
                <select id="grooming_type" name="grooming_type" required onchange="updatePrice()">
                    <option value="">-- Pilih Grooming --</option>
                    {{-- Opsi ini akan diisi dinamis oleh JavaScript --}}
                </select>
                @error('grooming_type')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="grooming-details" id="groomingDetails" style="display: none;">
                <p>Harga: <strong id="selectedPrice"></strong></p>
            </div>

            <div class="form-group">
                <label for="booking_date">Tanggal Booking:</label>
                <input type="date" id="booking_date" name="booking_date" value="{{ old('booking_date') }}" required min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                @error('booking_date')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="booking_time">Jam Booking:</label>
                <input type="time" id="booking_time" name="booking_time" value="{{ old('booking_time') }}" required>
                @error('booking_time')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Konfirmasi Ketersediaan & Pembayaran (via WhatsApp)</button>
        </form>
    </div>

    <script>
        const groomingOptionsData = @json($groomingOptions);
        const petTypeSelect = document.getElementById('pet_type');
        const groomingTypeSelect = document.getElementById('grooming_type');
        const selectedPriceSpan = document.getElementById('selectedPrice');
        const groomingDetailsDiv = document.getElementById('groomingDetails');

        // Ambil nilai awal dari PHP (jika ada)
        const initialSelectedPetType = "{{ $selectedPetType ?? '' }}";
        const initialSelectedGroomingType = "{{ $selectedGroomingType ?? '' }}";

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
                        option.value = displayName; // Nilai yang dikirim ke backend
                        // Perhatikan: sekarang kita mengakses options[key]['price']
                        option.textContent = displayName + ' (Rp' + options[key]['price'].toLocaleString('id-ID') + ')';
                        groomingTypeSelect.appendChild(option);
                    }
                }
            }

            // Set kembali nilai grooming_type jika ada old value atau initial selected value
            const oldGroomingType = "{{ old('grooming_type') }}" || initialSelectedGroomingType;
            if (oldGroomingType) {
                // Periksa apakah opsi dengan oldGroomingType benar-benar ada di dropdown yang baru diisi
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
                    groomingTypeSelect.value = ""; // Reset jika old value tidak valid
                }
                updatePrice(); // Perbarui harga setelah pilihan grooming diset
            }
        }

        function updatePrice() {
            const selectedPetType = petTypeSelect.value;
            const selectedGroomingType = groomingTypeSelect.value;
            let price = 0;

            if (selectedPetType && selectedGroomingType && groomingOptionsData[selectedPetType]) {
                const groomingTypeKey = selectedGroomingType.toLowerCase().replace(/ /g, '_');
                // Pastikan kita mengakses property 'price'
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

        // Jalankan saat halaman dimuat untuk mengisi opsi jika ada old value atau initial selected value
        document.addEventListener('DOMContentLoaded', () => {
            // Set petTypeSelect value based on initialSelectedPetType or old value
            if (initialSelectedPetType) {
                petTypeSelect.value = initialSelectedPetType;
            } else if ("{{ old('pet_type') }}") {
                petTypeSelect.value = "{{ old('pet_type') }}";
            }
            
            // Panggil updateGroomingOptions untuk mengisi dropdown kedua dan memicu updatePrice
            updateGroomingOptions(); 
        });
    </script>
</body>
</html>