{{-- resources/views/admin/points/create.blade.php --}}

<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl border border-gray-100 dark:border-gray-700">

                {{-- Header dengan gradasi warna oranye/kuning --}}
                <div class="bg-gradient-to-r from-orange-500 via-amber-500 to-yellow-400 p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Kelola Poin Pengguna</h3>
                            <p class="text-sm opacity-90">Tambah atau kurangi poin untuk pengguna yang dipilih.</p>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    {{-- Notifikasi --}}
                    @if (session('success'))
                        <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded-xl mb-6 flex items-center space-x-3">
                            <div class="w-6 h-6 bg-green-100 dark:bg-green-800 rounded-full flex items-center justify-center">
                                <svg class="w-3 h-3 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span>{!! session('success') !!}</span>
                        </div>
                    @endif

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

                    <form action="{{ route('admin.points.store') }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            {{-- Input field: Pilih User --}}
                            <div>
                                <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Pilih User:</label>
                                <select id="user_id" name="user_id" required
                                        class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                    <option value="">-- Pilih User --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} (Poin saat ini: {{ $user->points ?? 0 }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                            </div>

                            {{-- Input field: Jumlah Poin --}}
                            <div>
                                <label for="points_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Jumlah Poin:</label>
                                <input type="number" id="points_amount" name="points_amount" value="{{ old('points_amount', 10) }}" min="1" required
                                       class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                @error('points_amount')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                            </div>

                            {{-- Input field: Aksi --}}
                            <div>
                                <label for="action" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Aksi:</label>
                                <select id="action" name="action" required
                                        class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                    <option value="add" {{ old('action') == 'add' ? 'selected' : '' }}>Tambahkan Poin</option>
                                    <option value="deduct" {{ old('action') == 'deduct' ? 'selected' : '' }}>Kurangi Poin</option>
                                </select>
                                @error('action')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="mt-8 flex flex-col sm:flex-row justify-end sm:space-x-4">
                             <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white font-semibold rounded-xl shadow-md transition duration-200 order-1 sm:order-2">
                                Proses Poin
                            </button>
                            <a href="{{ route('admin.points.index') }}" class="w-full sm:w-auto mt-2 sm:mt-0 inline-flex items-center justify-center px-6 py-3 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-xl font-semibold text-sm text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md order-2 sm:order-1">
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>