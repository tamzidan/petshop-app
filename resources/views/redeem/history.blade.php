<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Penukaran Poin - Petshop</title>
    <style>
        body { font-family: sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        .container { max-width: 900px; margin: auto; background-color: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        h1 { color: #007bff; text-align: center; margin-bottom: 25px; }
        .user-info { text-align: right; margin-bottom: 20px; font-size: 1.1em; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; color: #555; }
        .status-pending { color: #ffc107; font-weight: bold; } /* Orange */
        .status-claimed { color: #28a745; font-weight: bold; } /* Green */
        .status-cancelled { color: #dc3545; font-weight: bold; } /* Red */
        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 1em;
            font-weight: bold;
        }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .no-redemptions { text-align: center; color: #777; font-style: italic; }
        .btn {
            display: inline-block;
            padding: 8px 15px;
            margin-top: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            color: white;
            font-size: 0.9em;
            transition: background-color 0.3s ease;
        }
        .btn-primary { background-color: #007bff; }
        .btn-primary:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Riwayat Penukaran Poin Anda</h1>

        <div class="user-info">
            Hai, {{ Auth::user()->name }}! Poin Anda saat ini: <span style="color: #28a745;">{{ Auth::user()->points }}</span>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {!! session('success') !!}
            </div>
        @endif

        <a href="{{ route('redeem.index') }}" class="btn btn-primary">Tukar Poin Lainnya</a>
        <a href="{{ url('/dashboard') }}" class="btn btn-primary">Kembali ke Dashboard</a>

        @if ($redemptions->isEmpty())
            <p class="no-redemptions">Anda belum memiliki riwayat penukaran poin.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Tanggal Penukaran</th>
                        <th>Produk</th>
                        <th>Poin Digunakan</th>
                        <th>Kode Klaim Unik</th>
                        <th>Status</th>
                        <th>Tanggal Klaim</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($redemptions as $redemption)
                        <tr>
                            <td>{{ $redemption->created_at->format('d M Y H:i') }}</td>
                            <td>{{ $redemption->product->name }}</td>
                            <td>{{ $redemption->points_used }}</td>
                            <td><strong>{{ $redemption->unique_code }}</strong></td>
                            <td class="status-{{ $redemption->status }}">{{ ucfirst($redemption->status) }}</td>
                            <td>{{ $redemption->claimed_at ? $redemption->claimed_at->format('d M Y H:i') : '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>