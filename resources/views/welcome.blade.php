<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="{{ asset('images/telapak-kaki-kucing.png') }}" type="image/x-icon">
        <title>{{ config('app.name', 'Enha Petshop') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            /* Custom CSS jika diperlukan, untuk overrides atau efek khusus */
            .hero-bg {
                background-image: url('https://plus.unsplash.com/premium_photo-1707353401897-da9ba223f807?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); /* Ganti dengan gambar petshopmu */
                background-size: cover;
                background-position: center;
            }
        </style>
    </head>
    <body class="font-sans antialiased text-gray-900 dark:text-gray-100">
        <div class="min-h-screen bg-amber-100 dark:bg-amber-900">
            <nav class="bg-white dark:bg-amber-800 border-b border-amber-100 dark:border-amber-700 shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <div class="shrink-0 flex items-center">
                                <a href="{{ url('/') }}">
                                    {{-- <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" /> --}}
                                    <span class="flex text-2xl font-bold text-orange-600 dark:text-orange-400">
                                        <x-application-logo class="h-6 w-auto me-2" />Enha Petshop
                                    </span>
                                </a>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            @if (Route::has('login'))
                                <div class="flex space-x-4">
                                    @auth
                                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Dashboard</a>
                                    @else
                                        <a href="{{ route('login') }}" class="font-semibold text-amber-600 hover:text-amber-900 dark:text-yellow-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Login</a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="font-semibold text-amber-600 hover:text-amber-900 dark:text-yellow-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Register</a>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>

            <div class="hero-bg flex items-center justify-center min-h-[calc(100vh-64px)] text-center text-gray-800 p-6">
                <div class="bg-gray-100 bg-opacity-90 p-8 rounded-lg max-w-2xl mx-auto shadow-xl">
                    <h1 class="text-4xl sm:text-5xl font-extrabold mb-4 leading-tight text-amber-700">
                        Selamat Datang! {{-- di <span class="text-orange-400">Enha Petshop</span>  --}}
                    </h1>
                    <p class="text-lg sm:text-xl mb-8 opacity-90">
                        Daftar sekarang untuk langsung menikmati promo Gratis Ongkir daerah Cicalengka, Cikancung, Paseh dan Limbangan. Promo Gratis Ongkir hanya untuk pembelian member Enha Petshop di enhapetshop.com. Yuk daftar sekarang, sebelum promo berakhir!
                    </p>
                    <div class="space-y-4 sm:space-y-0 sm:space-x-4 flex flex-col sm:flex-row justify-center">
                        {{-- <a href="{{ route('grooming.index') }}" class="bg-amber-400 hover:bg-amber-500 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition duration-300 transform hover:scale-105">
                            Lihat Layanan Grooming
                        </a> --}}
                        <a href="{{ route('register') }}" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition duration-300 transform hover:scale-105">
                            Daftar Sekarang!
                        </a>
                    </div>
                    @guest
                        <p class="mt-8 text-md opacity-80">
                            Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-yellow-800 hover:text-indigo-100 underline">Login di sini</a> untuk mendapatkan poin dan menukarkan reward!
                        </p>
                    @endguest
                </div>
            </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-3xl text-white font-bold mb-8">Product dan Layanan?</h2>
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-6">
                        <!-- Shop -->
                        <div class="bg-white dark:bg-amber-900 rounded-2xl shadow-lg p-6 border border-orange-100 dark:border-amber-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer group">
                            <a href="{{ route('guest.shop') }}">
                            <div class="flex flex-col items-center text-center space-y-3">
                                <div class="w-16 h-16 bg-gradient-to-r from-orange-400 to-red-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 dark:text-white group-hover:text-orange-500 transition-colors">Shop</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Makanan & Aksesoris</p>
                            </div>
                            </a>
                        </div>

                        <!-- Grooming -->
                        <div class="bg-white dark:bg-amber-900 rounded-2xl shadow-lg p-6 border border-yellow-100 dark:border-amber-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer group">
                            <a href="{{ route('guest.grooming') }}">
                            <div class="flex flex-col items-center text-center space-y-3">
                                <div class="w-16 h-16 bg-gradient-to-r from-yellow-400 to-teal-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg fill="#ffffff" height="32px" width="32px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512.001 512.001" xml:space="preserve" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M509.943,416.304c-2.261-9.763-4.333-19.559-6.159-29.117c-0.824-4.316-4.991-7.142-9.306-6.321 c-4.316,0.824-7.145,4.991-6.321,9.307c1.865,9.759,3.979,19.759,6.286,29.72c1.095,4.726,1.649,9.663,1.649,14.676 c0,16.871-6.505,32.707-16.975,41.327c-0.065,0.054-0.129,0.108-0.192,0.162c-0.067,0.051-0.134,0.103-0.199,0.155 c-5.034,4.02-10.724,6.144-16.454,6.144c-5.73,0-11.421-2.124-16.455-6.144c-0.064-0.052-0.129-0.102-0.195-0.152 c-0.065-0.056-0.129-0.111-0.195-0.165c-10.471-8.621-16.975-24.456-16.975-41.327c0-5.011,0.555-9.948,1.649-14.674 c10.837-46.801,16.898-92.29,18.012-135.203c0.055-2.145-0.757-4.22-2.255-5.758c-1.498-1.536-3.552-2.403-5.698-2.403H333.949 v-21.591h95.879c4.393,0,7.955-3.56,7.955-7.955c0-4.394-3.562-7.954-7.955-7.954h-95.879v-22.813h95.879 c4.393,0,7.955-3.56,7.955-7.955c0-4.394-3.562-7.954-7.955-7.954h-95.879v-22.813h95.879c4.393,0,7.955-3.56,7.955-7.955 c0-4.394-3.562-7.954-7.955-7.954h-95.879v-22.813h95.879c4.393,0,7.955-3.56,7.955-7.955c0-4.394-3.562-7.954-7.955-7.954 h-95.879v-22.811h95.879c4.393,0,7.955-3.56,7.955-7.955c0-4.394-3.562-7.955-7.955-7.955h-95.879V61.334h43.978 c4.393,0,7.955-3.56,7.955-7.954c0-4.394-3.562-7.955-7.955-7.955h-43.978V29.644h105.224c20.427,0,37.046,16.619,37.046,37.046 v203.188c0,30.218,2.488,61.811,7.394,93.901c0.664,4.342,4.723,7.321,9.066,6.661c4.342-0.664,7.325-4.723,6.661-9.066 c-4.785-31.297-7.211-62.08-7.211-91.496V66.69c0-29.199-23.755-52.955-52.955-52.955h-113.18c-4.393,0-7.955,3.561-7.955,7.954 v262.796c0,4.394,3.562,7.955,7.955,7.955h105.943c-1.602,39.443-7.425,81.068-17.336,123.865 c-1.367,5.902-2.06,12.046-2.06,18.264c0,21.015,7.889,40.372,21.2,52.26c0.889,1.336,2.17,2.388,3.68,2.991 c7.522,5.532,16.074,8.446,24.849,8.446c8.773,0,17.326-2.913,24.848-8.446c1.51-0.602,2.792-1.655,3.681-2.991 c13.31-11.888,21.2-31.246,21.2-52.26C512.002,428.351,511.309,422.207,509.943,416.304z"></path> </g> </g> <g> <g> <path d="M429.827,45.425h-25.844c-4.393,0-7.955,3.56-7.955,7.955c0,4.394,3.562,7.954,7.955,7.954h25.844 c4.393,0,7.954-3.56,7.954-7.954C437.782,48.985,434.22,45.425,429.827,45.425z"></path> </g> </g> <g> <g> <path d="M274.087,379.241c-25.9,0-46.971,21.071-46.971,46.971c0.001,25.9,21.071,46.97,46.971,46.97 c25.899,0,46.97-21.07,46.97-46.97S299.986,379.241,274.087,379.241z M274.087,457.272c-17.128,0-31.062-13.934-31.062-31.061 c0.001-17.129,13.934-31.062,31.062-31.062c17.127,0,31.061,13.934,31.061,31.062 C305.148,443.338,291.214,457.272,274.087,457.272z"></path> </g> </g> <g> <g> <path d="M350.492,423.486c-1.334-38.304-32.302-70.589-70.499-73.504c-6.734-0.511-13.48-0.145-20.075,1.093l-9.478-1.548 c-12.289-2.008-23.791-7.924-32.582-16.724l-6.455-20.854L258.562,53.45c2.836-15.547-2.772-31.692-14.637-42.133 c-2.025-1.782-4.812-2.418-7.411-1.684c-2.596,0.731-4.644,2.727-5.442,5.304l-55.8,180.278L119.472,14.939 c-0.798-2.577-2.847-4.574-5.442-5.304c-2.596-0.733-5.386-0.098-7.411,1.684C94.754,21.76,89.145,37.904,91.981,53.451 l17.419,95.485c0.789,4.322,4.932,7.185,9.254,6.398c4.322-0.788,7.186-4.931,6.398-9.253l-17.419-95.485 c-0.963-5.276-0.426-10.66,1.406-15.563l58.634,189.435c0,0,0,0,0,0.001l27.956,90.323c0,0.001,0.001,0.002,0.001,0.003 l7.592,24.528c0.357,1.155,0.974,2.213,1.802,3.095c11.319,12.044,26.537,20.145,42.85,22.811l10.565,1.725 c1.04,0.213,2.133,0.222,3.22-0.006c5.606-1.171,11.366-1.543,17.122-1.102c29.734,2.269,54.771,28.374,55.811,58.193 c0.579,16.602-5.44,32.308-16.951,44.227c-11.516,11.923-26.984,18.492-43.557,18.492c-27.513,0-51.595-18.565-58.564-45.145 c-0.057-0.218-0.124-0.434-0.198-0.645l-27.621-117.543c-0.605-2.573-2.448-4.677-4.918-5.616l-4.678-1.778 c-0.003-0.001-0.006-0.003-0.01-0.004l-21.015-7.985l-2.67-1.014l-24.603-134.871c-0.789-4.322-4.933-7.188-9.254-6.398 c-4.322,0.788-7.186,4.931-6.398,9.253l24.982,136.941l-6.455,20.852c-8.79,8.8-20.292,14.716-32.582,16.724l-9.479,1.548 c-6.587-1.236-13.363-1.605-20.076-1.094c-38.196,2.915-69.163,35.2-70.5,73.502c-0.731,20.954,6.872,40.782,21.406,55.833 c14.541,15.056,34.073,23.349,55.001,23.349c34.379,0,64.52-22.962,73.672-55.975c0.143-0.359,0.261-0.733,0.351-1.12 l24.793-105.503l24.793,105.503c0.09,0.385,0.209,0.759,0.351,1.119c9.152,33.014,39.292,55.977,73.671,55.977 c20.927,0,40.46-8.292,55.001-23.349C343.62,464.268,351.222,444.439,350.492,423.486z M201.229,279.077l-17.63-56.961 l57.907-187.082c1.833,4.902,2.368,10.285,1.406,15.562L201.229,279.077z M135.219,440.968c-0.074,0.21-0.141,0.425-0.198,0.645 c-6.969,26.58-31.051,45.143-58.564,45.143c-16.572,0-32.041-6.566-43.557-18.492c-11.509-11.918-17.529-27.624-16.949-44.226 c1.04-29.819,26.077-55.924,55.811-58.193c1.559-0.119,3.138-0.179,4.694-0.179c4.169,0,8.351,0.431,12.428,1.281 c1.084,0.226,2.171,0.218,3.205,0.01l10.581-1.728c16.313-2.666,31.531-10.766,42.85-22.811c0.828-0.88,1.445-1.94,1.802-3.095 l4.977-16.081l4.199,1.595l5.518,2.097L135.219,440.968z"></path> </g> </g> <g> <g> <path d="M76.456,379.241c-25.9,0-46.971,21.071-46.971,46.971c0,25.9,21.071,46.97,46.971,46.97c25.9,0,46.971-21.07,46.971-46.97 S102.356,379.241,76.456,379.241z M76.456,457.272c-17.128,0-31.062-13.934-31.062-31.061c0-17.129,13.934-31.062,31.062-31.062 c17.128,0,31.062,13.934,31.062,31.062C107.518,443.338,93.584,457.272,76.456,457.272z"></path> </g> </g> </g></svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 dark:text-white group-hover:text-yellow-500 transition-colors">Grooming</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Perawatan Hewan</p>
                            </div>
                            </a>
                        </div>

                        <!-- Clinic -->
                        <div class="bg-white dark:bg-amber-900 rounded-2xl shadow-lg p-6 border border-orange-100 dark:border-amber-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer group">
                            <a href="{{ route('guest.clinic') }}">
                            <div class="flex flex-col items-center text-center space-y-3">
                                <div class="w-16 h-16 bg-gradient-to-r from-blue-400 to-orange-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg width="64px" height="64px" viewBox="0 0 2050 2050" data-name="Layer 3" id="Layer_3" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><defs><style>.cls-1{fill:#ffff;}.cls-2{fill:#ffffe0e1e2;}.cls-3{fill:#ffff2e3a58;}</style></defs><title></title><path class="cls-1" d="M684.5,1473a15,15,0,0,1-10.6-4.4l-92.5-92.5a14.9,14.9,0,0,1,0-21.2l52.2-52.2a15.1,15.1,0,0,1,21.2,0l92.5,92.5a15.1,15.1,0,0,1,0,21.2l-52.2,52.2A15,15,0,0,1,684.5,1473Z"></path><rect class="cls-2" height="98.14" transform="translate(-252.6 1193.8) rotate(-45)" width="95.6" x="1266.9" y="852.7"></rect><rect class="cls-2" height="58.73" transform="translate(-107.4 1185.5) rotate(-45)" width="246.6" x="1254" y="693"></rect><rect class="cls-2" height="62.26" transform="translate(-532.9 1057.5) rotate(-45)" width="717.4" x="651.4" y="1140.9"></rect><rect class="cls-2" height="249.06" transform="translate(-267.3 1090.2) rotate(-45)" width="43.5" x="1160.6" y="743.2"></rect><path class="cls-3" d="M778.5,1462.6a14.6,14.6,0,0,1-10.6-4.4L591.8,1282.1a14.9,14.9,0,0,1,0-21.2L1099,753.6a15.1,15.1,0,0,1,21.2,0l176.2,176.2a14.9,14.9,0,0,1,4.3,10.6,15.1,15.1,0,0,1-4.3,10.6L789.1,1458.2A14.7,14.7,0,0,1,778.5,1462.6ZM623.6,1271.5l154.9,154.9,486-486L1109.6,785.5Z"></path><rect class="cls-1" height="30" transform="translate(-904.1 826.4) rotate(-45)" width="262.3" x="414.4" y="1489.5"></rect><path class="cls-3" d="M1310.9,845.3a14.7,14.7,0,0,1-10.6-4.4l-91.2-91.2a15,15,0,0,1,0-21.2l174.3-174.4a15.1,15.1,0,0,1,21.3,0l91.2,91.2a15,15,0,0,1,0,21.3L1321.5,840.9A14.7,14.7,0,0,1,1310.9,845.3Zm-70-106.2,70,70,153.2-153.2-70-70Z"></path><path class="cls-1" d="M1554.7,740.4a15.1,15.1,0,0,1-10.6-4.4L1314,505.9a15,15,0,0,1,0-21.2l42.5-42.5a14.9,14.9,0,0,1,21.2,0l230.1,230.1a14.6,14.6,0,0,1,4.4,10.6,14.7,14.7,0,0,1-4.4,10.6L1565.3,736A14.9,14.9,0,0,1,1554.7,740.4Z"></path><rect class="cls-3" height="60.01" transform="translate(-318.6 990.6) rotate(-45)" width="30" x="1021.4" y="849.9"></rect><rect class="cls-3" height="60.01" transform="translate(-398.2 957.6) rotate(-45)" width="30" x="941.8" y="929.5"></rect><rect class="cls-3" height="60.01" transform="translate(-477.8 924.6) rotate(-45)" width="30" x="862.2" y="1009.1"></rect><rect class="cls-3" height="60.01" transform="translate(-557.4 891.7) rotate(-45)" width="30" x="782.6" y="1088.7"></rect><rect class="cls-3" height="60.01" transform="translate(-637 858.7) rotate(-45)" width="30" x="703" y="1168.3"></rect><path class="cls-1" d="M770,1376.3a5.1,5.1,0,0,1-3.6-1.5,5.1,5.1,0,0,1,0-7.1l42.4-42.4a5.1,5.1,0,0,1,7.1,0,5,5,0,0,1,0,7.1l-42.4,42.4A5,5,0,0,1,770,1376.3Zm84.8-84.9a5,5,0,0,1-3.5-8.5l42.4-42.4a5,5,0,0,1,7.1,0,5,5,0,0,1,0,7L858.3,1290A5,5,0,0,1,854.8,1291.4Zm84.9-84.8a5.1,5.1,0,0,1-3.6-1.5,5.1,5.1,0,0,1,0-7.1l42.5-42.4a5,5,0,0,1,7,0,5,5,0,0,1,0,7.1l-42.4,42.4A5,5,0,0,1,939.7,1206.6Zm84.8-84.9a5.2,5.2,0,0,1-3.5-1.4,5,5,0,0,1,0-7.1l42.4-42.4a5,5,0,0,1,7.1,0,5,5,0,0,1,0,7l-42.4,42.5A5.4,5.4,0,0,1,1024.5,1121.7Zm84.9-84.8a5.1,5.1,0,0,1-3.6-1.5,5.1,5.1,0,0,1,0-7.1l42.5-42.4a5,5,0,0,1,7,0,5,5,0,0,1,0,7.1l-42.4,42.4A5,5,0,0,1,1109.4,1036.9Zm84.8-84.9a5.2,5.2,0,0,1-3.5-1.4,5,5,0,0,1,0-7.1l42.4-42.4a5,5,0,0,1,7.1,0,5,5,0,0,1,0,7l-42.4,42.5A5.4,5.4,0,0,1,1194.2,952Z"></path><path class="cls-3" d="M1315.6,985.3a15.3,15.3,0,0,1-10.6-4.4L1069.1,745a15.2,15.2,0,0,1-4.4-10.6,15,15,0,0,1,4.4-10.6l67.6-67.6a14.9,14.9,0,0,1,21.2,0l235.9,235.9a14.6,14.6,0,0,1,4.4,10.6,14.7,14.7,0,0,1-4.4,10.6l-67.6,67.6A14.9,14.9,0,0,1,1315.6,985.3ZM1101,734.4,1315.6,949l46.4-46.3L1147.3,688Z"></path></g></svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 dark:text-white group-hover:text-blue-500 transition-colors">Clinic</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Kesehatan Hewan</p>
                            </div>
                            </a>
                        </div>

                        <!-- Hotel -->
                        <div class="bg-white dark:bg-amber-900 rounded-2xl shadow-lg p-6 border border-yellow-100 dark:border-amber-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer group">
                            <a href="{{ route('guest.hotel') }}">
                            <div class="flex flex-col items-center text-center space-y-3">
                                <div class="w-16 h-16 bg-gradient-to-r from-yellow-400 to-pink-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 dark:text-white group-hover:text-yellow-500 transition-colors">Hotel</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Penitipan Hewan</p>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


            <div class="py-16 bg-white dark:bg-amber-800 text-amber-800 dark:text-gray-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h2 class="text-3xl font-bold mb-8">Kenapa Memilih Enha Petshop?</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="p-6 bg-yellow-50 dark:bg-yellow-600 rounded-lg shadow-md">
                            <svg class="w-12 h-12 text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <h3 class="text-xl font-semibold mb-2">Layanan Profesional</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm">Tim ahli kami siap memberikan perawatan terbaik untuk hewan kesayangan Anda.</p>
                        </div>
                        <div class="p-6 bg-yellow-50 dark:bg-yellow-600 rounded-lg shadow-md">
                            <svg class="w-12 h-12 text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            <h3 class="text-xl font-semibold mb-2">Produk Berkualitas</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm">Berbagai pilihan makanan, mainan, dan aksesori dari merek terkemuka.</p>
                        </div>
                        <div class="p-6 bg-yellow-50 dark:bg-yellow-600 rounded-lg shadow-md">
                            <svg class="w-12 h-12 text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.592 1L17.5 11.25m-3.5 3.5l2.25 2.25m-4 4L12 18l-3.5 1.5M4 12H3m18 0h-1M6.75 4.5l-1.5-1.5M7.5 20.25l-1.5-1.5M10.5 4.5h3m-6 6h6m-3 6h.01"></path></svg>
                            <h3 class="text-xl font-semibold mb-2">Rewards Menarik</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm">Dapatkan poin setiap transaksi dan tukarkan dengan hadiah istimewa.</p>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="bg-gray-800 dark:bg-gray-900 text-white py-8 mt-auto">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <p>&copy; {{ date('Y') }} Enha Petshop. All rights reserved.</p>
                    <p class="text-sm text-gray-400 mt-2">Dibuat dengan ❤️ untuk hewan kesayangan Anda.</p>
                </div>
            </footer>
        </div>
    </body>
</html>