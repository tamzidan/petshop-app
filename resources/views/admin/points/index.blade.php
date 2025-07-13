{{-- resources/views/admin/points/index.blade.php --}}
{{-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Poin User - Admin</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .container { max-width: 800px; margin: auto; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn {
            display: inline-block;
            padding: 8px 12px;
            margin: 5px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            color: white;
            font-size: 14px;
        }
        .btn-primary { background-color: #007bff; }
        .btn-success { background-color: #28a745; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar Poin User</h1>

        <a href="{{ route('admin.points.create') }}" class="btn btn-success">Kelola Poin User</a>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Kembali ke Dashboard Admin</a>

        <table>
            <thead>
                <tr>
                    <th>Nama User</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Poin Saat Ini</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>{{ $user->points }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Belum ada user yang terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html> --}}

{{-- resources/views/admin/points/index.blade.php --}}

<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl border border-gray-100 dark:border-gray-700">

                {{-- Header dengan gradasi warna oranye/kuning --}}
                <div class="bg-gradient-to-r from-orange-500 via-amber-500 to-yellow-400 p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Manajemen Poin Pengguna</h3>
                            <p class="text-sm opacity-90">Lihat dan kelola poin semua pengguna terdaftar.</p>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    {{-- Tombol Aksi --}}
                    <div class="mb-6 flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('admin.points.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white font-semibold rounded-lg shadow-md transition duration-200">
                            <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                            Kelola Poin User
                        </a>
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg shadow-md transition duration-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                            Kembali ke Dashboard
                        </a>
                    </div>

                    {{-- Cek jika ada user --}}
                    @if ($users->isEmpty())
                        {{-- Tampilan jika tidak ada data --}}
                        <div class="text-center py-16">
                            <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m-7.5-2.962A3.375 3.375 0 019 12.75l-1.546.927a3.375 3.375 0 00-3.808 4.971 4.5 4.5 0 005.454 1.272M12 12a3.375 3.375 0 100-6.75 3.375 3.375 0 000 6.75zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">Belum ada pengguna.</p>
                            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Data pengguna akan muncul di sini setelah terdaftar.</p>
                        </div>
                    @else
                        {{-- Tabel data --}}
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-amber-50 dark:bg-amber-900/20">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-amber-800 dark:text-amber-200 uppercase tracking-wider">Nama User</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-amber-800 dark:text-amber-200 uppercase tracking-wider">Email</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-amber-800 dark:text-amber-200 uppercase tracking-wider">Role</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-amber-800 dark:text-amber-200 uppercase tracking-wider">Poin Saat Ini</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach ($users as $user)
                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ ucfirst($user->role) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-orange-600 dark:text-orange-400">{{ $user->points ?? 0 }} Poin</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>