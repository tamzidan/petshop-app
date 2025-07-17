<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Tambah Produk Toko Baru</h3>
                    
                    <form action="{{ route('admin.shop-products.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Produk</label>
                                <input type="text" name="name" id="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                            </div>
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga (Rp)</label>
                                <input type="number" name="price" id="price" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                            </div>
                            <div>
                                <label for="stock_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status Stok</label>
                                <select name="stock_status" id="stock_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                                    <option>Tersedia</option>
                                    <option>Habis</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600"></textarea>
                        </div>
                        
                        <div>
                            <label for="link_tokopedia" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Link Tokopedia</label>
                            <input type="url" name="link_tokopedia" id="link_tokopedia" placeholder="https://..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div>
                            <label for="link_shopee" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Link Shopee</label>
                            <input type="url" name="link_shopee" id="link_shopee" placeholder="https://..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div>
                            <label for="link_whatsapp" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Link WhatsApp (incl. no telp & pesan)</label>
                            <input type="url" name="link_whatsapp" id="link_whatsapp" placeholder="https://wa.me/62..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                        </div>

                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gambar Produk</label>
                            <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white font-semibold rounded-lg shadow-md">
                                Simpan Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>