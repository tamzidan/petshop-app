{{-- resources/views/admin/products/edit.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Admin</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .container { max-width: 600px; margin: auto; }
        h1 { color: #333; }
        form { background-color: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="number"], textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea { resize: vertical; min-height: 80px; }
        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            font-size: 16px;
        }
        .btn-primary { background-color: #007bff; }
        .btn-secondary { background-color: #6c757d; }
        .error-message { color: red; font-size: 0.9em; margin-top: 5px; }
        .current-image { margin-top: 10px; }
        .current-image img { max-width: 150px; height: auto; display: block; margin-top: 5px; border: 1px solid #ddd; padding: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Produk</h1>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- Penting untuk metode UPDATE --}}
            <div class="form-group">
                <label for="name">Nama Produk:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Deskripsi:</label>
                <textarea id="description" name="description">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="point_cost">Biaya Poin:</label>
                <input type="number" id="point_cost" name="point_cost" value="{{ old('point_cost', $product->point_cost) }}" min="0" required>
                @error('point_cost')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="stock">Stok:</label>
                <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" min="0" required>
                @error('stock')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Gambar Produk:</label>
                <input type="file" id="image" name="image" accept="image/*">
                @error('image')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                @if ($product->image)
                    <div class="current-image">
                        <p>Gambar saat ini:</p>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image">
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Perbarui Produk</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>