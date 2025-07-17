<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl">
                <div class="bg-gradient-to-r from-teal-500 to-cyan-500 p-6 text-white">
                    <h3 class="text-2xl font-bold">Manajemen Produk Toko</h3>
                    <p class="text-sm opacity-90">Kelola produk yang ditampilkan di halaman Shop.</p>
                </div>

                <div class="p-6">
                    <a href="{{ route('admin.shop-products.create') }}" class="mb-6 inline-flex items-center px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white font-semibold rounded-lg shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                        Tambah Produk Toko
                    </a>

                    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700/50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Produk</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Harga</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Stok</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($shopProducts as $product)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-12 w-12">
                                                    <img class="h-12 w-12 rounded-full object-cover" src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $product->name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-teal-600 dark:text-teal-400">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $product->stock_status == 'Tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $product->stock_status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-4">
                                                <a href="{{ route('admin.shop-products.edit', $product->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                <form action="{{ route('admin.shop-products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                            Belum ada produk toko yang ditambahkan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>