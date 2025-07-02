<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 text-center">
        Verifikasi nomor WhatsApp Anda dengan kode OTP yang dikirim.
    </div>

    <x-auth-session-status class="mb-4" :status="session('success')" />
    <x-auth-session-status class="mb-4" :status="session('error')" />
    <x-input-error :messages="$errors->get('otp_code')" class="mt-2" />


    <form method="POST" action="{{ route('whatsapp.register.verify-otp') }}">
        @csrf

        <div>
            <x-input-label for="otp_code" :value="__('Kode OTP')" />
            <x-text-input id="otp_code" class="block mt-1 w-full" type="text" name="otp_code" required autofocus inputmode="numeric" pattern="[0-9]{6}" maxlength="6" />
            <x-input-error :messages="$errors->get('otp_code')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Verifikasi OTP') }}
            </x-primary-button>
        </div>

        {{-- Tambahkan tombol kirim ulang OTP jika diperlukan (logika di controller) --}}
        {{-- <div class="mt-4 text-center">
            <a href="#" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Kirim Ulang OTP</a>
        </div> --}}
    </form>
</x-guest-layout>