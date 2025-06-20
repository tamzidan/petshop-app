{{-- Dashboard Admin --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Petshop</title>
    <style>
        body { font-family: sans-serif; margin: 20px; background-color: #f8f9fa; color: #343a40; }
        .container { max-width: 800px; margin: auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        h1 { color: #007bff; text-align: center; margin-bottom: 30px; }
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .menu-item {
            background-color: #e9ecef;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }
        .menu-item a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            font-size: 1.2em;
            display: block;
            padding: 10px;
        }
        .menu-item a:hover {
            color: #0056b3;
        }
        .logout-form {
            text-align: center;
            margin-top: 30px;
        }
        .logout-button {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.2s ease;
        }
        .logout-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Selamat Datang, Admin {{ Auth::user()->name }}!</h1>
        <p style="text-align: center; margin-bottom: 25px; color: #6c757d;">Dashboard Pusat Kontrol Petshop Anda</p>

        <div class="menu-grid">
            <div class="menu-item">
                <a href="{{ route('admin.products.index') }}">Manajemen Produk Poin</a>
                <p style="font-size: 0.9em; color: #6c757d;">Tambah, edit, hapus produk yang bisa ditukar poin.</p>
            </div>
            <div class="menu-item">
                <a href="{{ route('admin.points.create') }}">Kelola Poin User</a>
                <p style="font-size: 0.9em; color: #6c757d;">Berikan atau kurangi poin untuk user.</p>
            </div>
            <div class="menu-item">
                <a href="{{ route('admin.redemptions.index') }}">Klaim Voucher & Riwayat Penukaran</a>
                <p style="font-size: 0.9em; color: #6c757d;">Proses klaim voucher user dan lihat riwayat penukaran.</p>
            </div>
            <div class="menu-item">
                <a href="{{ route('admin.points.index') }}">Lihat Daftar Poin User</a>
                <p style="font-size: 0.9em; color: #6c757d;">Lihat saldo poin semua user.</p>
            </div>
        </div>

        <div class="logout-form">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-button">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>