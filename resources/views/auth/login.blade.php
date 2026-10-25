@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Login Petugas BPBD</h2>
    <p style="text-align: center; color: #555; font-size: 0.9rem; margin-top: -16px; margin-bottom: 24px;">
        Silakan masuk untuk mengakses halaman pengelolaan daftar laporan banjir.
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

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Alamat Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@bpbd.bandungkab.go.id" required autofocus>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>
        </div>

        <button type="submit" class="btn">Masuk ke Sistem</button>
    </form>

    <div style="text-align: center; margin-top: 20px; font-size: 0.9rem; color: #555;">
        Belum memiliki akun petugas? <a href="{{ route('register') }}" style="color: #1976d2; font-weight: 600; text-decoration: none;">Daftar di sini</a>
    </div>
</div>
@endsection
