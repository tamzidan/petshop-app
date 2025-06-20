<x-app-layout>

    <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ request()->routeIs('redeem.index') ? 'Tukar Poin' : 'Riwayat Penukaran' }}
    </h2>
    </x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            @if (request()->routeIs('redeem.index'))
                <div class="mb-4 text-right text-lg">
                    Hai, {{ Auth::user()->name }}! Poin Anda saat ini: <span class="text-green-600 font-semibold">{{ Auth::user()->points }}</span>
                </div>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($products->isEmpty())
                    <p class="text-center text-gray-500 italic">Belum ada produk yang tersedia untuk ditukarkan.</p>
                @else
                    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($products as $product)
                            <div class="border rounded-lg p-4 shadow bg-white">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/150?text=No+Image' }}" alt="{{ $product->name }}" class="mb-3 h-40 w-full object-contain rounded">
                                <h3 class="text-lg font-semibold text-gray-700 mb-1">{{ $product->name }}</h3>
                                <p class="text-sm text-gray-600 mb-2">{{ Str::limit($product->description, 100) }}</p>
                                <p class="text-green-600 font-bold text-lg mb-1">{{ $product->point_cost }} Poin</p>
                                <p class="text-sm text-gray-500 mb-4">Stok: {{ $product->stock }}</p>
                                @if (Auth::user()->points >= $product->point_cost && $product->stock > 0)
                                    <form action="{{ route('redeem.redeem', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tukar Sekarang!</button>
                                    </form>
                                @else
                                    <button class="bg-gray-300 text-white px-4 py-2 rounded cursor-not-allowed" disabled>
                                        {{ $product->stock <= 0 ? 'Stok Habis' : 'Poin Tidak Cukup' }}
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif

            @elseif (request()->routeIs('redeem.history'))
                <div class="mb-4 text-right text-lg">
                    Hai, {{ Auth::user()->name }}! Poin Anda saat ini: <span class="text-green-600 font-semibold">{{ Auth::user()->points }}</span>
                </div>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {!! session('success') !!}
                    </div>
                @endif

                <div class="mb-4">
                    <a href="{{ route('redeem.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tukar Poin Lainnya</a>
                    <a href="{{ url('/dashboard') }}" class="ml-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Kembali ke Dashboard</a>
                </div>

                @if ($redemptions->isEmpty())
                    <p class="text-center text-gray-500 italic">Anda belum memiliki riwayat penukaran poin.</p>
                @else
                    <div class="overflow-auto">
                        <table class="min-w-full border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 border">Tanggal Penukaran</th>
                                    <th class="px-4 py-2 border">Produk</th>
                                    <th class="px-4 py-2 border">Poin Digunakan</th>
                                    <th class="px-4 py-2 border">Kode Klaim Unik</th>
                                    <th class="px-4 py-2 border">Status</th>
                                    <th class="px-4 py-2 border">Tanggal Klaim</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($redemptions as $redemption)
                                    <tr>
                                        <td class="px-4 py-2 border">{{ $redemption->created_at->format('d M Y H:i') }}</td>
                                        <td class="px-4 py-2 border">{{ $redemption->product->name }}</td>
                                        <td class="px-4 py-2 border">{{ $redemption->points_used }}</td>
                                        <td class="px-4 py-2 border font-semibold">{{ $redemption->unique_code }}</td>
                                        <td class="px-4 py-2 border font-bold {{
                                            $redemption->status === 'pending' ? 'text-yellow-500' :
                                            ($redemption->status === 'claimed' ? 'text-green-600' : 'text-red-600')
                                        }}">
                                            {{ ucfirst($redemption->status) }}
                                        </td>
                                        <td class="px-4 py-2 border">{{ $redemption->claimed_at ? $redemption->claimed_at->format('d M Y H:i') : '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            @endif

        </div>
    </div>
</div>
</x-app-layout>