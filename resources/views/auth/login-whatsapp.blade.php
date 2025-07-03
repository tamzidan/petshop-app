<x-guest-layout>
    <div class="mb-4 text-sm text-orange-900 dark:text-orange-700 text-center">
        Login ke akun Anda dengan nomor WhatsApp dan password.
    </div>

    <x-auth-session-status class="mb-4" :status="session('success')" />
    <x-auth-session-status class="mb-4" :status="session('error')" />
    <x-input-error :messages="$errors->get('phone_number')" class="mb-4" /> {{-- Tampilkan error di sini --}}


    <form method="POST" action="{{ route('login') }}"> {{-- Perbarui action ke route('login') --}}
        @csrf

        <div>
            <x-input-label for="phone_number" :value="__('Nomor WhatsApp')" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required autofocus autocomplete="phone_number" placeholder="628xxxxxxxxxx" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-amber-900 border-amber-300 dark:border-amber-700 text-yellow-600 shadow-sm focus:ring-yellow-500 dark:focus:ring-yellow-600 dark:focus:ring-offset-amber-800" name="remember">
                <span class="ms-2 text-sm text-orange-900 dark:text-orange-700">{{ __('Ingat Saya') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request')) {{-- Ini akan kita arahkan ke lupa password via WA OTP --}}
                <a class="underline text-sm text-orange-600 dark:text-orange-400 hover:text-orange-900 dark:hover:text-orange-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif

            <x-primary-button class="ms-4">
                {{ __('Login') }}
            </x-primary-button>
        </div>

        <div class="mt-4 text-center">
            <a class="underline text-sm text-orange-600 dark:text-orange-400 hover:text-orange-900 dark:hover:text-orange-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500" href="{{ route('register') }}">
                {{ __('Belum punya akun? Daftar di sini.') }}
            </a>
        </div>
    </form>
</x-guest-layout>