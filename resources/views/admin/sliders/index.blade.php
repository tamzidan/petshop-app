<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl border border-gray-100 dark:border-gray-700">

                {{-- Header Halaman --}}
                <div class="bg-gradient-to-r from-orange-500 via-amber-500 to-yellow-400 p-6 text-white">
                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Manajemen Slider</h3>
                            <p class="text-sm opacity-90">Kelola gambar yang tampil di slider halaman utama.</p>
                        </div>
                        <div class="mt-4 md:mt-0 flex-shrink-0">
                             {{-- Pastikan route name sudah benar: 'sliders.create' --}}
                            <a href="{{ route('sliders.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-orange-500 hover:bg-orange-700 text-white font-semibold rounded-lg shadow-md transition duration-200">
                                <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Tambah Gambar
                            </a>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    {{-- Notifikasi Sukses --}}
                    @if (session('success'))
                        <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded-xl mb-6 flex items-center space-x-3">
                            <div class="w-6 h-6 bg-green-100 dark:bg-green-800 rounded-full flex items-center justify-center">
                                <svg class="w-3 h-3 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span>{!! session('success') !!}</span>
                        </div>
                    @endif

                    {{-- Grid Gambar Slider --}}
                    @if ($sliders->isEmpty())
                        {{-- Tampilan jika tidak ada gambar --}}
                        <div class="text-center py-16">
                            <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                               <svg class="w-10 h-10 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">Belum ada gambar slider.</p>
                            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Klik "Tambah Gambar" untuk memulai.</p>
                        </div>
                    @else
                        {{-- Tampilan jika ada gambar --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach ($sliders as $slider)
                                <div class="relative group bg-gray-50 dark:bg-gray-800/50 rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-lg transition-shadow duration-300">
                                    <img src="{{ asset('storage/' . $slider->image_path) }}" alt="Slider Image" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">

                                    {{-- Tombol Hapus di pojok kanan atas --}}
                                    <div class="absolute top-2 right-2">
                                        {{-- Pastikan route name sudah benar: 'sliders.destroy' --}}
                                        <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus gambar ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500/80 hover:bg-red-600 text-white rounded-full p-2 shadow-lg transition-all opacity-0 group-hover:opacity-100" title="Hapus">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>