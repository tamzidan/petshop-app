{{-- resources/views/admin/points/create.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Poin User - Admin</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .container { max-width: 600px; margin: auto; }
        h1 { color: #333; }
        form { background-color: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        select, input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
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
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            color: white;
        }
        .alert-success { background-color: #28a745; }
        .alert-danger { background-color: #dc3545; }
        .error-message { color: red; font-size: 0.9em; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Kelola Poin User</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.points.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">Pilih User:</label>
                <select id="user_id" name="user_id" required>
                    <option value="">-- Pilih User --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} (Poin saat ini: {{ $user->points }})
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="points_amount">Jumlah Poin:</label>
                <input type="number" id="points_amount" name="points_amount" value="{{ old('points_amount', 1) }}" min="1" required>
                @error('points_amount')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="action">Aksi:</label>
                <select id="action" name="action" required>
                    <option value="add" {{ old('action') == 'add' ? 'selected' : '' }}>Tambahkan Poin</option>
                    <option value="deduct" {{ old('action') == 'deduct' ? 'selected' : '' }}>Kurangi Poin</option>
                </select>
                @error('action')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Proses Poin</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard Admin</a>
            <a href="{{ route('admin.points.index') }}" class="btn btn-primary">Lihat Daftar Poin User</a>
        </form>
    </div>
</body>
</html>