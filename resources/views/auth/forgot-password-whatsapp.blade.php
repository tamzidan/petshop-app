<x-guest-layout>
    <div class="mb-4 text-sm text-orange-900 dark:text-orange-700">
        {{ __('Lupa password Anda? Masukkan nomor WhatsApp Anda, kami akan mengirimkan kode OTP untuk mereset password Anda.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />
    <x-auth-session-status class="mb-4" :status="session('success')" />
    <x-auth-session-status class="mb-4" :status="session('error')" />
    <x-input-error :messages="$errors->get('phone_number')" class="mb-4" />

    <form method="POST" action="{{ route('password.email') }}"> {{-- Ini akan mengirim OTP --}}
        @csrf

        <div>
            <x-input-label for="phone_number" :value="__('Nomor WhatsApp')" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required autofocus placeholder="628xxxxxxxxxx" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Kirim Kode OTP') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>