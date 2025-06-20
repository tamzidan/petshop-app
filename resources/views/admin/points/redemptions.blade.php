<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klaim Voucher & Riwayat Penukaran - Admin</title>
    <style>
        body { font-family: sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        .container { max-width: 1000px; margin: auto; background-color: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        h1 { color: #007bff; text-align: center; margin-bottom: 25px; }
        h2 { color: #555; margin-top: 30px; margin-bottom: 15px; }
        .form-section { background-color: #f9f9f9; padding: 20px; border-radius: 8px; margin-bottom: 30px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 1.1em;
            text-transform: uppercase; /* Untuk kode unik */
        }
        .btn {
            padding: 10px 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }
        .btn-primary { background-color: #007bff; }
        .btn-primary:hover { background-color: #0056b3; }
        .btn-secondary { background-color: #6c757d; }
        .btn-secondary:hover { background-color: #5a6268; }
        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 1em;
            font-weight: bold;
        }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .error-message { color: red; font-size: 0.9em; margin-top: 5px; }

        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #e9ecef; color: #495057; }
        .status-pending { color: #ffc107; font-weight: bold; } /* Orange */
        .status-claimed { color: #28a745; font-weight: bold; } /* Green */
        .status-cancelled { color: #dc3545; font-weight: bold; } /* Red */
        .no-redemptions { text-align: center; color: #777; font-style: italic; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Klaim Voucher & Riwayat Penukaran Poin (Admin)</h1>

        <div class="top-links" style="text-align: center; margin-bottom: 20px;">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard Admin</a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Manajemen Produk</a>
            <a href="{{ route('admin.points.create') }}" class="btn btn-secondary">Kelola Poin User</a>
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

        <div class="form-section">
            <h2>Klaim Voucher (Masukkan Kode Unik Manual)</h2>
            <form action="{{ route('admin.redemptions.claim') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="unique_code">Kode Unik Voucher:</label>
                    <input type="text" id="unique_code" name="unique_code" placeholder="Misal: ABCD123XYZ" value="{{ old('unique_code') }}" required maxlength="10">
                    @error('unique_code')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Proses Klaim</button>
            </form>
        </div>

        <h2>Riwayat Semua Penukaran Poin</h2>

        @if ($redemptions->isEmpty())
            <p class="no-redemptions">Belum ada riwayat penukaran poin.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Produk</th>
                        <th>Poin</th>
                        <th>Kode Unik</th>
                        <th>Status</th>
                        <th>Tgl. Penukaran</th>
                        <th>Tgl. Klaim</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($redemptions as $redemption)
                        <tr>
                            <td>{{ $redemption->id }}</td>
                            <td>{{ $redemption->user->name }}</td>
                            <td>{{ $redemption->product->name }}</td>
                            <td>{{ $redemption->points_used }}</td>
                            <td><strong>{{ $redemption->unique_code }}</strong></td>
                            <td class="status-{{ $redemption->status }}">{{ ucfirst($redemption->status) }}</td>
                            <td>{{ $redemption->created_at->format('d M Y H:i') }}</td>
                            <td>{{ $redemption->claimed_at ? $redemption->claimed_at->format('d M Y H:i') : '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>