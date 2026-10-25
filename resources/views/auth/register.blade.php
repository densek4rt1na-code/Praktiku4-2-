<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#071522">
    <title>Daftar Akun · Smart Meritim</title>
    <link rel="stylesheet" href="{{ asset('css/smartmeritim.css') }}">
</head>
<body>
    <div class="auth-page">
        <div class="auth-shell">
            <a class="brand auth-brand" href="{{ route('dashboard') }}">
                <span class="brand-mark">S<span>·</span></span>
                <span><strong>smart<span>meritim</span></strong><small>MONITORING PESISIR</small></span>
            </a>

            <div class="auth-card register-card">
                <div class="eyebrow"><span></span> REGISTRASI PETUGAS</div>
                <h1>Daftar Akun Baru</h1>
                <p class="auth-subtitle">Daftarkan akun petugas baru untuk mengelola data maritim Smart Meritim.</p>

                <x-flash-message />

                <form class="auth-form" method="POST" action="{{ route('register') }}" novalidate>
                    @csrf

                    <label for="name">Nama Lengkap <span class="required-mark">*</span></label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        placeholder="contoh: Budi Santoso"
                        autocomplete="name"
                    >
                    @error('name')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                    <label for="email">Alamat Email <span class="required-mark">*</span></label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        placeholder="contoh: petugas@smartmeritim.id"
                        autocomplete="email"
                    >
                    @error('email')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                    <label for="password">Kata Sandi <span class="required-mark">*</span> <small class="optional">(min. 8 karakter)</small></label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        placeholder="Minimal 8 karakter"
                        autocomplete="new-password"
                    >
                    @error('password')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                    <label for="password_confirmation">Konfirmasi Kata Sandi <span class="required-mark">*</span></label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        required
                        placeholder="Ulangi kata sandi"
                        autocomplete="new-password"
                    >

                    <button type="submit" class="primary-button auth-submit">
                        Daftar Akun Baru <span>→</span>
                    </button>
                </form>

                <div class="auth-switch">
                    Sudah memiliki akun? <a href="{{ route('login') }}">Masuk di sini</a>
                </div>
            </div>

            <div class="auth-foot">
                &larr; Kembali ke <a href="{{ route('dashboard') }}" style="color: #60d8bd;">Halaman Ringkasan</a>
            </div>
        </div>
    </div>
</body>
</html>
