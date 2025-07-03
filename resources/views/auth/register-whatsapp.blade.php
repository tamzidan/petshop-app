<x-guest-layout>
    <div class="mb-4 text-sm text-orange-900 dark:text-orange-700 text-center">
        Daftar akun baru dengan nomor WhatsApp Anda!
    </div>

    <x-auth-session-status class="mb-4" :status="session('success')" />
    <x-auth-session-status class="mb-4" :status="session('error')" />

    <form method="POST" action="{{ route('register.send-otp') }}">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="phone_number" :value="__('Nomor WhatsApp (Contoh: 6281234567890)')" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required autocomplete="phone_number" placeholder="628xxxxxxxxxx" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="referred_by" :value="__('Kode Referral (Opsional)')" />
            <x-text-input id="referred_by" class="block mt-1 w-full" type="text" name="referred_by" :value="old('referred_by')" autocomplete="off" placeholder="Masukkan kode referral teman Anda" />
            <x-input-error :messages="$errors->get('referred_by')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-orange-600 dark:text-orange-400 hover:text-orange-900 dark:hover:text-orange-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500" href="{{ route('login') }}">
                {{ __('Sudah punya akun? Login di sini.') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Daftar & Kirim OTP') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>