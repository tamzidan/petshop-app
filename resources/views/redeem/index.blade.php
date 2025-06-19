<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tukar Poin - Petshop</title>
    <style>
        body { font-family: sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        .container { max-width: 960px; margin: auto; background-color: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        h1 { color: #007bff; text-align: center; margin-bottom: 25px; }
        .user-info { text-align: right; margin-bottom: 20px; font-size: 1.1em; }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }
        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .product-card img {
            max-width: 100%;
            height: 150px;
            object-fit: contain;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .product-card h2 {
            font-size: 1.4em;
            margin-bottom: 10px;
            color: #555;
        }
        .product-card p {
            font-size: 0.95em;
            color: #666;
            margin-bottom: 10px;
        }
        .product-card .point-cost {
            font-size: 1.2em;
            font-weight: bold;
            color: #28a745;
            margin-bottom: 15px;
        }
        .product-card .stock {
            font-size: 0.9em;
            color: #888;
            margin-bottom: 15px;
        }
        .btn {
            display: inline-block;
            padding: 10px 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            color: white;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }
        .btn-redeem { background-color: #007bff; }
        .btn-redeem:hover { background-color: #0056b3; }
        .btn-disabled { background-color: #cccccc; cursor: not-allowed; }
        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 1em;
            font-weight: bold;
        }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .no-products { text-align: center; color: #777; font-style: italic; }
        .top-links {
            text-align: center;
            margin-bottom: 20px;
        }
        .top-links a {
            margin: 0 10px;
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        .top-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="top-links">
            <a href="{{ url('/dashboard') }}">Dashboard</a> |
            <a href="{{ route('redeem.history') }}">Riwayat Penukaran</a> |
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn" style="background: none; color: #dc3545; font-weight: bold; cursor: pointer; padding: 0;">Logout</button>
            </form>
        </div>

        <h1>Tukar Poin Anda!</h1>

        <div class="user-info">
            Hai, {{ Auth::user()->name }}! Poin Anda saat ini: <span style="color: #28a745;">{{ Auth::user()->points }}</span>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if ($products->isEmpty())
            <p class="no-products">Belum ada produk yang tersedia untuk ditukarkan.</p>
        @else
            <div class="product-grid">
                @foreach ($products as $product)
                    <div class="product-card">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        @else
                            <img src="https://via.placeholder.com/150?text=No+Image" alt="No Image">
                        @endif
                        <h2>{{ $product->name }}</h2>
                        <p>{{ Str::limit($product->description, 100) }}</p>
                        <div class="point-cost">{{ $product->point_cost }} Poin</div>
                        <div class="stock">Stok: {{ $product->stock }}</div>

                        @if (Auth::user()->points >= $product->point_cost && $product->stock > 0)
                            <form action="{{ route('redeem.redeem', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-redeem">Tukar Sekarang!</button>
                            </form>
                        @else
                            <button class="btn btn-disabled" disabled>
                                {{ $product->stock <= 0 ? 'Stok Habis' : 'Poin Tidak Cukup' }}
                            </button>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>