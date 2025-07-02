<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Kami telah mengirimkan kode OTP ke nomor WhatsApp Anda. Masukkan kode tersebut di bawah ini untuk verifikasi.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />
    <x-auth-session-status class="mb-4" :status="session('success')" />
    <x-auth-session-status class="mb-4" :status="session('error')" />
    <x-input-error :messages="$errors->get('otp_code')" class="mb-4" />

    <form method="POST" action="{{ route('password.verify.otp.whatsapp') }}">
        @csrf

        <div>
            <x-input-label for="otp_code" :value="__('Kode OTP')" />
            <x-text-input id="otp_code" class="block mt-1 w-full" type="text" name="otp_code" required autofocus inputmode="numeric" pattern="[0-9]{6}" maxlength="6" />
            <x-input-error :messages="$errors->get('otp_code')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Verifikasi Kode') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>