{{-- resources/views/admin/products/edit.blade.php --}}

<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl border border-gray-100 dark:border-gray-700">

                {{-- Header Halaman --}}
                <div class="bg-gradient-to-r from-orange-500 via-amber-500 to-yellow-400 p-6 text-white">
                    <h3 class="text-2xl font-bold mb-2">Edit Produk</h3>
                    <p class="text-sm opacity-90">Memperbarui detail untuk produk: {{ $product->name }}</p>
                </div>

                <div class="p-6">
                     {{-- Menampilkan error validasi jika ada --}}
                    @if ($errors->any())
                        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 px-4 py-3 rounded-xl mb-6">
                             <p class="font-bold mb-2">Terjadi beberapa kesalahan:</p>
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-6">
                            {{-- Nama Produk --}}
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama Produk:</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required
                                       class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                @error('name')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                            </div>

                            {{-- Deskripsi --}}
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Deskripsi:</label>
                                <textarea id="description" name="description" rows="4"
                                          class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">{{ old('description', $product->description) }}</textarea>
                                @error('description')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                            </div>

                            {{-- Biaya Poin & Stok --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="point_cost" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Biaya Poin:</label>
                                    <input type="number" id="point_cost" name="point_cost" value="{{ old('point_cost', $product->point_cost) }}" min="0" required
                                           class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                    @error('point_cost')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="stock" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Stok:</label>
                                    <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" min="0" required
                                           class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                    @error('stock')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            {{-- Gambar Produk --}}
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Ganti Gambar Produk (Opsional):</label>
                                <input type="file" id="image" name="image" accept="image/*"
                                       class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-amber-100 file:text-amber-700 hover:file:bg-amber-200 dark:file:bg-amber-900/50 dark:file:text-amber-300 dark:hover:file:bg-amber-900">
                                @error('image')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                                
                                @if ($product->image)
                                    <div class="mt-4">
                                        <p class="text-sm font-medium text-gray-700 dark:text-gray-200">Gambar saat ini:</p>
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" class="mt-2 w-32 h-32 object-cover rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="mt-8 flex justify-end space-x-4">
                            <a href="{{ route('admin.products.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-xl font-semibold text-sm text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white font-semibold rounded-xl shadow-md transition duration-200">
                                Perbarui Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>