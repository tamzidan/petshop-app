{{-- views/layouts/navigation.blade.php --}}

<nav x-data="{ open: false }" class="bg-amber-100 dark:bg-amber-900 border-b border-yellow-100 dark:border-amber-700 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    {{-- <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 group"> --}}
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <x-application-logo class="block h-6 w-auto fill-current text-white" />
                        </div>
                        <span class="text-xl font-bold bg-gradient-to-r from-yellow-600 to-orange-600 bg-clip-text text-transparent hidden sm:block">Enha PetShop</span>
                    {{-- </a> --}}
                </div>

                <div class="
                -x-8 sm:-my-px sm:ms-10 sm:flex">
                    {{-- <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                        class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none hidden sm:flex sm:items-center sm:ms-6
                        {{ request()->routeIs('dashboard') 
                            ? 'border-orange-500 text-orange-600 dark:text-orange-400 bg-orange-50 dark:bg-orange-900/20 rounded-t-lg' 
                            : 'border-transparent text-amber-600 dark:text-amber-300 hover:text-orange-600 dark:hover:text-orange-400 hover:border-orange-300 hover:bg-orange-50 dark:hover:bg-orange-900/10 rounded-t-lg' }}">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                        </svg>
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link> --}}

                    {{-- Tambahkan tautan navigasi khusus role di sini --}}
                    @auth
                        @if (Auth::user()->role === 'user')
                            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                                class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none hidden sm:flex sm:items-center sm:ms-6
                                {{ request()->routeIs('dashboard') 
                                    ? 'border-orange-500 text-orange-600 dark:text-orange-400 bg-orange-50 dark:bg-orange-900/20 rounded-t-lg' 
                                    : 'border-transparent text-amber-600 dark:text-amber-300 hover:text-orange-600 dark:hover:text-orange-400 hover:border-orange-300 hover:bg-orange-50 dark:hover:bg-orange-900/10 rounded-t-lg' }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                                </svg>
                                {{ __('Dashboard') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('grooming.index')" :active="request()->routeIs('grooming.index') || request()->routeIs('grooming.book.create')"
                                class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none hidden sm:flex sm:items-center sm:ms-6
                                {{ request()->routeIs('grooming.index') 
                                    ? 'border-orange-500 text-orange-600 dark:text-orange-400 bg-orange-50 dark:bg-orange-900/20 rounded-t-lg' 
                                    : 'border-transparent text-amber-600 dark:text-amber-300 hover:text-orange-600 dark:hover:text-orange-400 hover:border-orange-300 hover:bg-orange-50 dark:hover:bg-orange-900/10 rounded-t-lg' }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/>
                                </svg>
                                {{ __('Booking Grooming') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('grooming.history')" :active="request()->routeIs('grooming.history')"
                                class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none hidden sm:flex sm:items-center sm:ms-6
                                {{ request()->routeIs('grooming.history') 
                                    ? 'border-orange-500 text-orange-600 dark:text-orange-400 bg-orange-50 dark:bg-orange-900/20 rounded-t-lg' 
                                    : 'border-transparent text-amber-600 dark:text-amber-300 hover:text-orange-600 dark:hover:text-orange-400 hover:border-orange-300 hover:bg-orange-50 dark:hover:bg-orange-900/10 rounded-t-lg' }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ __('Riwayat Booking Grooming') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('redeem.index')" :active="request()->routeIs('redeem.index')"
                                class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none hidden sm:flex sm:items-center sm:ms-6
                                {{ request()->routeIs('redeem.index') 
                                    ? 'border-orange-500 text-orange-600 dark:text-orange-400 bg-orange-50 dark:bg-orange-900/20 rounded-t-lg' 
                                    : 'border-transparent text-amber-600 dark:text-amber-300 hover:text-orange-600 dark:hover:text-orange-400 hover:border-orange-300 hover:bg-orange-50 dark:hover:bg-orange-900/10 rounded-t-lg' }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                {{ __('Tukar Poin') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('redeem.history')" :active="request()->routeIs('redeem.history')"
                                class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none hidden sm:flex sm:items-center sm:ms-6
                                {{ request()->routeIs('redeem.history') 
                                    ? 'border-orange-500 text-orange-600 dark:text-orange-400 bg-orange-50 dark:bg-orange-900/20 rounded-t-lg' 
                                    : 'border-transparent text-amber-600 dark:text-amber-300 hover:text-orange-600 dark:hover:text-orange-400 hover:border-orange-300 hover:bg-orange-50 dark:hover:bg-orange-900/10 rounded-t-lg' }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ __('Riwayat Tukar') }}
                            </x-responsive-nav-link>
                            
                        @elseif (Auth::user()->role === 'admin')
                            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"
                                class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none hidden sm:flex sm:items-center sm:ms-6
                                {{ request()->routeIs('admin.dashboard') 
                                    ? 'border-yellow-500 text-yellow-600 dark:text-yellow-400 bg-yellow-50 dark:bg-yellow-900/20 rounded-t-lg' 
                                    : 'border-transparent text-amber-600 dark:text-amber-300 hover:text-yellow-600 dark:hover:text-yellow-400 hover:border-yellow-300 hover:bg-yellow-50 dark:hover:bg-yellow-900/10 rounded-t-lg' }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                {{ __('Dashboard Admin') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.index')"
                                class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none hidden sm:flex sm:items-center sm:ms-6
                                {{ request()->routeIs('admin.products.index') 
                                    ? 'border-orange-500 text-orange-600 dark:text-orange-400 bg-orange-50 dark:bg-orange-900/20 rounded-t-lg' 
                                    : 'border-transparent text-amber-600 dark:text-amber-300 hover:text-orange-600 dark:hover:text-orange-400 hover:border-orange-300 hover:bg-orange-50 dark:hover:bg-orange-900/10 rounded-t-lg' }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                {{ __('Manajemen Produk') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('admin.points.index')" :active="request()->routeIs('admin.points.index')"
                                class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none hidden sm:flex sm:items-center sm:ms-6
                                {{ request()->routeIs('admin.points.index') 
                                    ? 'border-orange-500 text-orange-600 dark:text-orange-400 bg-orange-50 dark:bg-orange-900/20 rounded-t-lg' 
                                    : 'border-transparent text-amber-600 dark:text-amber-300 hover:text-orange-600 dark:hover:text-orange-400 hover:border-orange-300 hover:bg-orange-50 dark:hover:bg-orange-900/10 rounded-t-lg' }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                {{ __('Kelola Poin') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('admin.redemptions.index')" :active="request()->routeIs('admin.redemptions.index')"
                                class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none hidden sm:flex sm:items-center sm:ms-6
                                {{ request()->routeIs('admin.redemptions.index') 
                                    ? 'border-purple-500 text-purple-600 dark:text-purple-400 bg-purple-50 dark:bg-purple-900/20 rounded-t-lg' 
                                    : 'border-transparent text-amber-600 dark:text-amber-300 hover:text-purple-600 dark:hover:text-purple-400 hover:border-purple-300 hover:bg-purple-50 dark:hover:bg-purple-900/10 rounded-t-lg' }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                                {{ __('Klaim Voucher') }}
                            </x-responsive-nav-link>
                            {{-- Tambahkan tautan ini untuk admin --}}
                            <x-responsive-nav-link :href="route('admin.grooming.index')" :active="request()->routeIs('admin.grooming.index')"
                                class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none hidden sm:flex sm:items-center sm:ms-6
                                {{ request()->routeIs('admin.grooming.index') 
                                    ? 'border-purple-500 text-purple-600 dark:text-purple-400 bg-purple-50 dark:bg-purple-900/20 rounded-t-lg' 
                                    : 'border-transparent text-amber-600 dark:text-amber-300 hover:text-purple-600 dark:hover:text-purple-400 hover:border-purple-300 hover:bg-purple-50 dark:hover:bg-purple-900/10 rounded-t-lg' }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                                {{ __('Manajemen Booking') }}
                            </x-responsive-nav-link>
                        @elseif (Auth::user()->role === 'owner')
                            <x-responsive-nav-link :href="route('owner.dashboard')" :active="request()->routeIs('owner.dashboard')"
                                class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none hidden sm:flex sm:items-center sm:ms-6
                                {{ request()->routeIs('owner.dashboard') 
                                    ? 'border-orange-500 text-orange-600 dark:text-orange-400 bg-orange-50 dark:bg-orange-900/20 rounded-t-lg' 
                                    : 'border-transparent text-amber-600 dark:text-amber-300 hover:text-orange-600 dark:hover:text-orange-400 hover:border-orange-300 hover:bg-orange-50 dark:hover:bg-orange-900/10 rounded-t-lg' }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/>
                                </svg>
                                {{ __('Dashboard Owner') }}
                            </x-responsive-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Points Display -->
                {{-- @auth
                    @if (Auth::user()->role === 'user')
                        <div class="mr-4 px-4 py-2 bg-gradient-to-r from-orange-100 to-yellow-100 dark:from-orange-900/30 dark:to-yellow-900/30 rounded-full border border-orange-200 dark:border-orange-700">
                            <div class="flex items-center space-x-2">
                                <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 512 512" xml:space="preserve" fill="#000000" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css">  .st0{fill:#FFD700;}  </style> <g> <path class="st0" d="M256,0C114.625,0,0,114.625,0,256c0,141.391,114.625,256,256,256s256-114.609,256-256 C512,114.625,397.375,0,256,0z M256,464c-114.688,0-208-93.313-208-208S141.313,48,256,48c114.703,0,208,93.313,208,208 S370.703,464,256,464z"></path> <path class="st0" d="M256,80c-97.047,0-176,78.953-176,176s78.953,176,176,176s176-78.953,176-176S353.047,80,256,80z M256,416 c-88.219,0-160-71.781-160-160S167.781,96,256,96c88.234,0,160,71.781,160,160S344.234,416,256,416z"></path> <path class="st0" d="M263.094,173.109h-51.5c-8.219,0-14.875,6.656-14.875,14.859v151.813c0,8.219,6.656,14.875,14.875,14.875 h7.469c8.219,0,14.875-6.656,14.875-14.875v-42.75h29.156c38.984,0,70.719-27.781,70.719-61.953S302.078,173.109,263.094,173.109z M263.094,264.422h-29.156v-58.703h29.156c18.469,0,33.484,13.172,33.484,29.359C296.578,251.25,281.563,264.422,263.094,264.422z"></path> </g> </g></svg>
                                <span class="text-sm font-medium text-orange-700 dark:text-orange-300">{{ Auth::user()->points }}</span>
                            </div>
                        </div>
                    @endif
                @endauth --}}

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-medium rounded-xl text-amber-700 dark:text-amber-300 bg-white/80 dark:bg-amber-800/80 backdrop-blur-sm hover:text-amber-900 dark:hover:text-white hover:bg-white dark:hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-amber-800 transition ease-in-out duration-150 shadow-lg">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-r from-yellow-500 to-orange-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-sm font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                                <div class="hidden md:block">{{ Auth::user()->name }}</div>
                            </div>

                            <div class="ms-2">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-amber-100 dark:border-amber-600">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-yellow-500 to-orange-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <div class="font-medium text-amber-800 dark:text-amber-200">{{ Auth::user()->name }}</div>
                                    <div class="text-sm text-amber-600 dark:text-amber-400">{{ Auth::user()->email }}</div>
                                    @if (Auth::user()->role === 'admin')
                                        <div class="text-xs bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 px-2 py-1 rounded-full mt-1 inline-block">Admin</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>{{ __('Profile') }}</span>
                        </x-dropdown-link>

                        {{-- Tambahkan link ke dashboard admin/user jika sedang login sebagai role lain --}}
                        @auth
                            @if (Auth::user()->role === 'user' && request()->routeIs('admin.*'))
                                <x-dropdown-link :href="route('dashboard')" class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    </svg>
                                    <span>{{ __('Dashboard Pengguna') }}</span>
                                </x-dropdown-link>
                            @elseif (Auth::user()->role === 'admin' && !request()->routeIs('admin.*'))
                                <x-dropdown-link :href="route('admin.dashboard')" class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    <span>{{ __('Dashboard Admin') }}</span>
                                </x-dropdown-link>
                            @endif
                        @endauth

                        <div class="border-t border-amber-100 dark:border-amber-600 mt-2 pt-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="flex items-center space-x-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span>{{ __('Log Out') }}</span>
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile menu button -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-amber-600 dark:text-amber-400 hover:text-amber-900 dark:hover:text-white hover:bg-white/50 dark:hover:bg-amber-700/50 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-amber-800 transition duration-150 ease-in-out backdrop-blur-sm">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white/95 dark:bg-amber-800/95 backdrop-blur-sm border-t border-yellow-100 dark:border-amber-700">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="flex items-center space-x-3 pl-4 pr-4 py-3 border-l-4 text-base font-medium transition duration-150 ease-in-out
                {{ request()->routeIs('dashboard') 
                    ? 'border-orange-500 text-orange-700 dark:text-orange-300 bg-orange-50 dark:bg-orange-900/20' 
                    : 'border-transparent text-amber-600 dark:text-amber-300 hover:text-orange-600 dark:hover:text-orange-400 hover:bg-orange-50 dark:hover:bg-orange-900/10 hover:border-orange-300' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                </svg>
                <span>{{ __('Dashboard') }}</span>
            </x-responsive-nav-link>

            {{-- Tambahkan tautan responsif khusus role di sini --}}
            @auth
                @if (Auth::user()->role === 'user')
                    <x-responsive-nav-link :href="route('redeem.index')" :active="request()->routeIs('redeem.index')"
                        class="flex items-center space-x-3 pl-4 pr-4 py-3 border-l-4 text-base font-medium transition duration-150 ease-in-out
                        {{ request()->routeIs('redeem.index') 
                            ? 'border-orange-500 text-orange-700 dark:text-orange-300 bg-orange-50 dark:bg-orange-900/20' 
                            : 'border-transparent text-amber-600 dark:text-amber-300 hover:text-orange-600 dark:hover:text-orange-400 hover:bg-orange-50 dark:hover:bg-orange-900/10 hover:border-orange-300' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                        <span>{{ __('Tukar Poin') }}</span>
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('redeem.history')" :active="request()->routeIs('redeem.history')"
                        class="flex items-center space-x-3 pl-4 pr-4 py-3 border-l-4 text-base font-medium transition duration-150 ease-in-out
                        {{ request()->routeIs('redeem.history') 
                            ? 'border-orange-500 text-orange-700 dark:text-orange-300 bg-orange-50 dark:bg-orange-900/20' 
                            : 'border-transparent text-amber-600 dark:text-amber-300 hover:text-orange-600 dark:hover:text-orange-400 hover:bg-orange-50 dark:hover:bg-orange-900/10 hover:border-orange-300' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ __('Riwayat Tukar') }}</span>
                    </x-responsive-nav-link>
                    {{-- <x-responsive-nav-link :href="route('grooming.history')" :active="request()->routeIs('grooming.history')"
                        class="flex items-center space-x-3 pl-4 pr-4 py-3 border-l-4 text-base font-medium transition duration-150 ease-in-out
                        {{ request()->routeIs('grooming.history') 
                            ? 'border-orange-500 text-orange-700 dark:text-orange-300 bg-orange-50 dark:bg-orange-900/20' 
                            : 'border-transparent text-amber-600 dark:text-amber-300 hover:text-orange-600 dark:hover:text-orange-400 hover:bg-orange-50 dark:hover:bg-orange-900/10 hover:border-orange-300' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ __('Riwayat Grooming') }}</span>
                    </x-responsive-nav-link> --}}
                @elseif (Auth::user()->role === 'admin')
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"
                        class="flex items-center space-x-3 pl-4 pr-4 py-3 border-l-4 text-base font-medium transition duration-150 ease-in-out
                        {{ request()->routeIs('admin.dashboard') 
                            ? 'border-yellow-500 text-yellow-700 dark:text-yellow-300 bg-yellow-50 dark:bg-yellow-900/20' 
                            : 'border-transparent text-amber-600 dark:text-amber-300 hover:text-yellow-600 dark:hover:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-yellow-900/10 hover:border-yellow-300' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <span>{{ __('Dashboard Admin') }}</span>
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.index')"
                        class="flex items-center space-x-3 pl-4 pr-4 py-3 border-l-4 text-base font-medium transition duration-150 ease-in-out
                        {{ request()->routeIs('admin.products.index') 
                            ? 'border-orange-500 text-orange-700 dark:text-orange-300 bg-orange-50 dark:bg-orange-900/20' 
                            : 'border-transparent text-amber-600 dark:text-amber-300 hover:text-orange-600 dark:hover:text-orange-400 hover:bg-orange-50 dark:hover:bg-orange-900/10 hover:border-orange-300' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        <span>{{ __('Manajemen Produk') }}</span>
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.points.index')" :active="request()->routeIs('admin.points.index')"
                        class="flex items-center space-x-3 pl-4 pr-4 py-3 border-l-4 text-base font-medium transition duration-150 ease-in-out
                        {{ request()->routeIs('admin.points.index') 
                            ? 'border-orange-500 text-orange-700 dark:text-orange-300 bg-orange-50 dark:bg-orange-900/20' 
                            : 'border-transparent text-amber-600 dark:text-amber-300 hover:text-orange-600 dark:hover:text-orange-400 hover:bg-orange-50 dark:hover:bg-orange-900/10 hover:border-orange-300' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                        <span>{{ __('Kelola Poin') }}</span>
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.redemptions.index')" :active="request()->routeIs('admin.redemptions.index')"
                        class="flex items-center space-x-3 pl-4 pr-4 py-3 border-l-4 text-base font-medium transition duration-150 ease-in-out
                        {{ request()->routeIs('admin.redemptions.index') 
                            ? 'border-purple-500 text-purple-700 dark:text-purple-300 bg-purple-50 dark:bg-purple-900/20' 
                            : 'border-transparent text-amber-600 dark:text-amber-300 hover:text-purple-600 dark:hover:text-purple-400 hover:bg-purple-50 dark:hover:bg-purple-900/10 hover:border-purple-300' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                        <span>{{ __('Klaim Voucher') }}</span>
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Mobile User Menu -->
        <div class="pt-4 pb-1 border-t border-yellow-100 dark:border-amber-700">
            <!-- Points Display for Mobile -->
            @auth
                @if (Auth::user()->role === 'user')
                    <div class="px-4 pb-3">
                        <div class="flex items-center justify-center px-4 py-3 bg-gradient-to-r from-orange-100 to-yellow-100 dark:from-orange-900/30 dark:to-yellow-900/30 rounded-xl border border-orange-200 dark:border-orange-700">
                            <div class="flex items-center space-x-2"><svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 512 512" xml:space="preserve" fill="#000000" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css">  .st0{fill:#FFD700;}  </style> <g> <path class="st0" d="M256,0C114.625,0,0,114.625,0,256c0,141.391,114.625,256,256,256s256-114.609,256-256 C512,114.625,397.375,0,256,0z M256,464c-114.688,0-208-93.313-208-208S141.313,48,256,48c114.703,0,208,93.313,208,208 S370.703,464,256,464z"></path> <path class="st0" d="M256,80c-97.047,0-176,78.953-176,176s78.953,176,176,176s176-78.953,176-176S353.047,80,256,80z M256,416 c-88.219,0-160-71.781-160-160S167.781,96,256,96c88.234,0,160,71.781,160,160S344.234,416,256,416z"></path> <path class="st0" d="M263.094,173.109h-51.5c-8.219,0-14.875,6.656-14.875,14.859v151.813c0,8.219,6.656,14.875,14.875,14.875 h7.469c8.219,0,14.875-6.656,14.875-14.875v-42.75h29.156c38.984,0,70.719-27.781,70.719-61.953S302.078,173.109,263.094,173.109z M263.094,264.422h-29.156v-58.703h29.156c18.469,0,33.484,13.172,33.484,29.359C296.578,251.25,281.563,264.422,263.094,264.422z"></path> </g> </g></svg>                                <span class="text-base font-medium text-orange-700 dark:text-orange-300">{{ Auth::user()->points }} Poin</span>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth

            <!-- User Info -->
            <div class="px-4 py-3 bg-gradient-to-r from-amber-50 to-yellow-50 dark:from-amber-800 dark:to-yellow-900/20 mx-4 rounded-xl border border-amber-200 dark:border-amber-600">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-yellow-500 to-orange-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <div class="font-medium text-base text-amber-800 dark:text-amber-200">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-amber-500 dark:text-amber-400">{{ Auth::user()->email }}</div>
                        @if (Auth::user()->role === 'admin')
                            <div class="text-xs bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 px-2 py-1 rounded-full mt-1 inline-block">Admin</div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')"
                    class="flex items-center space-x-3 pl-4 pr-4 py-3 border-l-4 border-transparent text-base font-medium text-amber-600 dark:text-amber-300 hover:text-amber-800 dark:hover:text-amber-200 hover:bg-amber-50 dark:hover:bg-amber-700 hover:border-amber-300 transition duration-150 ease-in-out">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span>{{ __('Profile') }}</span>
                </x-responsive-nav-link>

                {{-- Tambahkan link responsif ke dashboard admin/user jika sedang login sebagai role lain --}}
                @auth
                    @if (Auth::user()->role === 'user' && request()->routeIs('admin.*'))
                        <x-responsive-nav-link :href="route('dashboard')"
                            class="flex items-center space-x-3 pl-4 pr-4 py-3 border-l-4 border-transparent text-base font-medium text-amber-600 dark:text-amber-300 hover:text-amber-800 dark:hover:text-amber-200 hover:bg-amber-50 dark:hover:bg-amber-700 hover:border-amber-300 transition duration-150 ease-in-out">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            </svg>
                            <span>{{ __('Dashboard Pengguna') }}</span>
                        </x-responsive-nav-link>
                    @elseif (Auth::user()->role === 'admin' && !request()->routeIs('admin.*'))
                        <x-responsive-nav-link :href="route('admin.dashboard')"
                            class="flex items-center space-x-3 pl-4 pr-4 py-3 border-l-4 border-transparent text-base font-medium text-amber-600 dark:text-amber-300 hover:text-amber-800 dark:hover:text-amber-200 hover:bg-amber-50 dark:hover:bg-amber-700 hover:border-amber-300 transition duration-150 ease-in-out">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <span>{{ __('Dashboard Admin') }}</span>
                        </x-responsive-nav-link>
                    @endif
                @endauth

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="flex items-center space-x-3 pl-4 pr-4 py-3 border-l-4 border-transparent text-base font-medium text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 hover:bg-red-50 dark:hover:bg-red-900/20 hover:border-red-300 transition duration-150 ease-in-out">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span>{{ __('Log Out') }}</span>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>