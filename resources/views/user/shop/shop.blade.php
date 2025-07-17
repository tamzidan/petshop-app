<x-app-layout> {{-- Sesuaikan dengan layout utama Anda --}}
    <div class="bg-amber-100 dark:bg-amber-900 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Kontainer Utama Meniru Halaman Grooming --}}
            <div class="bg-white dark:bg-yellow-500 overflow-hidden shadow-xl border border-orange-100 dark:border-orange-700 sm:rounded-2xl">

                {{-- Header Halaman --}}
                <div class="bg-amber-700 p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Produk Kami</h3>
                            <p class="text-sm opacity-90">Temukan semua kebutuhan hewan kesayangan Anda di sini.</p>
                        </div>
                    </div>
                </div>

                {{-- Konten Produk --}}
                <div class="p-6 md:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @forelse ($shopProducts as $product)
                            {{-- Desain Kartu Produk Baru --}}
                            <div class="bg-white dark:bg-gray-700 border border-amber-100 dark:border-gray-600 rounded-2xl p-6 flex flex-col justify-between shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group">
                                <div>
                                    {{-- Gambar Produk --}}
                                    <div class="w-full h-48 mb-4 rounded-lg overflow-hidden">
                                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    </div>
                                    
                                    {{-- Nama Produk --}}
                                    <h5 class="text-xl font-bold text-amber-700 dark:text-amber-400 mb-3 text-center group-hover:text-amber-800 dark:group-hover:text-amber-300 transition-colors">
                                        {{ $product->name }}
                                    </h5>

                                    {{-- Deskripsi Produk --}}
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-6 text-center">
                                        {{ $product->description ?? 'Deskripsi produk tidak tersedia.' }}
                                    </p>
                                </div>
                                <div class="mt-auto pt-4 border-t border-amber-100 dark:border-gray-600">
                                    {{-- Harga Produk --}}
                                    <p class="text-center text-3xl font-extrabold text-yellow-600 dark:text-yellow-400 mb-4">
                                        Rp{{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                    
                                    {{-- Tombol Aksi --}}
                                    <div class="space-y-2">
                                        @if($product->link_tokopedia)
                                            <a href="{{ $product->link_tokopedia }}" target="_blank" class="block w-full text-center px-4 py-3 bg-gradient-to-r from-green-500 to-teal-600 hover:from-green-600 hover:to-teal-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                                                Beli di Tokopedia
                                            </a>
                                        @endif
                                        @if($product->link_shopee)
                                            <a href="{{ $product->link_shopee }}" target="_blank" class="block w-full text-center px-4 py-3 bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                                                Beli di Shopee
                                            </a>
                                        @endif
                                        @if($product->link_whatsapp)
                                            <a href="{{ $product->link_whatsapp }}" target="_blank" class="block w-full text-center px-4 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 dark:bg-gray-600 dark:text-white dark:hover:bg-gray-500 font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                                                Pesan via WA
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="col-span-full text-center py-16 text-gray-500 dark:text-gray-300">
                                Belum ada produk yang tersedia. Segera hadir!
                            </p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>