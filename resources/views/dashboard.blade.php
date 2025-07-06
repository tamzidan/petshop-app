{{-- resources/views/dashboard.blade.php --}}

<x-app-layout>
    <div class="min-h-screen bg-yellow-500 p-4">
        <!-- Header Section -->
        <div class="bg-white dark:bg-amber-900 rounded-2xl shadow-lg p-6 mb-6 border border-orange-100 dark:border-amber-700">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-yellow-600 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800 dark:text-white">Hi, {{ auth()->user()->name }}</h1>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Selamat datang di Enha PetShop</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-sm text-gray-600 dark:text-gray-300">Saldo Poin</div>
                            <div class="flex items-center space-x-2">
                                <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 512 512" xml:space="preserve" fill="#000000" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css">  .st0{fill:#FFD700;}  </style> <g> <path class="st0" d="M256,0C114.625,0,0,114.625,0,256c0,141.391,114.625,256,256,256s256-114.609,256-256 C512,114.625,397.375,0,256,0z M256,464c-114.688,0-208-93.313-208-208S141.313,48,256,48c114.703,0,208,93.313,208,208 S370.703,464,256,464z"></path> <path class="st0" d="M256,80c-97.047,0-176,78.953-176,176s78.953,176,176,176s176-78.953,176-176S353.047,80,256,80z M256,416 c-88.219,0-160-71.781-160-160S167.781,96,256,96c88.234,0,160,71.781,160,160S344.234,416,256,416z"></path> <path class="st0" d="M263.094,173.109h-51.5c-8.219,0-14.875,6.656-14.875,14.859v151.813c0,8.219,6.656,14.875,14.875,14.875 h7.469c8.219,0,14.875-6.656,14.875-14.875v-42.75h29.156c38.984,0,70.719-27.781,70.719-61.953S302.078,173.109,263.094,173.109z M263.094,264.422h-29.156v-58.703h29.156c18.469,0,33.484,13.172,33.484,29.359C296.578,251.25,281.563,264.422,263.094,264.422z"></path> </g> </g></svg>
                                <span class="text-xl font-medium text-yellow-700 dark:text-yellow-300">{{ Auth::user()->points }}</span>
                            </div>
                </div>
            </div>
            
            <div class="mt-4">
                <a href="{{ route('redeem.index') }}" class="block w-full px-6 py-3 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-xl text-center transition-all duration-200">
                    Tukarkan Point
                </a>
            </div>
            <div class="mt-4">
                <a href="{{ route('redeem.history') }}" class="block w-full px-6 py-3 bg-gray-200 text-gray-800 hover:bg-gray-300 font-medium rounded-xl text-center transition-all duration-200">
                    Riwayat Penukaran
                </a>
            </div>
        </div>

                    <!-- Promo/Banner Section -->
                    <div class="bg-white dark:bg-amber-900 rounded-2xl shadow-lg overflow-hidden">
                        <div class="bg-gradient-to-r from-yellow-400 via-orange-400 to-red-400 p-6">
                            <div class="flex items-center justify-between">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-2">Promo Spesial!</h3>
                                    <p class="text-sm opacity-90">Gratis 2KG Pasir untuk setiap pembelian di hari jum'at dan senin</p>
                                    {{-- <p class="text-xs opacity-75 mt-1">Berlaku hingga akhir bulan</p> --}}
                                </div>
                                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>


    <div {{-- class="py-12"  --}}>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (Auth::user()->role === 'user')
                    <!-- Menu Grid -->
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        <!-- Shop -->
                        <div class="bg-white dark:bg-amber-900 rounded-2xl shadow-lg p-6 border border-orange-100 dark:border-amber-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer group">
                            <a href="shop">
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
                            <a href="grooming">
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
                            <a href="clinic">
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
                            <a href="hotel">
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

                    <!-- Quick Stats -->
                    {{-- <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 border border-gray-100 dark:border-gray-700">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-orange-100 dark:bg-orange-900 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-gray-800 dark:text-white">12</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Pesanan Aktif</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 border border-gray-100 dark:border-gray-700">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-gray-800 dark:text-white">3</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Jadwal Hari Ini</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 border border-gray-100 dark:border-gray-700">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-gray-800 dark:text-white">8</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Hewan Favorit</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 border border-gray-100 dark:border-gray-700">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-orange-100 dark:bg-orange-900 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-gray-800 dark:text-white">500</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Total Poin</p>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Recent Activity -->
                    {{-- <div class="bg-white dark:bg-amber-900 rounded-2xl shadow-lg p-6 border border-gray-100 dark:border-gray-700">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">Aktivitas Terbaru</h3>
                            <button class="text-yellow-600 dark:text-yellow-400 text-sm font-medium hover:text-yellow-700 dark:hover:text-yellow-300">
                                Lihat Semua
                            </button>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex items-center space-x-4 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-800 dark:text-white">Grooming untuk Fluffy selesai</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">2 jam yang lalu</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-800 dark:text-white">Pembelian makanan kucing berhasil</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">1 hari yang lalu</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-800 dark:text-white">Jadwal checkup Milo terjadwal</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">3 hari yang lalu</p>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    @endif

                    @if (Auth::user()->role === 'admin')
                        <div class="mt-8 p-6 bg-yellow-50 border border-yellow-200 rounded-lg text-center shadow-md">
                            <p class="text-lg font-bold text-yellow-800">Anda masuk sebagai Admin.</p>
                            <p class="mt-3 text-base text-yellow-700">Gunakan dashboard admin untuk mengelola produk, poin, dan penukaran.</p>
                            <a href="{{ route('admin.dashboard') }}" class="mt-6 inline-flex items-center px-6 py-3 bg-yellow-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.52-1.728 2.016-1.728 2.535 0L15.34 9.5a.75.75 0 00.5.215h5.518a.75.75 0 01.564 1.258l-4.47 5.587a.75.75 0 00-.282.81l1.79 5.517c.15.462-.218.91-.676.77L12 20.354l-5.783 2.115c-.458.134-.826-.308-.676-.77l1.79-5.517a.75.75 0 00-.282-.81L2.078 10.973a.75.75 0 01.564-1.258h5.518a.75.75 0 00.5-.215l2.536-5.183z"></path></svg>
                                Pergi ke Dashboard Admin
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>