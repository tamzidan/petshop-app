{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 text-center">
        Verifikasi login Anda dengan kode OTP yang dikirim ke WhatsApp Anda.
    </div>

    <x-auth-session-status class="mb-4" :status="session('success')" />
    <x-auth-session-status class="mb-4" :status="session('error')" />
    <x-input-error :messages="$errors->get('otp_code')" class="mt-2" />

    <form method="POST" action="{{ route('whatsapp.login.verify-otp') }}">
        @csrf

        <div>
            <x-input-label for="otp_code" :value="__('Kode OTP')" />
            <x-text-input id="otp_code" class="block mt-1 w-full" type="text" name="otp_code" required autofocus inputmode="numeric" pattern="[0-9]{6}" maxlength="6" />
            <x-input-error :messages="$errors->get('otp_code')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Verifikasi & Login') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}