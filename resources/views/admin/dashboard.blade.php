{{-- resources/views/admin/dashboard.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Selamat Datang, Admin!</h1>
    <p>Anda telah berhasil masuk ke halaman admin.</p>
    <a href="{{ url('/dashboard') }}">Kembali ke Dashboard Pengguna</a>
    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>