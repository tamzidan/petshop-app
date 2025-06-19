{{-- resources/views/admin/products/index.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk - Admin</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .container { max-width: 900px; margin: auto; }
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
        .btn-warning { background-color: #ffc107; }
        .btn-danger { background-color: #dc3545; }
        .btn-success { background-color: #28a745; }
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            color: white;
        }
        .alert-success { background-color: #28a745; }
        .product-image {
            max-width: 80px;
            height: auto;
            display: block;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manajemen Produk</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('admin.products.create') }}" class="btn btn-success">Tambah Produk Baru</a>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Kembali ke Dashboard Admin</a>

        <table>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Biaya Poin</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                            @else
                                Tidak ada gambar
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ Str::limit($product->description, 50) }}</td> {{-- Membatasi deskripsi --}}
                        <td>{{ $product->point_cost }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Belum ada produk yang ditambahkan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>