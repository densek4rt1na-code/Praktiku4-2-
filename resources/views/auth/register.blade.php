@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Registrasi Petugas BPBD</h2>
    <p style="text-align: center; color: #555; font-size: 0.9rem; margin-top: -16px; margin-bottom: 24px;">
        Daftarkan akun petugas baru untuk mengelola data pelaporan bencana banjir.
    </p>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul style="margin-left: 18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nama Lengkap Petugas:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Budi Santoso" required autofocus>
        </div>

        <div class="form-group">
            <label for="email">Alamat Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Contoh: budi@bpbd.bandungkab.go.id" required>
        </div>

        <div class="form-group">
            <label for="password">Password (Minimal 6 karakter):</label>
            <input type="password" id="password" name="password" placeholder="Buat password aman" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password di atas" required>
        </div>

        <button type="submit" class="btn">Daftar Akun Petugas</button>
    </form>

    <div style="text-align: center; margin-top: 20px; font-size: 0.9rem; color: #555;">
        Sudah memiliki akun petugas? <a href="{{ route('login') }}" style="color: #1976d2; font-weight: 600; text-decoration: none;">Login di sini</a>
    </div>
</div>
@endsection
