<x-app-layout>
    <div class="bg-amber-100 dark:bg-amber-900 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Kontainer Utama Meniru Halaman Grooming --}}
            <div class="bg-white dark:bg-yellow-500 overflow-hidden shadow-xl border border-orange-100 dark:border-orange-700 sm:rounded-2xl">

                {{-- Header Halaman --}}
                <div class="bg-amber-700 p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Klinik Kesehatan Pet</h3>
                            <p class="text-sm opacity-90">Layanan kesehatan terbaik untuk hewan kesayangan Anda dengan tim dokter hewan berpengalaman.</p>
                        </div>
                    </div>
                </div>

                {{-- Konten Layanan Klinik --}}
                <div class="p-6 md:p-8">
                    {{-- Informasi Konsultasi --}}
                    <div class="mb-8">
                        <h4 class="text-xl font-semibold text-amber-800 dark:text-amber-800 mb-4">Konsultasi Kesehatan Pet</h4>
                        <div class="bg-amber-50 dark:bg-amber-800 p-4 rounded-lg border border-amber-200 dark:border-amber-600">
                            <p class="text-gray-700 dark:text-amber-100 mb-3">
                                Tim dokter hewan profesional kami siap memberikan konsultasi kesehatan untuk berbagai jenis hewan peliharaan. Konsultasi dapat dilakukan secara langsung di klinik atau melalui telepon untuk kasus-kasus tertentu.
                            </p>
                            <div class="flex items-center space-x-4 text-sm">
                                <span class="bg-amber-200 dark:bg-amber-700 px-3 py-1 rounded-full text-amber-800 dark:text-amber-800">
                                    📞 Konsultasi Whatsapp
                                </span>
                                <span class="bg-amber-200 dark:bg-amber-700 px-3 py-1 rounded-full text-amber-800 dark:text-amber-800">
                                    🏥 Konsultasi Langsung
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Layanan Kesehatan --}}
                    <div class="mb-8">
                        <h4 class="text-xl font-semibold text-amber-800 dark:text-amber-800 mb-4">Layanan Kesehatan Tersedia</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-orange-50 dark:bg-orange-800 p-4 rounded-lg border border-orange-200 dark:border-orange-600">
                                <h5 class="font-semibold text-orange-800 dark:text-orange-200 mb-2">🩺 Pemeriksaan Umum</h5>
                                <p class="text-gray-700 dark:text-orange-100 text-sm">Pemeriksaan kesehatan rutin, cek kondisi fisik, dan deteksi dini penyakit pada hewan peliharaan Anda.</p>
                            </div>
                            <div class="bg-orange-50 dark:bg-orange-800 p-4 rounded-lg border border-orange-200 dark:border-orange-600">
                                <h5 class="font-semibold text-orange-800 dark:text-orange-200 mb-2">💉 Vaksinasi</h5>
                                <p class="text-gray-700 dark:text-orange-100 text-sm">Program vaksinasi lengkap untuk anjing, kucing, dan hewan peliharaan lainnya sesuai jadwal yang direkomendasikan.</p>
                            </div>
                            <div class="bg-orange-50 dark:bg-orange-800 p-4 rounded-lg border border-orange-200 dark:border-orange-600">
                                <h5 class="font-semibold text-orange-800 dark:text-orange-200 mb-2">⚕️ Pengobatan</h5>
                                <p class="text-gray-700 dark:text-orange-100 text-sm">Penanganan berbagai penyakit dan kondisi medis dengan obat-obatan berkualitas dan treatment yang tepat.</p>
                            </div>
                            <div class="bg-orange-50 dark:bg-orange-800 p-4 rounded-lg border border-orange-200 dark:border-orange-600">
                                <h5 class="font-semibold text-orange-800 dark:text-orange-200 mb-2">🏥 Operasi Minor</h5>
                                <p class="text-gray-700 dark:text-orange-100 text-sm">Prosedur bedah minor seperti sterilisasi, penanganan luka, dan operasi kecil lainnya.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Jam Operasional --}}
                    <div class="mb-8">
                        <h4 class="text-xl font-semibold text-amber-800 dark:text-amber-800 mb-4">Jam Operasional Klinik</h4>
                        <div class="bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-800 dark:to-orange-800 p-4 rounded-lg border border-amber-200 dark:border-amber-600">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h5 class="font-semibold text-amber-800 dark:text-amber-800 mb-2">Hari Kerja</h5>
                                    <p class="text-gray-700 dark:text-amber-100">Senin - Jumat: 08:00 - 17:00</p>
                                    <p class="text-gray-700 dark:text-amber-100">Sabtu: 08:00 - 15:00</p>
                                </div>
                                <div>
                                    <h5 class="font-semibold text-amber-800 dark:text-amber-800 mb-2">Layanan Darurat</h5>
                                    <p class="text-gray-700 dark:text-amber-100">24 jam untuk kasus emergency</p>
                                    <p class="text-red-600 dark:text-red-400 font-medium">Hubungi: 0812-3456-7890</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Cara Booking --}}
                    <div class="mb-8">
                        <h4 class="text-xl font-semibold text-amber-800 dark:text-amber-800 mb-4">Cara Booking Konsultasi</h4>
                        <div class="bg-yellow-50 dark:bg-yellow-800 p-4 rounded-lg border border-yellow-200 dark:border-yellow-600">
                            <div class="space-y-3">
                                <div class="flex items-start space-x-3">
                                    <span class="bg-amber-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold">1</span>
                                    <p class="text-gray-700 dark:text-yellow-100">Hubungi klinik melalui telepon atau WhatsApp untuk membuat janji</p>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <span class="bg-amber-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold">2</span>
                                    <p class="text-gray-700 dark:text-yellow-100">Berikan informasi lengkap tentang hewan peliharaan dan keluhan</p>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <span class="bg-amber-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold">3</span>
                                    <p class="text-gray-700 dark:text-yellow-100">Datang 15 menit sebelum jadwal untuk proses administrasi</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Kontak dan Informasi --}}
                    <div class="bg-amber-700 text-white p-6 rounded-lg">
                        <h4 class="text-lg font-semibold mb-4">Hubungi Kami</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <h5 class="font-medium mb-2">📞 Telepon</h5>
                                <p class="text-amber-100">0896-2632-3769</p>
                                {{-- <p class="text-amber-100">021-1234-5678</p> --}}
                            </div>
                            <div>
                                <h5 class="font-medium mb-2">📧 Email</h5>
                                <p class="text-amber-100">admin@enhapetshop.com</p>
                                {{-- <p class="text-amber-100">info@petcare.com</p> --}}
                            </div>
                            <div>
                                <h5 class="font-medium mb-2">📍 Alamat</h5>
                                <p class="text-amber-100"> Jl. Raya Barat Cicalengka No.247, Cicalengka Kulon, Kec. Cicalengka, Kabupaten Bandung, Jawa Barat 40395</p>
                                {{-- <p class="text-amber-100">Jakarta Selatan, 12345</p> --}}
                            </div>
                        </div>
                    </div>

                    {{-- Catatan Penting --}}
                    <div class="mt-6 bg-red-50 dark:bg-red-900 p-4 rounded-lg border border-red-200 dark:border-red-700">
                        <h5 class="font-semibold text-red-800 dark:text-red-200 mb-2">⚠️ Catatan Penting</h5>
                        <ul class="text-red-700 dark:text-red-300 text-sm space-y-1">
                            <li>• Bawa dokumen vaksinasi dan riwayat kesehatan hewan peliharaan</li>
                            <li>• Untuk kasus darurat, hubungi layanan 24 jam</li>
                            <li>• Pembayaran dapat dilakukan tunai atau transfer bank</li>
                            <li>• Konsultasi gratis untuk member PetCare</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>