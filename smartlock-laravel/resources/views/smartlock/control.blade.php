@extends('layouts.app')

@section('title', 'Kontrol Smart Lock')

@section('styles')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f9;
            margin: 0;
            padding: 20px;
        }
        h1, h2, h3 {
            color: #2c3e50;
            text-align: center;
        }
        form {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            margin: 20px auto;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #34495e;
        }
        input[type="text"], input[type="password"], button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #2ecc71;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #27ae60;
        }
        .status-box {
            max-width: 400px;
            margin: 20px auto;
            padding: 15px;
            background-color: #ecf0f1;
            border-radius: 8px;
            text-align: center;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .nav {
            margin-bottom: 20px;
        }
        .nav a {
            text-decoration: none;
            color: #3498db;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="nav">
        <a href="{{ route('dashboard') }}">&larr; Kembali ke Dashboard</a>
    </div>

    <h1>Kontrol Smart Lock</h1>

    @if (session('success'))
        <div style="color: green; text-align:center; font-weight:bold;">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div style="color: red; text-align:center; font-weight:bold;">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
        <div style="color: red; text-align:center; font-weight:bold;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <h2>Setel PIN Baru</h2>
    <form action="{{ route('smartlock.setPin') }}" method="POST">
        @csrf
        <label for="newPin">PIN Baru:</label>
        <input type="text" name="newPin" required>
        <button type="submit">Setel PIN</button>
    </form>

    <h2>Masukkan PIN untuk Membuka Pintu</h2>
    <form action="{{ route('smartlock.open') }}" method="POST">
        @csrf
        <label for="doorPin">PIN:</label>
        <input type="password" name="doorPin" required>
        <button type="submit">Buka Pintu</button>
    </form>

    <h2>Menutup Pintu</h2>
    <form action="{{ route('smartlock.close') }}" method="POST">
        @csrf
        <button type="submit" style="background-color: #e74c3c;">Tutup Pintu</button>
    </form>

    <h2>Log Akses Smart Lock</h2>
    <table>
        <tr>
            <th>User</th>
            <th>Action</th>
            <th>Waktu Akses</th>
        </tr>
        @forelse ($logs as $log)
            <tr>
                <td>{{ $log->user ? $log->user->username : 'System/Unknown' }}</td>
                <td>{{ $log->action }}</td>
                <td>{{ $log->accessed_at }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">Tidak ada log akses</td>
            </tr>
        @endforelse
    </table>
</div>
@endsection
